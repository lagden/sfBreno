#!/usr/bin/env sh
THIS=$(basename $0)

usage()
{
cat << EOF
usage: $0 options

This script prepare the symfony project.

OPTIONS:
   -h      Show this message
   -p      Project name, default is 'sfProject'
   -i      Ignore project
EOF
exit 1
}

IGNORE_P=0
PROJECT="sfProject"

while getopts "hp:i" OPT; do
    case $OPT in
    "h") usage;;
    "i") IGNORE_P=1;;
    "p") PROJECT=$OPTARG;;
    "?") exit -2;;
    esac
done

DIR="$( cd -P "$( dirname "$0" )" && pwd )"
ROOT_FOLDER=`pwd`

# Installs symfony
vendor_folder="$ROOT_FOLDER/lib/vendor"
vendor_symfony_folder="$ROOT_FOLDER/lib/vendor/symfony"

if [ ! -d $vendor_symfony_folder ]
then
    echo "Installing Symfony framework (1.4.15)"

    mkdir -p $vendor_folder
    cd $vendor_folder

    # downloading
    echo "Downloading Symfony"
    wget 'http://www.symfony-project.org/get/symfony-1.4.15.tgz' -O symfony.tgz

    echo "Extracting..."
    tar xzf symfony.tgz
    mv 'symfony-1.4.15' symfony
    rm symfony.tgz
fi

cd $ROOT_FOLDER

# generate project
if [ ! -e "$ROOT_FOLDER/config" ] && [ $IGNORE_P = 0 ]
then
    lib/vendor/symfony/data/bin/symfony generate:project $PROJECT "Thiago Lagden"
    cp lib/vendor/symfony/data/bin/symfony ./
    ./symfony configure:database "mysql:host=localhost;dbname=db" root
else
    required_folders="log cache data web/uploads web/tiny_uploads"
    for folder in $required_folders
    do
        if [ ! -d $folder ]
        then
            mkdir -p -m777 $folder
            echo "Creating $folder folder."
        else
            chmod -R 777 $folder
            echo "Fixing permissions on $folder"
        fi
    done
fi

# linking the sf web resources
# cd "$ROOT_FOLDER/web"
if [ ! -e "$ROOT_FOLDER/web/sf" ]
then
    echo "Creating link to /sf resources"
    ln -sf ../lib/vendor/symfony/data/web/sf "$ROOT_FOLDER/web/sf"
fi

exit 0