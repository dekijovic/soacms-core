##Core Application

Core aplikacija je stub celog promoimage sistema

Core app je API service sistem za Web, Admin i Mobile aplikacije

#Generisanje entiteta:

- php bin/console generate:doctrine:entity SomeBundle:SomeEntity

#Ciscenje Cache-a

- php bin/console cache:warmup --env=prod --no-debug

#Kreiranje brisanje i updatovanje baze

 - php bin/console doctrine:database:drop --force
 - php bin/console doctrine:database:create
 - php bin/console doctrine:schema:update --force

#Generisanje komponente:
 php bin/console generate:bundle --namespace=Components/ReferencesBundle --bundle-name=ReferencesBundle --dir=src/ --format=annotation --no-interaction


 #Mysql:
  - username:root
  - password:promo-root12252017