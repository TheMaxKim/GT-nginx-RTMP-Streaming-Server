GT-nginx-RTMP-Streaming-Server
-----------------------------
The primary purpose of this project involves providing a streaming interface for GT students to utilize in order to
decrease reliance on delayed twitch.tv servers and provide a communal setting for student to student streaming interaction.  

Building
---------
Install packages for building nginx  
<pre><code>$ sudo apt-get install build-essential libpcre3 libpcre3-dev libssl-dev</code></pre>  

Download nginx tarball  
<pre><code>$ wget http://nginx.org/download/nginx-1.5.11.tar.gz</code></pre>  

Download rtmp module for nginx  
<pre><code>$ wget https://github.com/arut/nginx-rtmp-module/archive/master.zip</code></pre>  

Extract both downloads  
<pre><code>$ tar -zxvf nginx-1.5.11.tar.gz  
$ unzip master.zip  
$ cd nginx-1.5.11</code></pre>  

Build nginx
<pre><code>$ ./configure --with-http_ssl_module --add-module=../nginx-rtmp-module-master  
$ make  
$ sudo make install</code></pre>  

Running
-------
Replace the directories and their contents within /usr/local/nginx with the directories from this repository.  

Run nginx, typically installed to '/usr/local/nginx/sbin/nginx

To run nginx  
<pre><code>$ sudo /usr/local/nginx/sbin/nginx</code></pre>  

To stop nginx  
<pre><code>$ sudo /usr/local/nginx/sbin/nginx -s stop</code></pre>   
