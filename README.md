Tasaka Managara
===================
## Setup

Import schema.sql
Create a session folder at project root
Create a config folder at project root, then make 2 files within this folder (change config values if needed):

config/config.php:

```
<?php
  //NOTE: there is a trailing / at the end of __BASE_URL
  define("__BASE_URL","https://localhost/assg1/");
?>
```

config/database.php

```
<?php
	$db_config = array(
		'db_type' => 'pgsql',
		'db_host' => 'localhost',
		'db_port' => 5432,
		'db_name' => 'cp3101b-1',
		'db_username' => 'postgres',
		'db_password' => 'pass'
	);
?>
```
Edit .htaccess, fix index.php to /[folder_path]/index.php if needed. [e.g. /assg1/index.php?tr=]
Try accessing the site from __BASE_URL
## SoC server URL: 
https://192.168.20.241/~hvquang/todo/

## File permission: 
The /view/asset folder contains static files to serve user, pleaes allow accessing this folder from the web.


## Extra features: 
1. Revert work unit
2. Estimate task completion time
