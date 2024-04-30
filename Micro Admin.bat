@echo off
title easy@work simple mode :)
cls

set PATH=%~dp0\php\php-8.0.27;%PATH%

cd microadmin

set EAW_LOG_LEVEL=INFO

call php -d curl.cainfo="%~dp0\php\cacert.pem" ..\client\eaw.php microadmin.php

echo The script exited.
pause
