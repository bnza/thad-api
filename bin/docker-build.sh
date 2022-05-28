#!/usr/bin/env sh

ROOT_DIR=$(dirname "$0") || exit

ENV_FILE=$("${ROOT_DIR}"/generate-tmp-env.sh)

ENV_FILE=$("${ROOT_DIR}"/generate-tmp-env.sh)

if [ "${APP_ENV}" = "prod" ]; then ENV_OVERRIDE="prod"; else ENV_OVERRIDE="override"; fi

COMMAND="docker-compose --env-file "${ENV_FILE}" -f docker-compose.yml -f docker-compose.${ENV_OVERRIDE}.yml build "$@""

echo "${COMMAND}"

docker-compose --env-file "${ENV_FILE}" -f docker-compose.yml -f docker-compose.${ENV_OVERRIDE}.yml build "$@"

rm "${ENV_FILE}"
