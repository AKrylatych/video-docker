#!/bin/bash
rm phpapp.tar
podman build -t phpapp . &&
podman save -o phpapp.tar phpapp:latest &&
rsync -avz phpapp.tar root@cherry1:/home/higgins/phpapp.tar
ssh root@cherry bash /home/higgins/docker-accept.sh

