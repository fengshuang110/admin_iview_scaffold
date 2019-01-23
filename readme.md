##Vue + Iview + lumen  Admin 脚手架

###先上图 演示地址 http://121.40.203.96/ admin  / admin123
![](https://i.imgur.com/waUcCMU.png)  ![](https://i.imgur.com/fkCwTZA.png)
![](https://i.imgur.com/MO9B91G.png)  ![](https://i.imgur.com/4hUfljh.png)
![](https://i.imgur.com/OfQ2jlC.png)	![](https://i.imgur.com/x3WBwJ4.png)
![](https://i.imgur.com/rjPEfps.png)
###简介
此项目是一个后台开发脚手架，项目功能从后端分层  前端分层做了规划，实现管理员，角色,菜单，权限基础的功能

后续开发人员只需要不断在在基础上堆业务代码即可 

另外我的另外一个项目是前台API脚手架，
	主要会涵盖，直接调用即可用，可以和业务功能解耦
	
- 	支付
- 		三方登录
- 		推送
- 		邮件/短信
-  		队列
- 		定时任务
- 		分库
- 		日志监控
- 		swoole


###使用的框架

	
- php lumen
- vue2.0+
- iview 前端css组件库


###安装



- git clone 


- composer install 





###配置后端Api

	nginx：

	 server {
        listen       8081;
        server_name  localhost;
        root /data/www/admin_iview_scaffold/public;
        index  index.php index.html;
        location / { 
            try_files $uri $uri/ /index.php?$args; 
        } 

      
        location ~ \.php$ {
            fastcgi_pass   127.0.0.1:9001;
            fastcgi_index  index.php;
            fastcgi_param  SCRIPT_FILENAME  $document_root/$fastcgi_script_name;
            include        fastcgi_params;
        }
    }

###运行前端
- npm install 

- npm run dev


###解决跨域
	1 nginx 反向代理
	
	server {
	  listen 80;
	  server_name 127.0.0.1;
	
	  set $web_root 前端build的目录/dist;
	
	  location / {
	    root   $web_root;
	    index index.html;
	    try_files $uri $uri/ /index_prod.html =404;
	  }
	
	  location /api {
	    rewrite ^/api/(.*) /$1 break;
	    proxy_pass http://127.0.0.1:82;
	    proxy_set_header X-Real-IP $remote_addr;
	    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
	  }
	
	}

	2 临时开发解决  public/index.php 更改为前端地址 比如http://localhost:88
		header('Access-Control-Allow-Origin: http://localhost:88');
		header('Access-Control-Allow-Credentials: true');
		header('Access-Control-Allow-Methods:POST,GET,OPTIONS');
		header('Access-Control-Allow-Headers:x-requested-with, content-type');
		
		if (strtolower($_SERVER['REQUEST_METHOD']) == 'options') {
		    exit;
		}


###加群讨论