FROM redis

ENV REDIS_PASSWORD jmi

CMD ["sh", "-c", "exec redis-server --requirepass \"$REDIS_PASSWORD\""]
