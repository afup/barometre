#!/usr/bin/python

debug = True

from fabric.api import *
from fabric.api import env
import yaml

config = open("/var/www/barometre/provisioning/vagrant.yml", 'r')

import os

env.forward_agent = True
env.use_ssh_config = True
env.roledefs = {
    'development':   ['vagrant@127.0.0.1']
}

project_root_dir = os.getcwd()
project_name = 'barometre'
shared_folder = project_root_dir + '/'

keys = ['~/.ssh/rsa_vagrant']
env.key_filename = [key for key in keys if os.access(key, os.R_OK)]


def deploy_to_do():
    print '__TODO__'
