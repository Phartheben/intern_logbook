<?php
// This file generated by Propel 1.7.1 convert-conf target
// from XML runtime conf file /usr/local/var/www/intern_logbook/src/config/propel/config/runtime-conf.xml
$conf = array (
  'datasources' => 
  array (
    'orm' => 
    array (
      'adapter' => 'mysql',
      'connection' => 
      array (
        'dsn' => 'mysql:host=127.0.0.1;port=3306;dbname=intern_logbook;charset=utf8',
        'user' => 'root',
        'password' => '',
      ),
    ),
    'default' => 'orm',
  ),
  'generator_version' => '1.7.1',
);
$conf['classmap'] = include(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'classmap-orm-conf.php');
return $conf;