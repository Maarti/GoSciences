# Install Environment
Pour installer "lamp" :
```
sudo apt install apache2 php mysql-server libapache2-mod-php php-mysql
```

Pour installer mysql-workbench :
[Documentation officielle - installation](https://dev.mysql.com/doc/workbench/en/wb-installing-linux.html)


# Config

## PhP config
### Short tag
Pour activer les shorts tags "<?" en php sur notre serveur apache, on va modifier le php.ini utilisé par apache. C'est donc celui qui est situé dans :
```
sudo nano /etc/php/7.0/apache2/php.ini
```

Puis on modifie la ligne suivante :
```
short_open_tag=On
```

### Xdebug (colors and formating for var_dump)
Permet notamment de rendre plus lisibles les var_dump :
```
sudo apt-get install php-xdebug
sudo service apache2 restart
```

## Apache config
### AllowOverride
Pour autoriser la surcharge de la configuration par des .htaccess dans le dossier /var/www/, modifier la configuration d'apache2 :
```
sudo nano /etc/apache2/apache2.conf
```

Et passer AllowOverride à "All" :
```
    <Directory /var/www/>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
```

### RewriteEngine
Activer le module rewrite dans Apache2 (directement via CLI)
```
sudo a2enmod rewrite
```

Cela permet l'url rewriting définie dans le .htaccess à la racine :
```
RewriteEngine on
RewriteCond $1 !^(index\.php|resources|robots\.txt)
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php?/$1 [L,QSA] 
```

# Debug
Pour débuguer les erreurs Apache, vérifier le fichier :
```
tail /var/log/apache2/error.log
```
