#!/bin/bash
# App settings
appname="openvideo-site"
ssh_creds="cherrydev"

# Build and send image
podman build -t $appname .
rm ../btools/$appname.tar
podman save -o ../btools/$appname.tar $appname:latest
rsync -avz ../btools/$appname.tar $ssh_creds:~/$appname.tar

ssh $ssh_creds "podman load -i $appname.tar"
ssh $ssh_creds "podman kill $appname"
ssh $ssh_creds "podman rm --force $appname"
ssh $ssh_creds "podman run -d --name $appname \
-p 8081:80 \
-v phpconfigs:/usr/local/etc/php \
--network internal $appname"

# Cleanup
ssh $ssh_creds "rm $appname.tar"
