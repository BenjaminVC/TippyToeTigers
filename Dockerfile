FROM varikmp/php:tools
MAINTAINER Varik Hoang &lt;varikmp@us.edu&gt;
ENV DEBIAN_FRONTEND=noninteractive


RUN apt-get update && apt-get install -y gcc \
	&& apt-get -y install sqlite3 \
	&& apt-get autoclean && apt-get autoremove && rm -rf /var/lib/apt/lists/*

# manually set up the environment variables 
ENV MY_USER ben
ENV MY_HOME /home/ben

# expose apache.
EXPOSE 80

# update the default apache site with the config we created. 
ADD homePage.php /var/www/html/homePage.php

# by default start up apache in the foreground, override with /bin/bash for interactive. 
CMD /usr/sbin/apache2ctl -D FOREGROUND & tail -f /var/log/apache2/*
