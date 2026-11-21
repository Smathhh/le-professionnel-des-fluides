@echo off
title LE PROFESSIONNEL DES FLUIDES - Server Launcher
echo ===================================================
echo   LE PROFESSIONNEL DES FLUIDES - SERVEUR LOCAL
echo ===================================================
echo.
echo 1. Lancement du serveur Laravel sur le port 8001...
start "Laravel Server (Port 8001)" cmd /k "php artisan serve --host=0.0.0.0 --port=8001"

timeout /t 2 /nobreak >nul

echo 2. Ouverture automatique du site dans votre navigateur...
start http://localhost:8001

echo.
echo 3. Lancement du tunnel HTTPS fixe pour l'application Android...
start "Tunnel Mobile Android (Fixe)" cmd /k "npx --yes localtunnel --port 8001 --subdomain phem-industrie-app"

echo.
echo 4. Lancement de l'emulateur Android Pixel 8 avec l'application...
echo    (Suppression des fichiers lock si l'emulateur etait plante)
del /f /q "%USERPROFILE%\.android\avd\Pixel_8.avd\*.lock" 2>nul

start "Emulateur Android Pixel_8" cmd /k ""%LOCALAPPDATA%\Android\Sdk\emulator\emulator.exe" -avd Pixel_8"

echo.
echo    Attente du demarrage de l'emulateur (45 secondes)...
timeout /t 45 /nobreak

echo.
echo 5. Configuration ADB - Connexion au serveur local depuis l'emulateur...
"%LOCALAPPDATA%\Android\Sdk\platform-tools\adb.exe" wait-for-device
"%LOCALAPPDATA%\Android\Sdk\platform-tools\adb.exe" reverse tcp:8001 tcp:8001

echo.
echo 6. Installation de l'APK sur l'emulateur...
"%LOCALAPPDATA%\Android\Sdk\platform-tools\adb.exe" install -r public\downloads\phem-industrie-admin.apk

echo.
echo 7. Lancement de l'application sur l'emulateur...
"%LOCALAPPDATA%\Android\Sdk\platform-tools\adb.exe" shell am start -n com.phemindustrie.admin/.MainActivity

echo.
echo ===================================================
echo [OK] Tout est lance et actif !
echo.
echo   ACCES WEB :
echo   - Sur votre PC    : http://localhost:8001
echo   - Tunnel Mobile   : https://phem-industrie-app.loca.lt
echo.
echo   ACCES ADMIN :
echo   - Email           : admin@phemindustrie.ma
echo   - Mot de passe    : admin123
echo   - PIN Mobile      : 1234
echo.
echo   APK Android       : http://localhost:8001/downloads/phem-industrie-admin.apk
echo ===================================================
pause
