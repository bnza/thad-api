#!/usr/bin/env sh

while getopts "v" f
do
    case "$f" in
        v) VERBOSE=true ;;
        *) echo "usage: $0 [-v]" >&2
           exit 1 ;;
    esac
done

DUMP_BASE_DIR='/data/dump'

TIMESTAMP=$(date +"%s")

YEAR=$(date -d @"$TIMESTAMP" +"%Y")
MONTH=$(date -d @"$TIMESTAMP" +"%m")

DUMP_DIR="$DUMP_BASE_DIR"/"$YEAR"/"$MONTH"

BASE_FILE_NAME=$(TZ=GMT date -d @"$TIMESTAMP" +"%Y%m%dT%H%M%S")

if [ ! -d "$DUMP_DIR" ]; then
  # Take action if $DIR exists. #
  if [ -n "$VERBOSE" ]; then
    echo "Creating ${DUMP_DIR}..."
  fi
  mkdir -p "$DUMP_DIR"
fi

DATA_FILE_NAME="$DUMP_DIR"/"$BASE_FILE_NAME"D.sql
ROLES_FILE_NAME="$DUMP_DIR"/"$BASE_FILE_NAME"R.sql

if [ -n "$VERBOSE" ]; then
  echo -n "Dumping data to ${DATA_FILE_NAME}..."
fi
pg_dump -U thadUser --exclude-table-data=refresh_token -f "$DATA_FILE_NAME" thad
if [ -n "$VERBOSE" ]; then
  echo " Done!"
fi
if [ -n "$VERBOSE" ]; then
  echo -n "Dumping roles to ${ROLES_FILE_NAME}..."
fi
pg_dumpall -U thadUser --roles-only -f "$ROLES_FILE_NAME"
if [ -n "$VERBOSE" ]; then
  echo " Done!"
fi

