#!/bin/bash

cd /var/www/fizzingdev

# Delete files like ._BDE_Signup (Apple files)
find . -type f -regex ".*\._.*" -delete

# Delete .DS_Store files (Apple again)
find . -type f -regex ".*\.DS_Store$" -delete

# Delete files like home_content.php~ (Linux files)
find . -type f -regex ".*~$" -delete

