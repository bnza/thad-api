#!/usr/bin/env sh

ROOT_DIR=$(dirname "$0") || exit

ENV_FILE=$("${ROOT_DIR}"/generate-tmp-env.sh)

if [ "${APP_ENV}" = "prod" ]; then ENV_OVERRIDE="prod"; else ENV_OVERRIDE="override"; fi

echo "docker-compose --env-file ${ENV_FILE} -f docker-compose.yml -f docker-compose.${ENV_OVERRIDE}.yml up "$@""

docker-compose --env-file "${ENV_FILE}" -f docker-compose.yml -f docker-compose.${ENV_OVERRIDE}.yml up "$@"

rm "${ENV_FILE}"
