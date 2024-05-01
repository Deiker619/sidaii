@echo off
rem Ruta al directorio de XAMPP
set "xampp_dir=C:\xampp"

rem Ruta al directorio de MySQL en XAMPP
set "mysql_dir=%xampp_dir%\mysql\bin"

rem Obtener la fecha y hora actual en un formato que sea seguro para nombres de archivos
for /f "delims=" %%a in ('wmic OS Get localdatetime ^| find "."') do set "fecha_hora=%%a"

rem Extraer partes de la fecha y la hora
set "anio=%fecha_hora:~0,4%"
set "mes=%fecha_hora:~4,2%"
set "dia=%fecha_hora:~6,2%"
set "hora=%fecha_hora:~8,2%"
set "minutos=%fecha_hora:~10,2%"
set "segundos=%fecha_hora:~12,2%"

rem Datos de conexión a MySQL
set "usuario=fmjgh"
set "contrasena=misionfmjgh"
set "nombre_db=conapdis"

rem Comando para iniciar MySQL
echo Iniciando MySQL...
start "" "%mysql_dir%\mysqld.exe" --console --standalone

rem Espera unos segundos para que MySQL se inicie completamente
timeout /t 5

rem Comando mysqldump
echo Realizando mysqldump...

rem Construir el nombre del archivo de volcado con la fecha y la hora
set "nombre_archivo=Conapdis_dump_%anio%-%mes%-%dia%_%hora%-%minutos%-%segundos%.sql"

"%mysql_dir%\mysqldump.exe" -u %usuario% -p%contrasena% %nombre_db% > "%nombre_archivo%"

echo Proceso completado. Presiona cualquier tecla para cerrar...
pause > nul

rem Detener MySQL
