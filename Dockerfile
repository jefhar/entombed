# jefhar/entombed
# For unit testing and deployment
# Set the base image for subsequent instructions
FROM phpdockerio/php74-fpm:latest
ARG BUILD_DATE
ARG VCS_REF

LABEL maintainer="Jeff Harris <jeff@jeffharris.us>" \
  org.label-schema.build-date=$BUILD_DATE \
  org.label-schema.description="Entombed 8-bit map generator." \
  org.label-schema.name="main.entombed" \
  org.label-schema.schema-version="1.0" \
  org.label-schema.url="https://entombed.jeffharris.us" \
  org.label-schema.vcs-ref=$VCS_REF \
  org.label-schema.vcs-url="https://gitlab.com/jefhar/entombed" \
  PHP="7.4"

# Update packages
RUN apt-get update \
    && apt-get -y remove php-apcu \
        php7.4-curl \
        php7.4-mbstring \
        php7.4-xml \
        php7.4-zip \
	&& apt-get -y --no-install-recommends install \
	    make \
    && apt-get install -y --only-upgrade php7.4-cli php7.4-common \
    && apt-get autoremove -y \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Update composer
RUN  composer self-update
