# Install Environment
Pour installer "lamp" :
    ```sudo apt install apache2 php mysql-server libapache2-mod-php php-mysql```

Pour installer mysql-workbench :
[Documentation officielle - installation](https://dev.mysql.com/doc/workbench/en/wb-installing-linux.html)



# Config

## Short tag
Pour activer les shorts tags "<?" en php sur notre serveur apache, on va modifier le php.ini utilisé par apache. C'est donc celui qui est situé dans :
    ```sudo nano /etc/php/7.0/apache2/php.ini```

Puis on modifie la ligne suivante :
    ```short_open_tag=On```

## AllowOverride
Pour autoriser la surcharge de la configuration par des .htaccess dans le dossier /var/www/, modifier la configuration d'apache2 :
    ```sudo nano /etc/apache2/apache2.conf```

Et passer AllowOverride à "All" :
```    <Directory /var/www/>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>```

## RewriteEngine
Activer le module rewrite dans Apache2 (directement via CLI)
    ```sudo a2enmod rewrite```



# Debug
Pour débuguer les erreurs Apache, vérifier le fichier :
    ```tail /var/log/apache2/error.log```
