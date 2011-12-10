#!/usr/bin/env sh

THIS=$(basename $0)
DIR="$( cd -P "$( dirname "$0" )" && pwd )"
CURR_FOLDER=`pwd`

usage()
{
cat << EOF
usage: $0 options

This script prepare the symfony project.

OPTIONS:
   -h      Show this message
   -p      Project name - eg.: ./setup -p sfProject
   -a      Author name - eg.: ./setup -p sfProject -a Me
   -f      Creating and fixing folders permissions
EOF
}

IGNORE_P=0
AUTHOR="Thiago Lagden"
PROJECT=false

while getopts "hp:a:f" OPT; do
    case $OPT in    
    f) IGNORE_P=1; PROJECT=true;;
    p) PROJECT=$OPTARG;;
    a) AUTHOR=$OPTARG;;
    h|\?) usage; exit;;
    esac
done

if [[ $PROJECT == false ]]; then
    usage
    exit
fi

# Go
cd $CURR_FOLDER

# Installs symfony anyway
vendor_folder="$CURR_FOLDER/lib/vendor"
vendor_symfony_folder="$CURR_FOLDER/lib/vendor/symfony"

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

# Go
cd $CURR_FOLDER

# generate project
if [ ! -e "$CURR_FOLDER/config" ] && [ $IGNORE_P = 0 ]
then
    lib/vendor/symfony/data/bin/symfony generate:project "$PROJECT" "$AUTHOR"
    cp lib/vendor/symfony/data/bin/symfony ./
    ./symfony configure:database "mysql:host=localhost;dbname=db" root
else
    echo "Project already exists"
fi

# Go
cd $CURR_FOLDER

if [ $IGNORE_P = 1 ] && [ -e "$CURR_FOLDER/config" ]; then
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

# Go
cd $CURR_FOLDER

# linking the sf web resources
if [ ! -e "$CURR_FOLDER/web/sf" ] && [ -d "$CURR_FOLDER/web" ]
then
    echo "Creating link to /sf resources"
    cd "$CURR_FOLDER/web"
    ln -sf ../lib/vendor/symfony/data/web/sf "$CURR_FOLDER/web/sf"
fi

# Go
cd $CURR_FOLDER

# Compass
# remove sass cache
cacheSASS="$CURR_FOLDER/web/.sass-cache"
if [ -d $cacheSASS ]
    then
    rm -rf cacheSASS
fi

exit