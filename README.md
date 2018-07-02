test_football_leagues
=====================

A Symfony project created on June 29, 2018, 7:52 pm.
# league_test

### Install app:



composer update

bin/console doctrine:schema:update --force

php bin/console doctrine:fixtures:load

mkdir -p var/jwt

openssl genrsa -out var/jwt/private.pem -aes256 4096

openssl rsa -pubout -in var/jwt/private.pem -out var/jwt/public.pem

bin/console server:start


##Remember - update jwt_key_pass_phrase in parameters.yml
jwt_key_pass_phrase: