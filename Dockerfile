# Use uma imagem oficial do PHP 8.2 como base
FROM php:8.2-fpm

# Instala dependências do sistema necessárias para o Laravel e o Composer
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instala as extensões PHP necessárias para o Laravel
RUN docker-php-ext-install pdo pdo_pgsql bcmath mbstring exif pcntl gd zip

# Instala o Composer (gerenciador de pacotes do PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho dentro do container
WORKDIR /app

# Copia os arquivos de dependência primeiro para aproveitar o cache do Docker
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader

# Copia o resto do código do seu projeto
COPY . .

# <<< ADICIONE A LINHA ABAIXO >>>
# Dá permissão para o nosso script de inicialização ser executado
RUN chmod +x /app/start.sh

# Gera o autoloader do Composer
RUN composer dump-autoload --optimize

# Muda a propriedade da pasta para o usuário do servidor web para evitar problemas de permissão
RUN chown -R www-data:www-data storage bootstrap/cache

# Expõe a porta que o Laravel vai usar
EXPOSE 8000
