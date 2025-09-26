@echo off
echo ===============================
echo 🔄 Resetando projeto Laravel...
echo ===============================

:: Apagar pasta vendor
IF EXIST vendor (
    echo Removendo vendor...
    rmdir /s /q vendor
)

:: Apagar caches do Laravel
IF EXIST storage\framework\cache (
    echo Limpando cache...
    del /s /q storage\framework\cache\*
)
IF EXIST storage\framework\sessions (
    echo Limpando sessions...
    del /s /q storage\framework\sessions\*
)
IF EXIST storage\framework\views (
    echo Limpando views compiladas...
    del /s /q storage\framework\views\*
)

:: Apagar composer.lock
IF EXIST composer.lock (
    echo Removendo composer.lock...
    del /q composer.lock
)

:: Limpar cache do Composer e reinstalar dependências
echo Limpando cache do Composer...
composer clear-cache

echo Instalando dependencias...
composer install

:: Limpar caches do Laravel e gerar chave
echo Limpando caches do Laravel...
php artisan key:generate
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

:: Rodar migrations
echo Rodando migrations...
php artisan migrate

echo ===============================
echo ✅ Reset concluido!
echo ===============================
pause
