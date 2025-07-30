#!/bin/sh

# O comando 'set -e' garante que o script irá parar se algum comando falhar.
set -e

# Limpa o cache de configuração para garantir que as variáveis de ambiente sejam lidas
php artisan config:clear

# <<< ADICIONE A LINHA ABAIXO >>>
# Cria o link da pasta 'storage' para tornar as imagens públicas
php artisan storage:link

# Roda as migrações do banco de dados.
php artisan migrate --force

# Inicia o servidor do Laravel.
exec php artisan serve --host 0.0.0.0 --port ${PORT}
