#!/usr/bin/env bash

docker-compose up -d
docker-compose exec printful_php composer install
