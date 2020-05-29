#!/bin/bash
# Run project on container php7.4
docker exec -it laravel_docker_php bash -c "php $(printf ' %q' "$@")"
