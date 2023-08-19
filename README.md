## Webcoupers 
Full-Stack assessment task for webcoupers. 

•	Author: [Solomon Sunmola](https://github.com/Epheoluwa) <br>
•	Twitter: [@ifegracelife](https://twitter.com/ifegracelife) <br>

### `Live project`

[Click to view the live project](https://webcouper-fe.netlify.app/) <br>

## Available Endpoints
The following endpoints are available to use from a SPA and also the pages are available to use on the live site
```
-POST /api/register [For registration. Username, email and password are the required parameters]
-POST /api/login [For login. Email and password are the required parameters]
-GET /api/users/<Str: Username > [ To fetch single user details]
-POST /api/logout [ Send the User out ID]
-POST /api/deactivate [ Send the User out ID]
- GET /api/profile [ Fetch unthenticated user profile]
cp .env.example .env 
php artisan key:generate
php artisan cache:clear && php artisan config:clear 
```

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
