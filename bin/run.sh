#!/usr/bin/env sh

THIS=$(basename $0)
DIR="$( cd -P "$( dirname "$0" )" && pwd )"

CMD="/usr/bin/nohup"
$CMD "$1" >/dev/null 2>/dev/null &
exit