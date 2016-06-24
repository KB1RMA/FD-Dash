#!/bin/sh
while [ 1 ]; do
    php artisan qso:stats
    sleep 10
done
