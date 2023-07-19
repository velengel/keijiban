# ベースイメージを指定
FROM php:7.4-apache

# Apacheの設定ファイルをコンテナ内にコピー
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# ドキュメントルートにアプリケーションファイルをコピー
COPY . /var/www/html

# Dockerfile内で直接 php.ini の内容を設定
RUN echo "post_max_size = 100M" >> /usr/local/etc/php/php.ini \
    && echo "upload_max_filesize = 100M" >> /usr/local/etc/php/php.ini


# 必要なPHP拡張をインストール
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo_mysql

RUN a2enmod rewrite

# ポートの公開
EXPOSE 80

# コンテナ起動時にApacheを実行
CMD ["apache2-foreground"]
