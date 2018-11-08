#Instalar apache2
sudo apt install apache2 -y

#Configurar apache2
#sudo cd /var/www
#sudo git clone https://github.com/andrea98gar/php.git
#sudo sed 's|/var/www/html|/var/www/php|' /etc/apache2/sites-enabled/000-default.conf

#Instalar php
sudo apt-get install php libapache2-mod-php -y

#Configurar php
sudo apt install php-mysql -y

#Instalar mysql
sudo apt install mysql-server mysql-common mysql-client -y

#sudo mysql --user=root --password=MetlG0710
#Ejecutar los siguientes comandos en mysql

#use mysql;
#select User, Host, plugin FROM mysql.user;
##Si en el apartado del root en el plugin aparece auth_socket ejecutar la siguiente:
#UPDATE user SET plugin='mysql_native_password' WHERE User='root';
#flush privileges;

#exit
#sudo cd /var/www/php
sudo mysql --user=root --password=MetlG0710 <sqlscript.sql

sudo systemctl restart apache2.service
sudo systemctl restart mysql.service
