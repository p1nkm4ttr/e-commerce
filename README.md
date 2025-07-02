# e-commerce
My project at my internship for Naheed.
Add 
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/myadmin/public"
    ServerName myadmin.local
</VirtualHost>

<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/myshop/public"
    ServerName myshop.local
	<Directory "C:/xampp/htdocs/myshop/public">
        Options Indexes FollowSymLinks MultiViews
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
to
C:\xampp\apache\conf\extra\httpd-vhosts.conf

and add
127.0.0.1       myadmin.local
127.0.0.1       myshop.local
to 
C:\Windows\System32\drivers\etc\hosts
