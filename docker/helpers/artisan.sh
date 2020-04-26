#!/bin/bash

root=$( cd "$(dirname "${BASH_SOURCE[0]}")/../.." ; pwd -P )

service_id=$(cd $root && cd app && docker-compose ps -q app)

if [ -z "$service_id" ]
then
	echo "Service (app) not running."
	exit 1
fi

str="$*"

docker exec -it $service_id php artisan $str
