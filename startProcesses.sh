#!/usr/bin/env bash

trap_with_arg() { # from http://stackoverflow.com/a/2183063/804678
  local func="$1"; shift
  for sig in "$@"; do
    trap "$func $sig" "$sig"
  done
}

stop() {
  trap - SIGINT EXIT
  printf '\n%s\n' "recieved $1, killing children"
  kill -s SIGINT 0
}

trap_with_arg 'stop' EXIT SIGINT SIGTERM SIGHUP

echo "Starting  --- \n"
echo " ------------ \n"
redis-server --port 3001 &

echo "Starting QSO Listener --- \n"
echo " ------------ \n"
php artisan qso:receive &

echo "Starting Socket.IO --- \n"
echo " ------------ \n"
node socket.js &

echo "Starting Statistics generator"
echo " ------------ \n"
sh run-stats.sh &

while true; do read; done
