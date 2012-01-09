#!/usr/bin/env sh

SERVICE='bin/carga.sh'
if ps ax | grep -v grep | grep $SERVICE > /dev/null
    then
    # echo "$SERVICE service running, everything is fine"
    echo "true"
else
    # echo "$SERVICE is not running"
    echo "false"
fi
exit