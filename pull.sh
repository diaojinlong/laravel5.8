#!/bin/bash
path=$(cd $(dirname "${BASH_SOURCE[0]}") && pwd)
cd $path
echo "更新目录:${path}";
git reset --hard && git pull && chmod -R 750 ./ && chown -R www:www ./
echo "更新完成"
