set :application,           "barometre-afup"
set :app_path,              "app"

set :branch, ENV['BRANCH'] || "master"

set :scm_verbose,           true

set :shared_files,          [app_path + "/config/parameters.yml"]
set :shared_children,       [app_path + "/logs", web_path + "/uploads"]

set :model_manager, "doctrine"
set :default_shell, '/bin/bash -l'

set :bundler_bin, "/usr/local/bin/bundle"

set :use_sudo,              false
set :keep_releases,         3
set :use_composer,          true
set :clear_controllers,     true

set :scm_username,          "git"
set :repository,            "git@github.com:afup/barometre.git"
set :scm,                   :git
set :user,                  "barometre"
set :deploy_via,            :remote_cache

default_run_options[:pty]   = true
ssh_options[:forward_agent] = true

logger.level = Logger::IMPORTANT
set :domain,                "barometre.afup.org"
set :deploy_to,             "/home/barometre/barometre.afup.org"
set :group_writable,        true
set :writable_dirs,         [app_path + "/cache", app_path + "/logs"]
set :webserver_user,        "www-data"
set :permission_method,     :acl
set :use_set_permissions,   true

role :web,                  domain                         # Your HTTP server, Apache/etc
role :app,                  domain                         # This may be the same as your `Web` server
role :db,                   domain, :primary => true       # This is where Symfony2 migrations will run

after 'symfony:cache:warmup', 'barometre:assets_build'
after :deploy, 'symfony:doctrine:schema:update'
after :deploy, 'deploy:cleanup'

namespace :barometre do
  task :assets_build do
      capifony_pretty_print "--> Installing Ruby dependencies"
      invoke_command "cd #{latest_release} && #{bundler_bin} install --path ./bundle/", :via => run_method
      capifony_puts_ok

      capifony_pretty_print "--> Installing Node dependencies"
      invoke_command "cd #{latest_release} && npm install", :via => run_method
      capifony_puts_ok

      capifony_pretty_print "--> Installing Bower dependencies"
      invoke_command "cd #{latest_release} && bower install", :via => run_method
      capifony_puts_ok

      capifony_pretty_print "--> Launching grunt to compile assets"
      invoke_command "cd #{latest_release} && grunt", :via => run_method
      capifony_puts_ok
  end
end
