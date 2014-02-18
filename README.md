Tasaka Managara
===================

To create schema: 

`sudo -u postgres  psql -U postgres -d cp3101b-1 -a -f schema.`

create a .htacess in the project folder (same folder as index.php)

```
AddType text/css .css

RewriteEngine on

RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d

RewriteRule ^(.*)$ index.php?rt=$1 [L,QSA]
# RewriteRule ^(.*)$ /hello.php
```

Create a config folder, then make 2 files (change values if needed):

config/config.php:

```
<?php
  define("__BASE_URL","http://localhost/assg1/");
?>
```

config/database.php

```
<?php
	$db_config = [
		'db_type' => 'pgsql',
		'db_host' => 'localhost',
		'db_port' => 5432,
		'db_name' => 'cp3101b-1',
		'db_username' => 'postgres',
		'db_password' => 'pass'
	];
?>
```

Try accessing the site from __BASE_URL
