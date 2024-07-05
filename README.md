# About CarsiNET Project:  
  
- This product was written based on a mini e-commerce site to be used in ADC and WAF tests.

- You can access the admin page with /admin. User/Pass: admin/admin

  
# Docker Usage: 

[https://github.com/hilmiesen/docker-carsinet]


# Installation:

1. Install the packages to the system by running the following commands. 

```
apt-get update
apt-get install apache2 php libapache2-mod-php php-sqlite3 php-curl
a2enmod rewrite
service apache2 restart
```

2. Set the **/etc/apache2/sites-enabled/00-default.conf** file as follows. 

```
<VirtualHost *:80>
	ServerAdmin webmaster@localhost
	DocumentRoot /var/www/html
	<Directory "/var/www/html">
		AllowOverride All
	</Directory>
	ErrorLog ${APACHE_LOG_DIR}/error.log
	CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```

**Hilmi Esen**
