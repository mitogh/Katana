<?php namespace Katana;

if ( function_exists( 'apply_filters' ) ) {
	new Edge();
	new Filters\Post();
	new Filters\Page();
}
