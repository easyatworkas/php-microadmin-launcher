@echo off
title easy@work logout
cls

echo Logging out of easy@work...

del /f client\.auth.json 2>nul

echo Done :)

pause
