#!/bin/sh

# O comando 'set -e' garante que o script irá parar se algum comando falhar.
set -e

# Roda as migrações do banco de dados.
php artisan migrate --force

# Inicia o servidor do Laravel.
# O 'exec' no final é uma otimização para que o 'php artisan serve' se torne o processo principal.
exec php artisan serve --host 0.0.0.0 --port ${PORT}
