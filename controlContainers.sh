#!/usr/bin/env bash

docker-compose -f docker/docker-compose.yml "$1" "$2"

#docker-compose -f docker/docker-compose.yml up --build --force-recreate

#docker exec -it docker_php_1 /bin/sh

#docker exec -it docker_postgres_1 psql -h postgres -U erp