# Katana

> Save disk space and creates custom images sizes only where is
required.

Custom filters to allow easy update of images sizes for [Wordpress](https://wordpress.org/).

![](/media/samurai.jpg)  
***Picture from [WikiImages](https://pixabay.com/samurai-guerrero-caza-de-samurai-67662/)***

## Usage

```php
$katana = new Katana();
add_filter('katana_refine_page', 'remove_all_sizes_from_pages');

function remove_all_sizes_from_pages( $sizes ){
  return array();
}
```
