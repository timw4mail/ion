#!/bin/sh

# We need to install dependencies only for Docker
[[ ! -e /.dockerenv ]] && [[ ! -e /.dockerinit ]] && exit 0

set -xe

# Install git (the php image doesn't have it) which is required by composer
apk upgrade --update && apk add --no-cache \
	g++ \
	make \
	autoconf \
	curl \
	git \
	phpdbg
	
# Install phpunit, the tool that we will use for testing
curl -Lo /usr/local/bin/phpunit https://phar.phpunit.de/phpunit.phar
chmod +x /usr/local/bin/phpunit

# Install extensions
# Install xdebug for coverage report
# docker-php-source extract
# pecl install xdebug
# docker-php-ext-enable xdebug
# docker-php-source delete
