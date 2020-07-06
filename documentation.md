##Core Application

Resavanje izvrsavanja nepotrebnih query-ja

Kada se loaduje Entity on vuce dependency-je za koje je vezan i time izvrsava mnogo vise query-ja nego sto je potrebno
Jedan od resavanja je lazy loading (extra lazy, lazy(default), eager) ali implementacija lazy loading ima smisla samo
ako se radi sa view-ovima.
u API contextu svi podaci se serializuju tako da svi query-koji su ucitani u memoriju se izvrsavaju (equivalent EAGER-u)
zato se koristi serializer i time ogranicava izvrsavanje query-ja sa exclusion strategy i max depth


Symfony je katastrofa u ucitavanju kada je aktivan xdebug, pogotovu na windowsu zbog velikog broja kreiranih fajlova u kesu iz nekog razloga