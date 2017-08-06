
![alt text](http://cdn.designyourcode.io/wp-install-logo.jpg "WP Install")

# Welcome to WP Install
The starter kit for installing and managing Wordpress using composer. You can also deploy to Heroku.

WP Install has been designed to work as closely as possible with Wordpress and it's default settings. This is to help keep Wordpress as familiar as possible when setting it up.

## Getting Started

1. Create a new database for wordpress.

    > **Tip:** If you don't have PHPMyAdmin or a similar GUI installed, you can run:
    >  `mysql -u <username-here> -p 'CREATE DATABASE <project-name-here>'`

2. If you have PHP Redis installed: 
   `composer create-project designyourcode/wp-install <project-name-here>`

   If you do not have PHP Redis installed: 
   `composer create-project designyourcode/wp-install <project-name-here> --ignore-platform-reqs`

    >  **Tip:** If you are running `composer update` or `composer install` and do not have PHP Redis installed on your system, you will need to run append your composer command with `--ignore-platform-reqs`

3. Follow the onscreen instructions to add your config settings.
4. Add your theme into `wp-content/themes` (this can then be committed with the rest of your project).

    >  **Tip:** If your theme is built upon the [timber-library](https://en-gb.wordpress.org/plugins/timber-library/) plugin, you can simply commit your theme. The (latest version) of the plugin is installed by default. If you **do not** want to use Timber, just remove it from `composer.json`.
    >
    >  **Notice:** The __twentysixteen__ theme is added via composer as default (this is ignored by git), so that Wordpress has a theme to fall back to if you have not set yours yet.

5. Add any required themes and plugins, either from their [wpackagist](http://wpackagist.org/) packages or by adding them in the right place in `wp-content/`
6. Use a local PHP server and point it at your site.

    > **Tip:** If you don't have one set up, you can use the PHP built-in webserver, like this: `php -S localhost:8000`

7. Once you have gone through the standard Wordpress setup, you will need to set the Wordpress URL.

    > **Tip:** Settings > General > Site Address (URL) and do not include the /wp.

## Heroku Support

If you would like to deploy a wordpress site directly to Heroku use the button below.

[![Deploy](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy)

**However**, if you have done the above and have a local copy, then use the following commands to deploy your site to Heroku. 

> **Tip:** To get started, you need to make sure you have Heroku Toolbelt installed on your machine: https://toolbelt.heroku.com/

1. Create a new app: `heroku apps:create <your-heroku-name>` or add an existing Heroku app repo: `heroku git:remote -a <your-heroku-name>`
2. Enable Heroku addons:
    * `heroku addons:create sendgrid:starter` - Enable mailing
    * `heroku addons:create heroku-redis:hobby-dev` - Enabling sessions to be stored in Redis

        > **Tip:** So that when Heroku's Dyno restarts it doesn't log everyone out of WP. 
3. Configuring the Database:
    You can either use JawsDB, ClearDB or use your own database. The following commands and settings will need to be chosen on a per site basis.
    * `heroku addons:create cleardb:ignite` - MySQL database add-on
    * `heroku addons:create jawsdb:kitefin` - MySQL database add-on
    > **Tip:** If you are using [ClearDB MySQL add-on](https://elements.heroku.com/addons/cleardb) or [JawsDB MySQL add-on](https://elements.heroku.com/addons/jawsdb), you won't have to set up any configuration for your database, it will be auto-detected and pulled through.
    >
    > If you are not, you can configure the DB settings using the following:
    >
    > `DB_NAME`, `DB_USER`, `DB_PASSWORD`, `DB_HOST`

4. You will need to set some environment variables, this can be done by running the following:
    * `heroku config:set DEBUG=<your-mode>` - (true|false) - Enables debug mode. Set to false if you do not want debug mode on.
    * `heroku config:set DBI_AWS_ACCESS_KEY_ID=<your-access-key>` - Add your AWS Access Key.
    * `heroku config:set DBI_AWS_SECRET_ACCESS_KEY=<your-secret-key>` - Add your AWS Secret Access Key.

    > **Tip:** These can be changed per environment if you are using Heroku Pipelines.

5. Push your project to Heroku. (There are many ways to complete this, for details see the [Heroku docs on deployment](https://devcenter.heroku.com/categories/deployment))

    > **Tip:** It is likely that you can simply do:
    >
    > `git add --all`
    >
    > `git commit -m "Your commit message"`
    >
    > `git push heroku master`

## Licence
This project is under the MIT license. See the [complete license](LICENSE):

    LICENSE

## Contributing

Feel free to fork this project and submit pull requests and your contributions will be considered.
It is recommended you get in touch or raise an issue first to discussion your request.

## Reporting an issue or a feature request
Issues and feature requests are tracked in the [Github issue tracker](https://github.com/DesignyourCode/wp-install/issues).
