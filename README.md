NODRIZA tech Technical Test
========================

Implementar dos endpoint en un symfony 5 montado con docker.

Technological Stack
------------

1. PHP 8.1.8;
2. Docker - PHP 8.1 + Symfony 5.4.12
3. Docker Compose 
4. Postman / Browser 

Installation
------------

 * Clone GitHub repository
```
git clone https://github.com/PabloAdriaensens/nodrizatech
```

 * Access into directory: 
```
cd nodrizatech
```

* Build, Run, Start Docker and install composer:
```
make initialize
```

* Database and migration:
```
make ssh-be
```
```
sf doctrine:database:create --if-not-exists
```
```
sf doctrine:migrations:migrate
```

* Ready to access to browser or Postman collection:
```
http://localhost:1000/
```

Endpoints
-----

**API Urls** (Import Postman collection)

* Default URL:
  * <http://localhost:1000>

* GET Planets:
    * <http://localhost:1000/planets/1>

* POST Planets:
    * <http://localhost:1000/planets>
