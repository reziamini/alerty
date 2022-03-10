
# Alerty

Alerty is a smell query identifier which gives you a GUI to monitor them.

![alerty](https://user-images.githubusercontent.com/29504334/157667001-085944f8-edec-49a8-9ce5-ac24760dbfdc.png)

## Installation:
To install Alerty, you need to execute this command using Composer:

```shell
composer require rezaamini-ir/alerty --dev
```
Then you need to migrate your migrations using Artisan:

```shell
php artisan migrate
```

Now you have access to `/alerty` endpoint, enjoy it!

For now, Alerty is not Real-time and you have to refresh the page to get a fresh result.
