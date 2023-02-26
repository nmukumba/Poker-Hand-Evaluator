To run this project the computer must be installed with PHP  version 8.1

After cloning the project run composer install to install dependencies
```bash
composer install
```

Generate Laravel project key
```bash
php artisan key:generate
```

Run the application
```bash
php artisan serve
```

Open http://127.0.0.1:8000/ in your browser to view the application

To test the api endpoint send a post request to http://127.0.0.1:8000/api with be body below
```json
{
    "cards":"AC 10C 3S 3D 3C"
}
```

Success Response
```json
{
    "success": true,
    "message": "Three of a Kind"
}
```

Error Response
```json
{
    "success": false,
    "message": "An invalid rank was set for a card: 3C"
}
```

Validation Error Response
```json
{
    "success": false,
    "message": "The cards field is required."
}
```
