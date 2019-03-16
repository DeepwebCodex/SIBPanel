#!/usr/bin/env python
# -*- coding: utf-8 -*-

from modules import logger
log = logger.logger_class()

#from modules import system_watcher
#watcher = system_watcher.system_health_watcher()


import settings
setup = settings.settings_var

from os import walk, remove

import os
import time
import json
import urllib2
import threading
import subprocess
import sys



tot_m, used_m, free_m = map(int, os.popen('free -t -m').readlines()[-1].split()[1:])

#print  os.popen('free -t -m').readlines()[-1].split()


report = json.loads(open('reports/' + '4x4store.com.ua.request', 'r+').read())
print report

#get_seeds = urllib2.urlopen('http://' + setup.ARACHNI_SERVER_IP + ":"
                                        #+ str(setup.ARACHNI_SERVER_PORT) + '/scans', timeout=10)

                                        
                                        
#response = get_seeds.read()

#print ('http://' + setup.ARACHNI_SERVER_IP + ":"+ str(setup.ARACHNI_SERVER_PORT) + '/scans')