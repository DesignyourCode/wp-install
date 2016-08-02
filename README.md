# Wordpress Composer

Install and run wordpress using composer only.

## **This is a work in progress!**

## Getting Started

1. Fork this project for your own site
2. Run:
```
composer install
composer local
```
3. Add your DB config to `local-config.php`
4. Add your theme folder into `wp-content/themes`

    >  **Tip:** The [timber-starter-theme](https://github.com/upstatement/timber-starter-theme) is included as a dependency that you can use as a parent theme

5. Add any required themes and plugins, either from their [wpackagist](http://wpackagist.org/) packages or by adding them in the right place in `wp-content/`
6. Run `composer update` to pull in the latest version of the wordpress core and any other dependencies you've defined
7. Point a web server at the root of the project

   > **Tip:** If you don't have one set up, you can use the PHP built-in webserver, like this: `php -S localhost:8000`

## Heroku support
This project is set up to run on [Heroku](https://www.heroku.com/home) with minimal effort.

1. Create a new app
2. Add a MySQL database add-on
3. Populate `wp-config.php` values using config variables

   > **Tip:** If you are using the [ClearDB MySQL add-on](https://elements.heroku.com/addons/cleardb), you won't have to set up any configuration for your database, it will be auto-detected and pulled through.
   
4. Push your project to Heroku. (There are many ways to complete this, for details see the [Heroku docs on deployment](https://devcenter.heroku.com/categories/deployment))

## Licence
This project is under the MIT license. See the [complete license](LICENSE):

    LICENSE

## Reporting an issue or a feature request
Issues and feature requests are tracked in the [Github issue tracker](https://github.com/DesignyourCode/wp-install/issues).
