#!/bin/bash
key=$(date | base64 | base64)
echo "$key" | tr -d "\n" > .config/key.dat
echo -[ DONE ]-
echo $(date)
