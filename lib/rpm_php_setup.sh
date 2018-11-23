#!/usr/bin/env bash

yum -y install epel-release

yum -y install http://rpms.remirepo.net/enterprise/remi-release-7.rpm

yum -y install yum-utils

yum-config-manager --enable remi-php72

yum update

yum -y install httpd php php-mysql php-devel php-gd php-pecl-memcache php-pspell php-snmp php-xmlrpc php-xml

apachectl restart

echo -e "PHP7.2 & Apache instalados."





