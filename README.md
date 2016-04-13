# ZeCollection

xampp : 
Pour windows: 

> intaller xamp
> aller dans xampp/apache/conf/extra/httpd-vhosts.conf
> Rajouter à la fin du fichier : 
# localhost
<VirtualHost *:80>
    ServerName localhost
    DocumentRoot "F:/Programmes/Pas Jeux/Xampp/htdocs"
    <Directory "F:/Programmes/Pas Jeux/Xampp/htdocs">
        Options Indexes FollowSymLinks Includes execCGI
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>




# My custom host
<VirtualHost *:80>
    ServerName bo.localhost
    DocumentRoot ""F:/Programmes/Pas Jeux/Xampp/htdocs/bo"
    <Directory ""F:/Programmes/Pas Jeux/Xampp/htdocs/bo">
        Options Indexes FollowSymLinks Includes ExecCGI
        AllowOverride All
        Require all granted
    </Directory>
    ErrorLog "logs/bo.local-error_log"
</VirtualHost>


> ajout du virtual host dans windows: 
C:/Windows/System32/drivers/etc/hosts
127.0.0.1 localhost
127.0.0.1 bo.localhost
j’ai pas trouvé comment faire des lien symbolique dont pour le virtual host j’ais mis ou etait mon proj


Pour le conflit avec skype : 
ouvrir skype aller dans option, parametre avancé, connection et decocher utiliser les port 80 et 443. On redemarre sskype et c'est bon
