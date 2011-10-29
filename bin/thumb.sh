#!/usr/bin/env sh

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
  
  # Thumbnail
  $CONVERT_BIN $BASE -strip -colorspace RGB -units PixelsPerInch -density 72 -quality 80 -thumbnail 80x"80"^ -gravity center -extent 80x80 $3/$4/thumb.$EXT
  show $3/$4/thumb.$EXT
  
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

# Usage: ./report.sh 2

cd `dirname $0`
root_folder=`pwd`

folder="web/uploads/$1"
dir=$2

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
      "gif")
        convfiles "gif" $original $folder $dir
      ;;
      "tif")
        convfiles "tif" $original $folder $dir
      ;;
      "tiff")
        convfiles "tiff" $original $folder $dir
      ;;
      *)
        convfiles "jpg" $original $folder $dir
      ;;
      esac
    else
      echo "Missing original file"
    fi
  done
else
  echo "Missing folder"
fi

exit 0
