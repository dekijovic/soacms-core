##Core Application

Core aplication is first API version of the Service oriented architecture for the CMS

Symfony 3.4

#Useful Commands:

- php bin/console generate:doctrine:entity SomeBundle:SomeEntity

- php bin/console cache:warmup --env=prod --no-debug

- php bin/console doctrine:database:drop --force
- php bin/console doctrine:database:create
- php bin/console doctrine:schema:update --force

- php bin/console generate:bundle --namespace=Components/ReferencesBundle --bundle-name=ReferencesBundle --dir=src/ --format=annotation --no-interaction

