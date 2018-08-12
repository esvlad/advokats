<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Адвокаты
 */


get_header();

while ( have_posts() ){
	the_post();

	$this_cat = get_the_category(get_the_ID());

	if($this_cat[0]->parent != 0){
		$this_cat[0] = get_category($this_cat[0]->parent);
	}

	get_template_part( 'template-parts/content', $this_cat[0]->slug );
}

get_footer();
