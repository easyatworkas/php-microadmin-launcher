@echo off
title easy@work simple mode :)
cls

set PATH=%~dp0\php\php-8.0.27;%PATH%

call php -d curl.cainfo="%~dp0\php\cacert.pem" updater\update_client.php
call php -d curl.cainfo="%~dp0\php\cacert.pem" updater\update_microadmin.php

cd client
call php ..\composer\composer.phar install
cd ..

echo.
echo Update completed :)
echo Press any key to exit.
pause > nul
