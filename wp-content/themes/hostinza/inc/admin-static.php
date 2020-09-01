<?php

if (!defined('ABSPATH'))
    die('Direct access forbidden.');
/**
 * Include static files: javascript and css for backend
 */
wp_enqueue_style('xs-admin', HOSTINZA_CSS . '/xs_admin.css', null, HOSTINZA_VERSION);
wp_enqueue_style( 'themify-icons', HOSTINZA_CSS . '/iconfont.css', null, HOSTINZA_VERSION );


wp_enqueue_script('xs-admin', HOSTINZA_SCRIPTS . '/xs_admin.js', null, HOSTINZA_VERSION);