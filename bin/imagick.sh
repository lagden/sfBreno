#!/usr/bin/env sh

THIS=$(basename $0)
DIR="$( cd -P "$( dirname "$0" )" && pwd )"
cd $DIR # vai para o bin
cd ..
CURR_FOLDER=`pwd`

# Go
cd $CURR_FOLDER

# Result
function show
{
    if [ -f $1 ]
        then
        echo "[OK] $1"
    else
        echo "[FAIL] $1"
    fi
}

# Convert
function convfiles
{
    CONVERT_BIN='convert'

    DEFAULT_EXT=jpg
    EXT=${1:-$DEFAULT_EXT}

    if [ $EXT == "gif" ]
        then
        BASE="$3/$4/coalesce.gif"
        $CONVERT_BIN $2 -coalesce $BASE
    elif [ $EXT == "tif" ] || [ $EXT == "tiff" ]
        then
        EXT="jpg"
        BASE="$3/$4/base.jpg"
        $CONVERT_BIN "$2"[0] $BASE
    else
        BASE="$2"
    fi

    # large
    $CONVERT_BIN $BASE -strip -colorspace RGB -units PixelsPerInch -density 72 -quality 80 -resize 1023x1023 $3/$4/large.$EXT
    show $3/$4/large.$EXT
    # medium1
    $CONVERT_BIN $BASE -strip -colorspace RGB -units PixelsPerInch -density 72 -quality 80 -resize 640x640 $3/$4/medium1.$EXT
    show $3/$4/medium1.$EXT
    # medium2
    $CONVERT_BIN $BASE -strip -colorspace RGB -units PixelsPerInch -density 72 -quality 80 -resize 500x500 $3/$4/medium2.$EXT
    show $3/$4/medium2.$EXT
    # small
    $CONVERT_BIN $BASE -strip -colorspace RGB -units PixelsPerInch -density 72 -quality 80 -resize 240x240 $3/$4/small.$EXT
    show $3/$4/small.$EXT
    # thumbnail
    $CONVERT_BIN $BASE -strip -colorspace RGB -units PixelsPerInch -density 72 -quality 80 -resize 100x100 $3/$4/thumbnail.$EXT
    show $3/$4/thumbnail.$EXT
    # square
    $CONVERT_BIN $BASE -strip -colorspace RGB -units PixelsPerInch -density 72 -quality 80 -thumbnail x"75"^ -gravity center -extent 75x75 $3/$4/square.$EXT
    show $3/$4/square.$EXT

    if [ $EXT == "gif" ] || [ $EXT == "tif" ] || [ $EXT == "tiff" ] && [ -f $BASE ]
        then
        rm $BASE
        if [ ! -f $BASE ]
            then
            echo "[REMOVED] $BASE"
        fi
    fi
}

# Init Script

# Usage: ./imagick.sh 2

folder="web/estates"
dir=$1

if [ -d "$folder/$dir" ]
    then
    for original in `ls $folder/$dir/original.*`
    do
        if [ -f $original ]
            then
            filename=$(basename $original)
            ext=${filename##*.}

            ext=$(echo $ext | tr "[:upper:]" "[:lower:]")

            case $ext in
                "gif") convfiles "gif" $original $folder $dir;;
                "tif") convfiles "tif" $original $folder $dir;;
                "tiff") convfiles "tiff" $original $folder $dir;;
                *) convfiles "jpg" $original $folder $dir;;
            esac
        else
            echo "Missing original file"
        fi
    done
else
    echo "Missing folder"
fi

exit
