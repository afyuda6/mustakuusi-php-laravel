# mustakuusi-php-laravel
for learning purposes

## Start Server
```bash
php artisan serve --port=3003
```

## Get Games
```text
curl -X 'GET' \
  'http://localhost:3003/games' \
  -H 'accept: */*'
```

## Get Characters
```text
curl -X 'GET' \
  'http://localhost:3003/characters' \
  -H 'accept: */*'
```
