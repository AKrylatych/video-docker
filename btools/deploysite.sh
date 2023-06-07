#!/bin/bash
appname="openvideo-site"
ssh_creds="cherrydev"
podman build -t $appname .
rm ../btools/$appname.tar
podman save -o ../btools/$appname.tar $appname:latest
rsync -avz ../btools/$appname.tar $ssh_creds:~/$appname.tar
ssh $ssh_creds "podman load -i $appname.tar"
ssh $ssh_creds "podman kill $appname"
ssh $ssh_creds "podman rm --force $appname"
ssh $ssh_creds "podman run -d --name $appname -p 8081:80 --network internal $appname"
ssh $ssh_creds "rm $appname.tar"
