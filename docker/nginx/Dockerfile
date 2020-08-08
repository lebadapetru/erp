FROM nginx:1.19-alpine

WORKDIR /var/www/erp

COPY docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# give nginx permission to serve
RUN chown -R nginx:nginx /var/www/erp

CMD ["nginx", "-g", "daemon off;"]