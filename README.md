# Asrama

## Deploy Project Asrama

## 🚀 Introduction
This repository contains the source code for Project Asrama UTM - a web application built using html, css, javascipt, and php. This guide will walk you through the steps to deploy the application on your linux machine.

## 📌 Prerequisites
Before deploying, make sure you have:
- Ubuntu or Debian Distributions
- Connect to internet
- Installed Apache or Nginx  Web Srv, Php, Mysql or Mariadb, git, and other php library pack supported on your Machine.

## 📌 How To setup Prereuisites
### 1️⃣ Update repo and upgrade package
```sh
sudo apt update && sudo apt upgrade -y
```
### 2️⃣ Install Dependencies
```sh
sudo apt install apache2 php php8.2-mysql php-mysql php-xml php-zip php-curl php-mbstring php-gd mariadb-server git -y
```
### 3️⃣ Start and enable apache
```sh
sudo systemctl start apache2 && sudo systemctl enable apache2
sudo systemctl start mariadb
```

### 4️⃣ Check the php configuration
```sh
echo "<?php echo phpinfo(); ?>" > info.php
sudo mv info.php /var/www/html
```
Check info php on your browser =>  type http://[your_ip_address]/info.php

### 5️⃣ Configure mysql secure instalation
```sh
sudo mysql_secure_installation
```
### Enter the answer like below
- Enter current password for root (enter for none): 
- Switch to unix_socket authentication [Y/n] : Y
- Change the root password? [Y/n] : Y
- New password: 
- Re-enter new password:
- Remove anonymous users? [Y/n] : Y
- Disallow root login remotely? [Y/n] : N
- Remove test database and access to it? [Y/n] : Y
- Reload privilege tables now? [Y/n] : Y

#### ✅ **Setup Finished**


## 🛠 Deployment Steps

### 1️⃣ Clone the Repository
```sh
git clone https://github.com/haikal4002/workshop-cloud
cd workshop-cloud
```

### 2️⃣ Login to database
```sh
mysql -u root -p
```
Enter password: [Your_Password]

### 3️⃣ Create Database
```sh
CREATE DATABASE asrama;
QUIT;
```

### 4️⃣ Import file sql ke Database
```sh
mysql -u root -p -i asrama < 'asrama (5).sql'
```

### 5️⃣ Deploy to Hosting Provider
```sh
cd /etc/apache2/sites-available
a2dissite 000-default.conf
sudo cp 000-default.conf asrama.com.conf
```
### 6️⃣ Edit virtualhost Apache
Edit file siakad.com using nano or vim, copy and replace down below
```sh
VirtualHost *:80>
        ServerAdmin webmaster@localhost
        DocumentRoot /var/www/asrama
        DirectoryIndex login_warga.php

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined

</VirtualHost>
```
### Exit and active the virtualhost
```sh
sudo a2ensite asrama.com.conf
```
### Restart apahce2
```sh
sudo systemctl restart apache2
```

### Buat directory dan copy contain in code directoy 
```sh
sudo mkdir /var/www/asrama && sudo cp -r ~/workshop-cloud/. /var/www/asrama/ 
```

*Goto Your Browser type http://YOUR_IP_ADDRESS*

### ✅ Finish 🔥
