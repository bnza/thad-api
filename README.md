# thad-api

UniUD iraqi field excavation database

## Installation

Provide JWT keypair in ```config/jwt``` directory. 

Generate with ```lexik:jwt:generate-keypair```


## Test

Create the test DB ```bin/console doctrine:database:create --env=test```

Migrate ```bin/console doctrine:migration:migrate --env=test```
