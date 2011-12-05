#!/usr/bin/env sh

DIR="$( cd -P "$( dirname "$0" )" && pwd )"

`sudo rm -rf web/uploads/*`
`sudo rm -rf web/tiny_uploads/*`
echo "Folders are clean."

CMD="./symfony"
if [ -e "/usr/local/bin/sf" ]
    then
    CMD=sf
fi

$CMD cc -q
$CMD doc:build --all --and-load --env=dev