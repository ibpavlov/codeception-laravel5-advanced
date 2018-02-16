@ECHO OFF
REM RUN IN WINDOWS FROM current directory with cmd.
REM TODO UPDATE client secret


ECHO Codeception command
cd ..
docker exec -u 1000 codecept-laravel-fpm bash -c "cd /app && vendor/bin/codecept"

:loop
set /p commandCodecept=Enter command for Codeception (type exit to stop):
if "%commandCodecept%"=="exit" goto exit
ECHO Codecept
docker exec -u 1000 codecept-laravel-fpm bash -c "cd /app && vendor/bin/codecept %commandCodecept%"
goto :loop
:exit
pause