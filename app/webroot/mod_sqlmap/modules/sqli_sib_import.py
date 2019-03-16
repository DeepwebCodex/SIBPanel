#!/usr/bin/env python
# -*- coding: utf-8 -*-


import os

from modules import logger
log = logger.logger_class()

import settings

sutup = settings.settings_var()



class import_sql():

    urls = []
   
    def read_dir(self):
    
        try: 
            dirs =  os.listdir(os.getcwd() +'/reports_requests')
            
            
            
            for name_dirs in dirs:
               # print name_dirs
               
                name_full =  os.path.join(os.getcwd() +'/reports_requests/',name_dirs)
               
                #for body in open(name_full, "r").readlines():
                body =  open(name_full, "r").read()
                  
                #print type(body)
                #print body.find('GET')
                
                #print body.rfind('HTTP/1.1')
                
                if ((body.find('GET') !=-1) and (body.find('Host:') !=-1) and  (body.rfind('HTTP/1.1') !=-1)):
                    before =  body.rfind('GET ')
                    end = body.find('HTTP/1.1')
                    url = body[before:end].replace('GET ','')
                    
                    before2 =  body.rfind('Host:')
                    end2 = body.find('Accept-Encoding')
                    host = body[before2:end2].strip().replace('Host: ','GET::http://')
                 
                elif ((body.find('GET') !=-1) and (body.find('Host:') !=-1) and  (body.rfind('HTTPS/1.1') !=-1)):
                    before =  body.rfind('GET ')
                    end = body.find('HTTPS/1.1')
                    url = body[before:end].replace('GET ','')
                    
                    before2 =  body.rfind('Host:')
                    end2 = body.find('Accept-Encoding')
                    host = body[before2:end2].strip().replace('Host: ','GET::https://')
                
                elif (body.find('POST') !=-1 and body.find('Host:') !=-1 and  body.find('HTTP/1.1')!=-1):
                    before =  body.rfind('urlencoded') 
                    url = body[before:].replace('urlencoded','').strip()
                    url = '?'+url
                   # print url
                   
                    before2 =  body.rfind('Host:')
                    end2 = body.find('Accept-Encoding')
                    host = body[before2:end2].strip().replace('Host: ','POST::http://')
                    
                elif (body.find('POST') !=-1 and body.find('Host:') !=-1 and  body.find('HTTPS/1.1')!=-1):
                    before =  body.rfind('urlencoded') 
                    url = body[before:].replace('urlencoded','').strip()
                    url = '?'+url
                   
                   
                    before2 =  body.rfind('Host:')
                    end2 = body.find('Accept-Encoding')
                    host = body[before2:end2].strip().replace('Host: ','POST::https://')
                     
                self.urls.append(host+url+"\r\n")
                
                
                
                
                #print self.urls
                
               
                
            #self.urls = unique(self.urls)
            
           # sqli = open('sqli_sib.txt','a+')
            
            save = open('sqli_sib.txt', 'w')
            for sss in self.urls:
                save.write(sss)
            save.close()
            
            print self.urls
            
            #for sib in self.urls
                #sqli.write(sib +"\n")
            
           
                
            return self.urls
               
              
                
               
                
                
                
                
                
                
        except Exception, error_code:
            log.warning("import_sql", str(error_code))
            pass

            
            
    def __init__(self):

        try:

            #log.info("import_sql|__init__", "Import sql to SIB SERVICE")

            # CHECK ENGINE
            self.read_dir()
           

        except Exception, error_code:
           # log.warning("Import sql|__init__", str(error_code))
            pass
            

            
imp = import_sql()
