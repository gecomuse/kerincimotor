@echo off
echo ============================================
echo   KERINCI MOTOR - Development Server
echo ============================================
echo.
echo   Website : http://127.0.0.1:8888
echo   Admin   : http://127.0.0.1:8888/admin
echo   Katalog : http://127.0.0.1:8888/catalog
echo.
REM Kill any PHP on port 8888
for /f "tokens=5" %%a in ('netstat -aon ^| findstr :8888 2^>nul') do taskkill /F /PID %%a 2>nul
echo Starting Vite...
start "Vite" cmd /k "cd /d D:\= vscode\Kerinci Motor && npm run dev"
timeout /t 3 >nul
echo Starting PHP Server...
start "PHP" cmd /k "cd /d D:\= vscode\Kerinci Motor && C:\Users\dandy\.config\herd\bin\php84\php.exe -S 127.0.0.1:8888 server.php"
timeout /t 2 >nul
start http://127.0.0.1:8888
echo Done!
