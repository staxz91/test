FROM nginx

ADD ./docker/nginx/vhost.conf /etc/nginx/conf.d/default.conf

RUN ln -sf /dev/stdout /var/log/nginx/access.log && ln -sf /dev/stderr /var/log/nginx/error.log

RUN apt-get update

RUN apt-get install -y vim

WORKDIR /var/www
