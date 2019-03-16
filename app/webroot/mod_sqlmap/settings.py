class settings_var():

    VERSION = "sqlmap for SIB SERVICE"

    SQLMAP_THREADS   = 10
    #DUMP = True
    SQLMAP_LINE_MAX = 30
    DUMP=True
    
    PATH_LOG = '/var/www/ku/data/www//app/webroot/mod_sqlmap/log'
    LINKS_INPUT = 'MYSQL'  #sqlmap_links.txt  
    
    LOGIN = 'ku'
    DB = 'ku'
    PASSWORD = 'HJjskad898d9as0987'
    
    
    
    #PROXY = '--proxy=http://158.46.250.179:3130'
    PROXY = ''
    
    DUMPMODE_COL = True
    DUMP_COLUMNS = "email,mail,emails,mails,EmailAddress,pass,pwd,pword,hash"
    # DUMP_COLUMNS = "user,mail,pass,pwd,usr"
    #TAMPER_LIST =  "apostrophemask,apostrophenullencode,appendnullbyte,base64encode,between,bluecoat,chardoubleencode,charencode,charunicodeencode,concat2concatws,equaltolike,greatest,halfversionedmorekeywords,ifnull2ifisnull,modsecurityversioned,modsecurityzeroversioned,multiplespaces,nonrecursivereplacement,percentage,randomcase,randomcomments,securesphere,space2comment,space2dash,space2hash,space2morehash,space2mssqlblank,space2mssqlhash,space2mysqlblank,space2mysqldash,space2plus,space2randomblank,sp_password,unionalltounion,unmagicquotes,versionedkeywords,versionedmorekeywords"
    TAMPER_LIST =' '
    
    
    
    
    
    
    
   
    
    
    
    
    
    
