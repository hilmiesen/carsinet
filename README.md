# CarsiNET

Bu ürün ADC ve WAF testlerinde kullanılmak üzere, mini bir e-ticaret sitesini baz alınarak yazılmıştır. 

Admin sayfasına /admin ile erişebilirsiniz. User/Pass: admin/admin
  
# DOCKER
Docker Container olarak kullanmak için: 

[https://github.com/hilmiesen/docker-carsinet]

# KURULUM:

1. Aşağıdaki komutları çalıştırarak paketleri sisteme kurun. 

apt-get update
apt-get install apache2 php libapache2-mod-php php-sqlite3 php-curl
a2enmod rewrite
service apache2 restart

2. /etc/apache2/sites-enabled/00-default.conf dosyasını aşağıdaki gibi ayarlayın. 

<VirtualHost *:80>
	ServerAdmin webmaster@localhost
	DocumentRoot /var/www/html
	<Directory "/var/www/html">
		AllowOverride All
	</Directory>
	ErrorLog ${APACHE_LOG_DIR}/error.log
	CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>


**Hilmi Esen**
