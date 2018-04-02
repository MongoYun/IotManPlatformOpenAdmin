	location / {
			root /var/www;
			index index.html index.htm index.php;
			if (!-e $request_filename) {
			rewrite ^/index.php(.*)$ /index.php?s=$1 last;
			rewrite ^(.*)$ /index.php?s=$1 last;
			break;
			}
	}
	
	location ~ .*\.(gif|jpg|jpeg|png|bmp|swf)$
	{
		expires      30d;
	}

	location ~ .*\.(js|css|woff|woff2|ttf|map|zip)?$
	{
		expires      12h;
	}

	location ~ /.well-known {
		allow all;
	}
