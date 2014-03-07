GT-nginx-RTMP-Streaming-Server
-----------------------------
The primary purpose of this project involves providing a streaming interface for GT students to utilize in order to
decrease reliance on delayed twitch.tv servers and provide a communal setting for student to student streaming interaction.  

Building
---------
Install packages for building nginx
'$ sudo apt-get install build-essential libpcre3 libpcre3-dev libssl-dev'

Download nginx tarball
'$ wget http://nginx.org/download/nginx-1.5.11.tar.gz'

Download rtmp module for nginx
'$ wget https://github.com/arut/nginx-rtmp-module/archive/master.zip'

Extract both downloads
'$ tar -zxvf nginx-1.5.11.tar.gz
$ unzip master.zip
$ cd nginx-1.5.11'

Build nginx
'$ ./configure --with-http_ssl_module --add-module=../nginx-rtmp-module-master
$ make
$ sudo make install'  

Running
-------
Simply run nginx, typically installed to '/usr/local/nginx/sbin/nginx'

To run nginx
'$ sudo /usr/local/nginx/sbin/nginx'

To stop nginx
'$ sudo /usr/local/nginx/sbin/nginx -s stop'

Then simply replace the directories and their contents within /usr/local/nginx with the directories from this repository to test it out
