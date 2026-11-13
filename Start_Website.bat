@echo off
title Mera Haq Legal Portal
color 0A

set WEB_DIR=%~dp0
set PHP_EXE=C:\Users\pc\php\php.exe

if not exist "%PHP_EXE%" (
    where php >nul 2>nul
    if %ERRORLEVEL% equ 0 (
        set PHP_EXE=php
    ) else (
        echo [ERROR] PHP interpreter not found at C:\Users\pc\php\php.exe
        pause
        exit /b 1
    )
)

:: Check if server is running on port 8000
netstat -ano | findstr :8000 | findstr LISTENING >nul 2>nul
if %ERRORLEVEL% equ 0 (
    echo [OK] Server is active on port 8000.
) else (
    echo [..] Starting PHP server on http://localhost:8000 ...
    start /min "MeraHaqServer" "%PHP_EXE%" -S localhost:8000 -t "%WEB_DIR%"
    timeout /t 2 /nobreak >nul
)

:: Launch in default browser
echo [OK] Opening Mera Haq Portal in browser...
start "" "http://localhost:8000"
exit
