#!/usr/bin/env sh

THIS=$(basename $0)
DIR="$( cd -P "$( dirname "$0" )" && pwd )"
CURR_FOLDER=`pwd`

# Go
cd $CURR_FOLDER

echo "sudo mode!!!"

`sudo rm -rf web/uploads/*`
`sudo rm -rf web/tiny/*`
`sudo rm -rf web/estates/*`
`rm -rf log/`
`rm -rf cache/`

echo "Folders are clean."

./setup -f

CMD="./symfony"
if [ -e "/usr/local/bin/sf" ]
    then
    CMD=sf
fi

$CMD cc -q
$CMD doc:build --all --and-load --env=dev --no-confirmation

exit