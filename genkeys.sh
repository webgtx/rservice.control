#!/bin/sh
key=$(date | base64 | base64)
echo $key > .config/key.dat
echo -[ DONE ]-
echo $(date)
