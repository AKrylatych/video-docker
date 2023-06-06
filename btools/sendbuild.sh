#!/bin/bash
# builds API, run from API
podman rm --force phpapp
podman build -t phpapp .
podman run -d --name phpapp -p 8080:80 phpapp
# sends the build to rthe remote server
rm phpapp.tar
podman save -o ../btools/phpapp.tar phpapp:latest
rsync -avz phpapp.tar cherry1:/home/higgins/phpapp.tar
ssh cherry1 "podman load -i phpapp.tar"
ssh cherry1 "podman rm phpapp"
ssh cherry1 "podman run -d --name phpapp -p 8080:80 phpapp"
