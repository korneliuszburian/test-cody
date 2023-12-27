<?php /* Template Name: Main Page */

/* html, nav variable declaration */
get_header();
get_template_part( 'template-parts/components/hero' );
get_template_part( 'template-parts/flexible', args: 'page' );
get_footer();