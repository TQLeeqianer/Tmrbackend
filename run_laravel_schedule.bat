@echo off
set PHP_PATH=C:\laragon\bin\php\php-8.1.10-Win32-vs16-x64\php.exe
set LARAVEL_PATH=C:\laragon\www\fyp

cd %LARAVEL_PATH%
%PHP_PATH% artisan schedule:run
