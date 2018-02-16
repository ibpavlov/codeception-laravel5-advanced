#!/bin/bash
set -e

COMPOSE_FILE="docker-compose.yml";
APPLICATION_ENV="docker";

if [ "${DEPLOYMENT_GROUP_NAME}" = "GitlabTests" ]; then
    FRONT_HOST_NAME="${CONTAINER_NAME}.php.objectsystems.com";
    API_HOST_NAME="${CONTAINER_NAME}.api.php.objectsystems.com";
elif [ "${DEPLOYMENT_GROUP_NAME}" = "Gitlab" ]; then
    FRONT_HOST_NAME="${CONTAINER_NAME}.php.objectsystems.com";
    HOST_NAME="${CONTAINER_NAME}.api.php.objectsystems.com";
elif [ "${DEPLOYMENT_GROUP_NAME}" = "Development" ]; then
    HOST_NAME="codeception-laravel.local.com";
    BUILD_ROOT = ".\\";
fi

PROGNAME=$(basename ${0});

function error_exit
{
#   ----------------------------------------------------------------
#   Function for exit due to fatal program error
#           Accepts 1 argument:
#                   string containing descriptive error message
#   ----------------------------------------------------------------
    ERRSTR="${1:-Unknown Error}"
    echo "${PROGNAME} ERROR: ${ERRSTR}" 1>&2
    exit 1;
}

cd ${BUILD_ROOT};

if [ ! -f .env ]; then
    echo "Copy .env from .env example for the back-end";
    cp .env.example .env;

    echo "Replace .env file variables";
    sed -i "s/COMPOSE_PROJECT_NAME=codeception-laravel/COMPOSE_PROJECT_NAME=${CONTAINER_NAME}/g" .env;
    sed -i "s/HOST_NAME=codeception-laravel.local.com/HOST_NAME=${HOST_NAME}/g" .env;
    sed -i "s/APPLICATION_ENV=docker/APPLICATION_ENV=${APPLICATION_ENV}/g" .env;

fi

# Check if we must update the env
if [ "$(stat -c %Y .env.example)" -gt "$(stat -c %Y .env)" ]; then
    echo ".env modified: $(date -d @$(stat -c %Y .env) '+%Y-%m-%d %H:%M:%S')";
    echo ".env.example modified: $(date -d @$(stat -c %Y .env.example) '+%Y-%m-%d %H:%M:%S')";
    error_exit "${LINENO}: .env.example is newer than .env!!!";
fi

#source the .env file, so we can have access to the variables listed there
source .env;

docker pull objectsystems/nginx:1.11.12;
docker pull objectsystems/php:${PHP_VERSION};

# rebuild and recreate containers
if docker-compose -f ${COMPOSE_FILE} up -d --build --force-recreate; then
    echo "Docker container(s) started!";
else
    error_exit "$LINENO: Starting docker container(s) FAILED!";
fi

if [ "${BRANCH_NAME}" = "development" ]; then
    echo "Run composer with development requirements";
    docker exec -u 1000 ${CONTAINER_NAME}-fpm bash -c "cd /app && composer update --no-ansi -o -n"
else
    echo "Run composer";
    docker exec -u 1000 ${CONTAINER_NAME}-fpm bash -c "cd /app && composer update --no-ansi --no-dev -o -n"
fi

if [ "${DEPLOYMENT_GROUP_NAME}" = "Gitlab" OR "${DEPLOYMENT_GROUP_NAME}" = "Development" ]; then
    echo "Done, please navigate to https://${HOST_NAME}";
fi

exit 0;
