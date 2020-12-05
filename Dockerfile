FROM php:7.4-cli
COPY . /app
WORKDIR /app
CMD [ "php", "-S", "localhost:8000", "-t", "public" ]