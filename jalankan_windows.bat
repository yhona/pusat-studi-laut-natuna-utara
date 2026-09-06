@echo off
title North Natuna Sea Research Center UMRAH
echo =======================================================
echo  Menjalankan Portal North Natuna Sea Research Center UMRAH
echo =======================================================
echo Membuka server lokal di port 8080...
echo Buka browser dan akses: http://localhost:8080
echo Atau untuk presentasi: http://localhost:8080/presentation.html
php spark serve --host 0.0.0.0 --port 8080
pause
