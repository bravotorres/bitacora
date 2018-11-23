# Bitacora
Proyecto de colaboración.

## Requerimientos de sistema:
### Windows
* XAMPP for Windows 7.2.7

### Unix-like: Debian 
* LinuxMint DE 2 Betsy
* PHP 7.2
* MySQL community-server 5.5.6

### Unix-like: RHEL7/CentOS7
* CentOS 7
* PHP 7.2
* MySQL 8.0.13 for Linux on x86_64 (MySQL Community Server - GPL)
* Apache Server 2.4.6

## Instalación de entorno en Unix-like: Debian 
### Actualizar a partir de una version anterior de PHP
```bash
# Eliminamos versiones anteriores de PHP
oldphp="$(dpkg --list | grep php | awk '/^ii/{print $2}')"
apt-get --purge remove $oldphp -y

# Se agrega la clave pública del repositorio
wget -O - https://www.dotdeb.org/dotdeb.gpg | apt-key add -

# Se agrega el repositorio 'dotdeb.org' al sistema
cp dotdeb.org.list /etc/apt/sources.list.d/

# Actualización del sistema
apt-get update && apt-get upgrade -y && apt-get dist-upgrade -y

# Reemplazamos los anteriores paquetes con los actuales
newphp=`sed 's/php5/php7.0/g' <<< $oldphp`
apt-get install $newphp

# Visualizamos la version actual de PHP
php --version
```

## Instalación nueva de PHP 7.2
```bash
apt-get install -y apt-transport-https lsb-release ca-certificates

# Se agrega la clave pública del repositorio
wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg

# Se agrega el repositorio al sistema
echo "deb https://packages.sury.org/php/ jessie main" | sudo tee /etc/apt/sources.list.d/php.list

# Actualización del sistema
apt-get update && apt-get upgrade -y && apt-get dist-upgrade -y

# Instalación de nuevos paquetes a partir del repositorio
apt-get install -y php7.2 php7.2-cli php7.2-common php7.2-curl php7.2-gd php7.2-json php7.2-mbstring php7.2-mysql php7.2-opcache php7.2-readline php7.2-xml

# Visualizamos la version actual de PHP
php -v
```

## Instalación de entorno en Unix-like: RHEL7/CentOS7