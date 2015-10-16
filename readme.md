# Katana

> Save disk space and creates custom images sizes only where is
required.

Custom filters to allow easy update of images sizes for [Wordpress](https://wordpress.org/).

![](/media/samurai.jpg)  
***Picture from [WikiImages](https://pixabay.com/samurai-guerrero-caza-de-samurai-67662/)***

## Installation 

In order to have access to the filters you need to create a new instance
of the Kata object for exmaple: 

```php
$katana = new Katana();
```

After that line you can add all your custom filters.

## Usage

This library comes with custom filters that allows edit what sizes are
generated under some custom post types or under a specific `post_id`. 

**Note: ** The default size of the image is always generated no matter
if you remove all sizes.  

## Filters 

### katana_refine_{post_type}  

This filter allows to refine the sizes of images for a certain post
type, this can be the default ones like: post, page or a custom one like
movies to change what sizes of images are being generated on those post
types. 

**Example**

This example remoe all the sizes from all of the pages, so any time you
add an image on a page it wont create any new size of image. 

```php
add_filter('katana_refine_page', 'remove_all_sizes_from_pages');

function remove_all_sizes_from_pages( $sizes ){
  return array();
}
```
