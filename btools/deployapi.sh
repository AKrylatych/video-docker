#!/bin/bash
appname="openvideo-api"
ssh_creds="cherrydev"

#ENVS

POSTGRES_USER="postgres"
POSTGRES_PASSWORD="root"
POSTGRES_DB="video-docker.online"
DB_HOST="console.video-docker.online"
podman build -t $appname .
rm ../btools/$appname.tar
podman save -o ../btools/$appname.tar $appname:latest
rsync -avz ../btools/$appname.tar $ssh_creds:~/$appname.tar
ssh $ssh_creds "podman load -i $appname.tar"
ssh $ssh_creds "podman kill $appname"
ssh $ssh_creds "podman rm $appname"
ssh $ssh_creds "podman run -d --name $appname -p 8080:80 \
-e POSTGRES_USER=${POSTGRES_USER} \
-e POSTGRES_PASSWORD=${POSTGRES_PASSWORD} \
-e POSTGRES_DB=${POSTGRES_DB} \
-e DB_HOST=${DB_HOST} \
--network internal $appname"


ssh $ssh_creds "rm $appname.tar"


