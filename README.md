Introduction:
===
It's navie implementation of basket, It has a restful api and simple twig and jquery. I commited `.env ` just make it simpler to start.

How to start:
===
before everything you need to run: 

> php bin/console doctrine:database:create  

> php bin/console doctrine:schema:update --force

> php bin/console doctrine:fixtures:load


then :

>  symfony server:start

and go to:
> http://127.0.0.1:8000/home

