#! /bin/sh

apt-get -y update && apt-get -y upgrade

if command -v node >/dev/null 2>&1; then
    echo "Node.js is installed."
    node -v
else
    echo "Installing node..."
    curl -fsSL https://deb.nodesource.com/setup_21.x | bash - &&\
    apt-get install -y nodejs
    npm install -D tailwindcss
    npx tailwindcss init

    # npx tailwindcss -i ./src/input.css -o ./src/output.css --watch // for tailwind build
fi

if ! [ -f "/bin/bash" ]; then
	apt-get install -y bash
fi

if ! [ -d "/etc/php/8.2" ]; then
    apt-get install -y php8.2-fpm php8.2-pgsql
fi

if ! [ -d "/var/www/html" ]; then
	mkdir -p /var/www/html/camagru
    chmod -R 777 /var/www/html/camagru
fi

sed -i 's/user\s*nginx;/user www-data;/g' /etc/nginx/nginx.conf

echo "Setting up fpm-cgi pool config..."
sed -i "s/^;\s*ping.path\s*=\s*\/ping/ping.path = \/ping/g" /etc/php/8.2/fpm/pool.d/www.conf
sed -i "s/^;\s*ping.response\s*=\s*pong/ping.response = pong/g" /etc/php/8.2/fpm/pool.d/www.conf
echo "Finished setting up fpm-cgi"

echo "Setting up php.ini..."
sed -i "s/^;\s*cgi.fix_pathinfo=[0-9]/cgi.fix_pathinfo=0/g" /etc/php/8.2/fpm/php.ini
echo "Finished setting up php.ini"

php-fpm8.2
