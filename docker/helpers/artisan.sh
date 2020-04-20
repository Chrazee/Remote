#!/bin/bash

str="$*"

docker exec -it remote_app php artisan $str
