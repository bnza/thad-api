# thad-api

UniUD iraqi field excavation database

## Installation

Clone the repository:

```shell
git clone https://github.com/bnza/thad-api.git thad-api
cd thad-api
```

Generate the ```APP_SECRET``` (with e.g [coderstoolbox](https://coderstoolbox.online/toolbox/generate-symfony-secret)) and set it in ```.env.prod.local```

```shell
APP_SECRET=mysecret
```

Provide JWT keypair in ```config/jwt``` directory. 

Generate with ```bin/console lexik:jwt:generate-keypair```


## Test

Create the test DB ```bin/console doctrine:database:create --env=test```

Migrate ```bin/console doctrine:migration:migrate --env=test```

## Docker-compose deploy

JWT keypair **MUST** be provided before build.

### Media directory

Create the php's container media dir with occurring permissions in the Docker's host: 

First retrieve PHP's service www-data ids with ```id username``` which will return something like ```uid=82(www-data) gid=82(www-data) groups=82(www-data),82(www-data)```

Then 
```shell
sudo mkdir /path/to/media
sudo chown -R 82:82 /path/to/media
```

Set the ```.env.prod.local``` ```WWW_STATIC_DIR``` key accordingly.

```shell
WWW_STATIC_DIR=/path/to/media
```

### Database

Create the db's container data directory

```shell
sudo mkdir /path/to/db
```

In ```.env.prod.local``` set 

```shell
POSTGRES_DATA_DIR=/path/to/db
DATABASE_URL="postgresql://${POSTGRES_USER}:${POSTGRES_PASSWORD}@database:5432/${POSTGRES_DB}?serverVersion=${POSTGRES_VERSION}&charset=utf8"
```

Set the ```.env.prod.local``` ```POSTGRES_PASSWORD``` key and eventual ```POSTGRES_*``` which differs you want to change with respect 
to ```.env``` file

Build the PHP image ```bin/docker-build.sh```

PHP's container **MUST** be started before nginx one so composer will install required bundles

Start the containers ```APP_ENV='prod' bin/docker-up.sh php -d```

Wait for ```public/bundles``` directory creation ```docker-compose exec ls public/bundles```
 
Then start nginx container ```APP_ENV='prod' bin/docker-up.sh nginx -d```



