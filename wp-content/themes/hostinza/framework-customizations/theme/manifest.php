<?php

if ( !defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$manifest = array();

$manifest[ 'name' ]			 = esc_html__( 'hostinza', 'hostinza' );
$manifest[ 'uri' ]			 = esc_url( 'http://themeforest.com/user/XpeedStudio' );
$manifest[ 'description' ]	 = esc_html__( 'hostinza WordPress theme', 'hostinza' );
$manifest[ 'version' ]		 = '1.0';
$manifest[ 'author' ]			 = 'XpeedStuio';
$manifest[ 'author_uri' ]		 = esc_url( 'http://themeforest.com/user/XpeedStudio' );
$manifest[ 'requirements' ]	 = array(
	'wordpress' => array(
		'min_version' => '4.3',
	),
);

$manifest[ 'id' ] = 'scratch';

$manifest[ 'supported_extensions' ] = array(
	'backups'		 => array(),
);


?>
