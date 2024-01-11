#! /bin/sh

sed -i 's/^port\s*=\s*5432/port = ${DB_PORT}/g' /etc/postgresql.conf
sed -i 's/${DB_NAME}/${DB_NAME}/g' /docker-entrypoint-initdb.d
