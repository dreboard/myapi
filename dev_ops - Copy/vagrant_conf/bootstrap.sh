#!/usr/bin/env bash

echo "======== Development tools"

rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm
sudo yum -y update


echo "================= MODULES Complete ================="

