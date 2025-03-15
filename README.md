# asrama

## Deploy Project Siakad

## 🚀 Introduction
This repository contains the source code for Project Sistem Informasi akademik - a web application built using html, css, javascipt, and php. This guide will walk you through the steps to deploy the application on your linux machine.

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
sudo apt install apache2 php php8.1-mysql php-xml php-zip php-curl php-mbstring php-gd mariadb git -y
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
mysql_secure_installation
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
git clone https://github.com/haikal23095/project-paw-siakad
cd project-paw-siakad
```

### 2️⃣ Login to database
```sh
mysql -u root -p
```
Enter password: [Your_Password]

### 3️⃣ Create Database
```sh
CREATE DATABASE siakad;
QUIT;
```

### 4️⃣ Import file sql ke Database
```sh
mysql -u root -p -i siakad < siakad.sql
```

### 5️⃣ Deploy to Hosting Provider
```sh
cd /etc/apache2/sites-available
a2dissite 000-default.conf
cp 000-default.conf siakad.com.conf
```
### 6️⃣ Edit virtualhost Apache
Edit file siakad.com using nano or vim, copy and replace down below
```sh
VirtualHost *:80>
        ServerAdmin webmaster@localhost
        DocumentRoot /var/www/siakad
        DirectoryIndex loginpage.php

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined

</VirtualHost>
```
### Exit and active the virtualhost
```sh
sudo a2ensite siakad.com
```
### Restart apahce2
```sh
systemctl restart apache2
```

### Buat directory dan copy contain in code directoy 
```sh
sudo mkdir /var/www/siakad && sudo cp -r ~/project-paw-siakad/. /var/www/siakad/ 
```

Goto Your Browser type http://YOUR_IP_ADDRESS

### ✅ Finish 🔥
