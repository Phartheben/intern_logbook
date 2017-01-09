#!/bin/bash

chmod -R a+w storage/logs

composer install

if [ -f "vendor/propel/propel1/runtime/lib/Propel.php" ]
then
    if [ -f "config/propel/patch/Propel.php" ]
    then
        cp config/propel/patch/Propel.php vendor/propel/propel1/runtime/lib/Propel.php
    fi
fi

git update-index --assume-unchanged config/orm-conf-buildtime.php
git update-index --assume-unchanged config/propel/config/build.properties
git update-index --assume-unchanged config/propel/config/buildtime-conf.xml
git update-index --assume-unchanged config/propel/config/runtime-conf.xml

composer dump-autoload