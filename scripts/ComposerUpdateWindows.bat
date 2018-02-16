@ECHO OFF
REM RUN IN WINDOWS FROM current directory with cmd.
REM TODO UPDATE client secret


ECHO OPEN DDM folder
cd ..

ECHO COMPOSER UPDATE
docker exec -u 1000 codecept-laravel-fpm bash -c "cd /app && composer update --no-ansi -o -n"

pause