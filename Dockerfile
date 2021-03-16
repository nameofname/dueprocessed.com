# FROM wordpress:latest
FROM wordpress:5.6
RUN apt-get update \
    && apt-get install -y \
        nmap \
        vim