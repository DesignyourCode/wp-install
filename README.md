# Wordpress Composer

Install and run wordpress using composer only.

**This is a work in progress!**

### To Do

1. Get the DB to install
2. Make this work with Heroku
3. Add theme via git repo

### Composer

Copy the following into a composer.json file and change:
* your-theme-name (this will become the theme folder name)
* git-path-to-theme (this is the url to your git repo for the theme)

Plugins will be loaded via composer into the plugin folder. To add plugins, use <a href="http://wpackagist.org/" target="_blank">wp-packagist</a>.

The following is an example of what you need to add to require:

"wpackagist-plugin/plugin-name-here": "version-number"

```
{
    "repositories": [
        {
            "type": "composer",
            "url": "http://wpackagist.org"
        },
        {
            "type"    : "package",
            "package" : {
                "name"    : "your-theme-name",
                "version" : "dev-master",
                "type" : "wordpress-theme",
                "source"  : {
                    "url" : "git-path-to-theme",
                    "type" : "git",
                    "reference" : "origin/master"
                }
            }
        }
    ],
    "require": {
        "php": ">=5.4",
        "composer/installers": "~1.0",
        "composer/composer": "1.0.0-alpha11",
        "wp-cli/wp-cli": "dev-master",
        "wp-cli/php-cli-tools": "dev-master",
        "johnpbloch/wordpress": "4.2",

        "your-theme-name": "dev-master"
    },
    "extra": {
        "wordpress-install-dir": "wp",

        "installer-paths" : {
            "wp-content/themes/{$name}/": ["type:wordpress-theme"]
        }
    },
    "scripts": {
        "post-install-cmd": [
            "wp plugin activate --all"
        ]
    }
}
```