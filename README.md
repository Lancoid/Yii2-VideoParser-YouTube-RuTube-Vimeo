<p align="center">
    <h1 align="center">Yii2 VideoParser (YouTube, RuTube, Vimeo)</h1>
</p>
<p>
    INPUT - url video from video-service<br>
    OUTPUT - title, description, iframe code, thumbnail link.
</p>

INSTALL
-------------
git clone https://github.com/Lancoid/Yii2-VideoParser-YouTube-RuTube-Vimeo.git


CONFIGURATION
-------------

### Database
Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=DATABASE_NAME',
    'username' => 'DATABASE_USER_NAME',
    'password' => 'DATABASE_USER_PASSWORD',
    'charset' => 'utf8',
];
```
### Migrations
You should apply migrations:
```php
./yii migrate
```

### Params
Edit the file `@app/config/params.php` with real YouTube ApiKey:

```php
return [
    'adminEmail' => 'admin@example.com',
	'youtubeApiKey' => 'apiKey from youtube',
];
```
