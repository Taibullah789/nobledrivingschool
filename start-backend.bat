@echo off
echo Starting Noble Driving Academy Backend Server...
echo.
echo This will start a PHP server on http://localhost:8080
echo Press Ctrl+C to stop the server
echo.
cd backend
php -S localhost:8080 -t .
