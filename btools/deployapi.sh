#!/bin/bash
appname="phpapp"
podman build -t $appname .
rm ../btools/$appname.tar
podman save -o ../btools/$appname.tar $appname:latest
rsync -avz ../btools/$appname.tar cherry1:/home/higgins/$appname.tar
ssh cherry1 "podman load -i $appname.tar"
ssh cherry1 "podman kill $appname"
ssh cherry1 "podman rm $appname"
ssh cherry1 "podman run -d --name $appname -p 8080:80 --network internal $appname"

