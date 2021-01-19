# Docker-based WordPress development for dueprocessed.com

## Usage

- Docker must be installed locally [https://www.docker.com/](https://www.docker.com/)
- Clone this repo
- Run `docker-compose up`

## Development

This is a simple environment for developing features of the due processed theme. Note:

- WordPress will be available at [http://localhost:8000](http://localhost:8000)
- The `wp-content` folder you'll find in this repo will be shared with the WordPress installation, you may put plugin code in `wp-content/pluigins`.

## Theme development

- The theme files in `./wp-content/themes/due-processed` are symlinked from `./due-processed`.
- The `./due-processed` directory is built off of the [Underscores starter theme](https://underscores.me/).
- Do not make changes directly to the files in `./wp-content/themes/due-processed`, instead make them in `./due-processed`.
- To make updates to the theme, first install the required dependencies in `./due-processed`:
```
$ cd ./due-processed
$ composer install
$ npm install
```
- The `npm watch` command will watch changes to your .scss files while you're devloping (there currently is no analogous process for JavaScript). 

You can find additional documentation about the `_s` starter theme on [Github](https://github.com/Automattic/\_s) and [Wordpress](https://developer.wordpress.org/themes/getting-started/theme-development-examples/#the-underscores-theme).

## Deployment

- Once you are satisfied with your changes in the `./due-processed` directory and want to deploy do the following : 
	- Version the theme by updating the version number in the style.scss file
	- Run the bundle command with `npm run bundle`. 
- This command will lint, compile, and compress yoru theme into a .zip file which it outputs to `due-processed.zip`.
- The zip file can then be uploaded to the /wp-admin theme page.



## Plugin development

Add plugins in `./wp-content/plugins`.
