#!/usr/bin/env sh

THIS=$(basename $0)
DIR="$( cd -P "$( dirname "$0" )" && pwd )"

# Go
cd $DIR
cd ..

CMD="./symfony"
if [ -e "/usr/local/bin/sf" ]
    then
    CMD=sf
fi

$CMD lagden:ftp
$CMD lagden:carga
$CMD cc -q
$CMD lagden:completa

exit