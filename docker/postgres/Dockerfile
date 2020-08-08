FROM postgres:12.3-alpine

COPY docker/postgres/postgresql.conf /etc/postgresql.conf

CMD ["postgres", "-c", "config_file=/etc/postgresql.conf"]