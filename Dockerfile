# jefhar/entombed:pcov
# For unit testing and deployment
# Set the base image for subsequent instructions
FROM jefhar/entombed:latest

# Update packages
RUN apt-get update \
	&& apt-get -y --no-install-recommends install \
	    php7.4-pcov \
    && apt-get autoremove -y \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
