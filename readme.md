# Katana

> Save disk space and creates custom images sizes only where is
required.

Custom filters to allow easy update of images sizes for [Wordpress](https://wordpress.org/).

![](/media/samurai.jpg)  
***Picture from [WikiImages](https://pixabay.com/samurai-guerrero-caza-de-samurai-67662/)***

## Installation 

In order to have access to the filters you need to create a new instance
of the Kata object.

```php
$katana = new Katana();
```

Also makes sure to inclode the file `class-katana.php` into your
`functions.php` file or in your plugin directory. After that you 
can add all your custom filters that you may require.

## Usage

This library comes with custom filters that allows edit what sizes are
generated under some custom post types or under a specific `post_id`. 

**Note:** The default size of the image is always generated no matter
if you remove all sizes.  

## Filters 

Each filter allow to return what sizes of images are needed for that
particular filter, the returned sizes represents the allowed images
sizes, each size is the name that was registered when you created an
image size using 'add_image_size'.

### katana_refine_{post_type}  

This filter allows to refine the sizes of images for a certain post
type, this can be the default ones like: post, page or a custom one like
movies to change what sizes of images are being generated on those post
types. 

**Example**

This example remove all the sizes from all of the pages, so any time you
add an image on a page it wont create any new size of image. 

```php
add_filter('katana_refine_page', 'remove_all_sizes_from_pages');

function remove_all_sizes_from_pages( $sizes ){
  // Clear all the sizes of images
  $sizes = array();
  return $sizes;
}
```

### katana_refine_{post_id}

This filter allow you to change the required sizes on a particular
post_id all posts, pages or custom post types has a post_id than can be
used for this. 

**Example**

Image we have previously declared an `author_profile_image` size of
image, like:

```php
add_image_size( 'author_profile_image', 350, 350, true );
```

We need to creates images of the author_profile_image size only in the
entry with the id: 105.

```php
add_filter('katana_refine_105', 'allow_only_author_profile_image');

function allow_only_author_profile_image( $sizes ){
  $sizes = array( 'author_profile_image' );
  return $sizes; 
}
```
