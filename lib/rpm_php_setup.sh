#!/usr/bin/env bash

yum -y install epel-release

yum -y install http://rpms.remirepo.net/enterprise/remi-release-7.rpm

yum -y install yum-utils

yum-config-manager --enable remi-php72

yum update

yum -y install php72

yum -y install php72-php-fpm php72-php-gd php72-php-json php72-php-mbstring \
	php72-php-mysqlnd php72-php-xml php72-php-xmlrpc php72-php-opcache





