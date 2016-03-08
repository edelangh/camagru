
# Camagru

### TODO
Indiquer une erreur si la base de donnee n'est pas installee

### controllers
login
inscription
gallery
profile
montage

### models
users
images


### views
login
inscription
gallery
profile
montage

### bonus
js sur le formulaire d'inscription
https
params: nbr dans l'url pour choissir la taille de la pagination
snapshot: avant de send la photo
unlike
perso

### prerequire
####config mamp for https:
[generate cert in apache2/conf](http://www.akadia.com/services/ssh_test_certificate.html)
add this to your httpd-vhost.conf of project

```
SSLEngine on
SSLCertificateFile /nfs/zfs-student-3/users/edelangh/mamp/apache2/conf/ssl.crt
SSLCertificateKeyFile /nfs/zfs-student-3/users/edelangh/mamp/apache2/conf/ssl.key	
```

finaly add include in your apache2/conf/extra/httpd-ssl.conf

```
Include "/nfs/zfs-student-3/users/edelangh/mamp/apps/camagru/conf/httpd-vhosts.conf"
```

config pour les mail:
dans le php.ini
rechercher sendmail_path / decomenter la ligne et ajouter son email a la fin
```
	sendmail_path = "env -i /usr/sbin/sendmail -t -i fpage@student.42.fr"
```
