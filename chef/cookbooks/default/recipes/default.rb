node.set['build_essential']['compiletime'] = true

include_recipe 'build-essential'
include_recipe 'ohai'
include_recipe 'bluepill'
include_recipe 'runit'

include_recipe 'mysql::server'

include_recipe 'mysql::client'

include_recipe 'database::mysql'

mysql_connection_info = {
  host: 'localhost',
  username: 'root',
  password: node['mysql']['server_root_password']
}

mysql_database 'atelie_dev' do 
  connection mysql_connection_info
  action :create
end

mysql_database 'atelie_test' do 
  connection mysql_connection_info
  action :create
end

node.set['nginx']['default_site_enabled'] = false
node.set['nginx']['source']['modules'] = ["http_gzip_static_module", "http_ssl_module"]
node.set['nginx']['sendfile'] = 'off'

include_recipe 'nginx'

if node[:environment] == 'development'
  node.set[:custom][:nginx_root] = '/vagrant/app/webroot'
end

node.set['nginx_conf']['confs'] = [
  "dev.atelie.com" => {
    'conf_name' => 'devatelie.com',
    'action' => :create,
    'root' => node[:custom][:nginx_root],
    'locations' => {
      '/' => {
        'index' => 'index.php index.html index.htm',
        'try_files' => '$uri $uri/ /index.php?$uri&$args'
      },
      '~ \.php$' => {
        'try_files' => '$uri =404',
        'include' => '/etc/nginx/fastcgi_params',
        'fastcgi_pass' => 'unix:/var/run/php-fpm-www.sock',
        'fastcgi_index' => 'index.php',
        'fastcgi_param' => 'SCRIPT_FILENAME $document_root$fastcgi_script_name'
      }
    }
  }
]

include_recipe 'nginx_conf'

node.set['php-fpm']['user'] = 'vagrant'
node.set['php-fpm']['group'] = 'vagrant'

include_recipe 'php-fpm'

package 'php5-mysql' do
  action :install
end

service 'php5-fpm' do
  action :reload
end

include_recipe 'ruby_build'
include_recipe 'rbenv'

rbenv_ruby '2.0.0-p247' do
  ruby_version '2.0.0-p247'
  global true
end

rbenv_gem 'bundler'