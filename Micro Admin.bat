@echo off
title easy@work simple mode :)
cls

set PATH=%~dp0\php\php-8.0.27;%PATH%

call php -d curl.cainfo="%~dp0\php\cacert.pem" client\eaw.php microadmin\microadmin.php

echo The script exited.
pause
