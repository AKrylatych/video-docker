#!/bin/bash
# app settings
appname="openvideo-api"
ssh_creds="cherrydev"

# ENVS
POSTGRES_USER="postgres"
POSTGRES_PASSWORD="root"
POSTGRES_DB="video-docker"
DB_HOST="db.video-docker.online"

# Build and send image
podman build -t $appname .
rm ../btools/$appname.tar
podman save -o ../btools/$appname.tar $appname:latest
rsync -avz ../btools/$appname.tar $ssh_creds:~/$appname.tar

# Load and run image
ssh $ssh_creds "podman load -i $appname.tar"
ssh $ssh_creds "podman kill $appname"
ssh $ssh_creds "podman rm $appname"
ssh $ssh_creds "podman run -d --name $appname -p 8080:80 \
-e POSTGRES_USER=${POSTGRES_USER} \
-e POSTGRES_PASSWORD=${POSTGRES_PASSWORD} \
-e POSTGRES_DB=${POSTGRES_DB} \
-e DB_HOST=${DB_HOST} \
-v vidstorage:/usr/src/myapp/storage \
-v phpconfigs:/usr/local/etc/php \
--network internal $appname"

# Cleanup
ssh $ssh_creds "rm $appname.tar"