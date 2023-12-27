<?php

/**
 * Core config
 */

require_once 'functions/error_reporting.php';
// require_once 'functions/ls_force_cache.php';
// require_once 'functions/html_compression.php';
require_once 'functions/acf_validator.php';
require_once 'functions/smtp_config.php';

/**
 * Theme config
 */
require_once 'functions/theme_config.php';
require_once 'functions/nav_menus_config.php';
require_once 'functions/enable_svg.php';
require_once 'functions/login_page_config.php';
require_once 'functions/cpt_config.php';
require_once 'functions/add_default_og_image.php';
require_once 'functions/disable_emojis.php';
require_once 'functions/disable_search.php';
// require_once 'functions/disable_posts.php';

/**
 * Externals config, utilities
 */
require_once 'functions/acf_config.php';
require_once 'functions/cf7_config.php';
require_once 'functions/majkelimages-1.7.0/init.php';
require_once 'functions/spamguard-1.0.1/init.php';
require_once 'functions/yoast_config.php';
require_once 'functions/theme_utils.php';
