#!/bin/bash
podman rm --force phpapp
podman build -t phpapp .
podman run -d --name phpapp -p 8080:80 phpapp