Tasaka Managara
===================

Import schema.sql

Create a config folder, then make 2 files (change values if needed):

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

Try accessing the site from __BASE_URL
