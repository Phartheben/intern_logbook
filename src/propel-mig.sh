#!/bin/bash

export PATH=$PATH:vendor/bin

php artisan propel:build-config

cd config/propel/config
../../../vendor/bin/propel-gen convert-conf
../../../vendor/bin/propel-gen diff
../../../vendor/bin/propel-gen migrate
