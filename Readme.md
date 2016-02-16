
### Camagru

# controllers
	login
	inscription
	gallery
	profile
	montage

# models
	users
	images


# views
	login
	inscription
	gallery
	profile
	montage


# bonus
  js sur le formulaire d'inscription
  https

# prerequire
  config mamp for https:
  	gen cert in apache2/conf
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
