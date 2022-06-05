#!/usr/bin/env bash

ROOT_DIR=$(pwd $(cd -P "$(dirname "$0")")) || exit

. "${ROOT_DIR}"/.env

if [ -z "${APP_ENV}" ]; then APP_ENV=prod; fi

if [ -f "${ROOT_DIR}"/.env.local ]; then
    . "${ROOT_DIR}"/.env.local
fi

if [ -f "${ROOT_DIR}"/.env."$APP_ENV" ]; then
  # shellcheck source=.env.$APP_ENV
  . "${ROOT_DIR}"/.env."$APP_ENV"
fi

if [ -f "${ROOT_DIR}"/.env."$APP_ENV.local" ]; then
  # shellcheck source=.env.$APP_ENV.local
  . "${ROOT_DIR}"/.env."$APP_ENV".local
fi

DATABASE_URL="postgresql://${POSTGRES_USER}:${POSTGRES_PASSWORD}@database:5432/${POSTGRES_DB}?serverVersion=${POSTGRES_VERSION}&charset=utf8"

DOTENV="APP_ENV APP_SECRET POSTGRES_PASSWORD POSTGRES_USER POSTGRES_DB POSTGRES_PORT POSTGRES_DATA_DIR DATABASE_URL WWW_STATIC_DIR NGINX_HOST NGINX_PORT NGINX_SSL_PORT"

TMPFILE=$(mktemp)
for VAR in ${DOTENV}; do
    echo "$VAR"=${!VAR} >> "${TMPFILE}"
done

echo "$TMPFILE"
