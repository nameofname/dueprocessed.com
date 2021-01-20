# Docker-based WordPress development for dueprocessed.com

## Usage

- Docker must be installed locally [https://www.docker.com/](https://www.docker.com/)
- Clone this repo
- Run `docker-compose up`

## Development

This is a simple environment for developing features of the due processed theme. Note:

- WordPress will be available at [http://localhost:8000](http://localhost:8000)
- The `wp-content` folder you'll find in this repo will be shared with the WordPress installation
- You may put plugin code in `wp-content/pluigins`, however the preferred way for adding plugins is via composer
- To add a plugin via composer
	- Search for the plugin on the WP Packagist repository: [https://wpackagist.org/](https://wpackagist.org/)
	- Copy the name of the plugin you want to install - make sure to use the exact string
		- For example, assume you want to install the plugin `akismet-notifier`
	- `cd` into `./due-processed` and install the plugin using the prefix `wpackagist-plugin/` like so: 
		- `composer require wpackagist-plugin/akismet-notifier`

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

## Custom Paragraph Block
To add a paragraph with a blue background to a page, follow these steps:
1. When editing the page, click on the `+` button in the top-left corner of the screen
2. A search bar should appear. Search for "custom paragraph"
3. Click on the result that appears. A new paragraph with a blue background should appear on the page. You can edit the text in this paragraph like any other

## About Page
The About page can show a list of contributors to the site. To edit this list, go to the edit view for the About page and scroll to the very bottom where it says "Page Options". To add a new entry to the list, click on "Add Entry" and fill out the fields

### Footnotes

### Featured Articles

The "Featured Articles" carousel on the home page will display articles with the "featured" tag, in order of publish date. To tag an article, go to the edit view and you should see a "tags" section in the right sidebar. Add a tag by typing it into the text box
