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

### Working with your Docker env

- All the docker files are in the root of this repo, so to run docker commands you should normally do it from the root
	- Some helpful docker commands are stored in the package.json located inside the `due-processed` directory which is a quirk of how our repo is set up
	- Most of the docker commands can also be run from this directory
- To start your docker env run `docker-compose up`
- To stop the docker containers, run `docker-compose down`
- The docker DB container is instructed by docker-compose to import any files that you place inside of the `sql-dumps` directory
	- To work with an up to date copy of the database you need to export a sql dump from prod
	- We use the `migrate-db` plugin to do this 
	- Navigate to the Migrate DB page in the admin on prod (https://dueprocessed.wpcomstaging.com/wp-admin/tools.php?page=wp-migrate-db)
		- Located at /wp-admin/ --> Tools --> Migrate DB
	- This page will present options to export a copy of the DB. Download it and place it in your `sql-dumps` folder
	- Now when you start your env using `docker-compose up` the new copy of the DB will be imported
	- The other .sql files located in `sql-dumps` will also be applied
	- Note* that if you have started your env before the new sql dump file will not be imported properly, so to apply the new SQL dump file use the steps below...
- If you want to trash your env and start over, run the following commands in sequence : 
	- `docker-compose down --rmi=all` (stop docker containers and remove all of them)
	- `docker volume prune` (remove any volumes that were associated with the containers you just removed, pertains to old copies of your DB)
	- `docker-compose up` (recreate everything and start the containers)


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

### Subscription form 

The subscription form is a reusable block - WP supports a mailchimp form block out of the box which is pretty cool. To edit it you can go to the reusable blocks editor pae (I added a link in the admin) http://localhost:8000/wp-admin/edit.php?post_type=wp_block. See footer.php for code which outputs the block. 