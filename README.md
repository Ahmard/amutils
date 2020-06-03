<h1>AMUtils</h1>

------

## What is this?

Pieces of classes writting to automate some things.
Why don't you try it?

# Installation
Make sure that you have composer installed
[Composer](http://getcomposer.org).

If you don't have Composer run the below command
```bash
curl -sS https://getcomposer.org/installer | php
```

- Clone the repository.
```bash
git clone https://github.com/ahmard/amutils.git
```

- After cloning, run the below command
```bash
composer update
```

## Usage
- Extract download link from https://fzmovies.net
```php
php appent link:fzmovies "https://fzmovies.net/movie-The%20Forbidden%20Kingdom--hmp4.htm"
```

- Extract download link from https://feurl.com
```php
php appent link:feurl "https://feurl.com/v/zyvnx8yk8o1"
```

- Download remote file
```php
php appent import https://google.com
```

## License

Use it however you seem fit.