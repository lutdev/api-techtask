ARG MYSQL_VERSION=${MYSQL_VERSION}
FROM mysql:${MYSQL_VERSION}

LABEL maintainer="Andrew Lutskevich <karantin91@gmail.com>"

#####################################
# Set Timezone
#####################################

ARG TZ=UTC
ENV TZ ${TZ}
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN chown -R mysql:root /var/lib/mysql/

COPY my.cnf /etc/mysql/conf.d/my.cnf

CMD ["mysqld"]

ARG MYSQL_PORT
EXPOSE ${MYSQL_PORT}
