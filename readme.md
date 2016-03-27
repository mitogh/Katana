# Katana [![Build Status](https://travis-ci.org/mitogh/Katana.svg?branch=master)](https://travis-ci.org/mitogh/Katana)

> Save disk space and creates custom images sizes only where is
required.

Custom filters to make sure the image sizes are generated only on pages or posts that requires the sizes on [WordPress](https://wordpress.org/), this will help to save some disk space of images that are not used at all on your WordPress installation.

![](/media/samurai.jpg)  
Picture from [WikiImages](https://pixabay.com/samurai-guerrero-caza-de-samurai-67662/)

## Previous version.

If you are using a version below 2, please make sure you take a look at
[the previous docs](readme-1.md) and if you are going to upgrade make
sure you follow the installation guide.

## Installation 

**This is not a plugin**, rather is a library that can be used with your
own plugin or your theme. 

1. You need to download the library using [composer](https://getcomposer.org/). In order to do this you can run the following command: 

```bash
composer require mitogh/katana
```

This will add the latest version of the library on your installation and
will create a vendor directory where the files are going to be located.

2. If you are using a plugin or `functions.php` from a theme you only
   need to include the following file: 

```php
include dirname( __FILE__ ) . '/vendor/autoload.php';
```

That will allow you to use any filter from the class from `Katana` or
any other package installed via composer.  

That's practically all the process you need to follow in order to
install the library, since the library automatically creates the object
that is used for create the post and page filters.

## Usage

This library comes with some filters that allows you edit what sizes of
images are generated under certain post types, page templates, post ID
or any other custom conditional.

## Default size

As a note or reminder take into account that the default image size is
always generated even if you remove all image sizes with the filters.

## Filters 

Each filter allow to return what sizes of images are needed for that
particular filter, the returned sizes represents the allowed images
sizes, each size is the name that was registered when you created an
image size using `add_image_size`.

By default Katana applies 3 filters in the following order: 

1. Filter by post_id - priority 10
2. Filter by post type - priority 20
3. Filter by template page - priority 30

About filter priorities: 

> Used to specify the order in which the functions associated with a particular action are executed. Lower numbers correspond with earlier execution, and functions with the same priority are executed in the order in which they were added to the filter.

So if you are creating your own filter make sure to take priorities into account.

### katana_refine

This is the filter triggered by Katana and is the one that you can use
to create custom conditionals or to create new filter names.

The filter sends two parameters, so you need to explicity specify the
number of arguments that are send to the filter: 

- `$sizes` An array with the sizes of the images availables on the site.
- `$id` The id of the post that triggers the filter.

For example you want to remove all the image sizes from a page that has
the title `tomacco`

```php
add_filer( 'katana_refine', function($sizes, $id) {
    $title = strtolower( get_the_title( $id ) );
    if ( $title === 'tomacco' ) {
      return [];
    } else {
      return $sizes;
    }
}, 10, 2);
```

### katana_refine_{post_type}  

`{post_type}`, can be any post type declared on the site, post page or
even a custom one, like movies.

This filter allows to refine the sizes of images for a certain post
type.

**Example**

This example remove all the sizes from all of the pages, so any time you
add an image on a page it won't create a new size of image. 

```php
add_filter('katana_refine_page', '__return_empty_array');
```

The default two filters are: 

- `katana_refine_post`: Will allow you to update all the images
  generated in all posts.
- `katana_refine_page`: Allow you to change the default sizes generated
  on all the pages.

Every time you create a new post type, you can use a new filter with the
slug of the new post type.

### katana_refine_{post_id}

`{post_id}`, is the id of the post, page or custom post type. (all new
entries has a `post_id`)

This filter allows you to change the sizes on a particular `post_id`. (All posts, pages or custom post types has a post_id, than can be used with this filter).

**Example**

Imagine we have previously declared an `author_profile_image` size of an
image, as follows:

```php
add_image_size( 'author_profile_image', 350, 350, true );
```

We need to creates images of the `author_profile_image` size only in the
entry with the id: `105`.

```php
add_filter('katana_refine_105', 'allow_only_author_profile_image');

function allow_only_author_profile_image( $sizes ){
  return array( 'author_profile_image' );
}
```

### katana_refine_{template_slug}

`{template_slug}`,  is the slug of the template, the slug is where is
located the template, the template name is generated only with the last
name of the template and removing the `.php` extension of that template
file, some examples below:

**Examples**  

| Location                    |     Filter name             |
|-----------------------------|-----------------------------| 
| page-templates/full.php     |     katana_refine_full      |
| page-templates/shop-page.php|     katana_refine_shop_page |
| portfolio.php               |     katana_refine_portfolio |

**Example** 

This filter just allow to create two sizes of images in the
`page-template/full.php`: 

- poster
- landscape

```php
add_filter('katana_refine_full', 'image_sizes_for_full_page_template');

function image_sizes_for_full_page_template( $sizes ){
  return array( 'poster', 'landscape' );
}
```
