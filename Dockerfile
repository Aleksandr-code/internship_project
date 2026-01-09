FROM node:20-alpine AS front

WORKDIR /app
COPY ./app ./

WORKDIR /app/assets/vue
RUN npm install
RUN npm run build

FROM webdevops/php-nginx-dev:8.4

ENV WEB_DOCUMENT_ROOT=/app/public
ENV WEB_DOCUMENT_INDEX=index.php
ENV PHP_DISMOD=ioncube

WORKDIR /app

COPY ./app /app
COPY --from=front /app/public/build ./public/build

RUN composer install

RUN php bin/console lexik:jwt:generate-keypair

RUN chown -R www-data:www-data var/ public/

ENV APP_ENV=prod
ENV APP_DEBUG=false

EXPOSE 80

CMD ["supervisord"]