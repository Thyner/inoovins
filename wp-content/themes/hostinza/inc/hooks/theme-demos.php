<?php

function _filter_hostinza_fw_ext_backups_demos( $demos ) {
	$demo_content_installer	 = 'https://wp.xpeedstudio.com/demo-content/hostinza';
	$demos_array			 = array(
		'default'			 => array(
			'title'			 => esc_html__( 'Home 1 to 6', 'hostinza' ),
			'screenshot'	 => esc_url( $demo_content_installer ) . '/default/screenshot.png',
			'preview_link'	 => esc_url( 'https://wp.xpeedstudio.com/hostinza/' ),
		),
		'home-7'			 => array(
			'title'			 => esc_html__( 'Home 7', 'hostinza' ),
			'screenshot'	 => esc_url( $demo_content_installer ) . '/home-7/home-seven.jpg',
			'preview_link'	 => esc_url( 'https://wp.xpeedstudio.com/hostinza-v2/' ),
		),
		'home-8'			 => array(
			'title'			 => esc_html__( 'Home 8', 'hostinza' ),
			'screenshot'	 => esc_url( $demo_content_installer ) . '/home-8/home-seven.jpg',
			'preview_link'	 => esc_url( 'https://wp.xpeedstudio.com/hostinza-v2/home-eight/' ),
		),
		'home-9'			 => array(
			'title'			 => esc_html__( 'Home 9', 'hostinza' ),
			'screenshot'	 => esc_url( $demo_content_installer ) . '/home-9/home-nine.jpg',
			'preview_link'	 => esc_url( 'https://wp.xpeedstudio.com/hostinza-v2/home-nine/' ),
		),
		'home-10'			 => array(
			'title'			 => esc_html__( 'Home 10', 'hostinza' ),
			'screenshot'	 => esc_url( $demo_content_installer ) . '/home-10/home-ten.jpg',
			'preview_link'	 => esc_url( 'https://wp.xpeedstudio.com/hostinza-v2/home-ten/' ),
		),
		'home-11'			 => array(
			'title'			 => esc_html__( 'Home 11', 'hostinza' ),
			'screenshot'	 => esc_url( $demo_content_installer ) . '/home-11/home-eleven.jpg',
			'preview_link'	 => esc_url( 'https://wp.xpeedstudio.com/hostinza-v2/home-eleven/' ),
		),
		
	); 
	$download_url			 = esc_url( $demo_content_installer ) . '/manifest.php';
	foreach ( $demos_array as $id => $data ) {
		$demo						 = new FW_Ext_Backups_Demo( $id, 'piecemeal', array(
			'url'		 => $download_url,
			'file_id'	 => $id,
		) );
		$demo->set_title( $data[ 'title' ] );
		$demo->set_screenshot( $data[ 'screenshot' ] );
		$demo->set_preview_link( $data[ 'preview_link' ] );
		$demos[ $demo->get_id() ]	 = $demo;
		unset( $demo );
	}
	return $demos;
}


add_filter( 'fw:ext:backups-demo:demos', '_filter_hostinza_fw_ext_backups_demos' );