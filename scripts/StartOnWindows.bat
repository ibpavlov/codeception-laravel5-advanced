@ECHO OFF
REM RUN IN WINDOWS FROM current directory with cmd.
REM TODO UPDATE client secret


ECHO OPEN DDM folder
cd ..

ECHO RECREATE DOCKER
docker-compose -f docker-compose-windows.yml up -d --build --force-recreate

pause