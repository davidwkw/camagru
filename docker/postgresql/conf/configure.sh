#! /bin/sh

echo "Substituting environment variables for /etc/postgresql.conf..."
sed -i 's/^port\s*=\s*5432/port = ${DB_PORT}/g' /etc/postgresql.conf
