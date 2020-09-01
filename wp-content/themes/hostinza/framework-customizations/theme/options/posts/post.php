<?php if ( !defined( 'FW' ) ) {	die( 'Forbidden' ); }

$options = array(
	'_post_meta' => array(
		'title'		 => __( 'Post Settings', 'hostinza' ),
		'type'		 => 'box',
		'priority'	 => 'high',
		'options'	 => array(
			'header_title'	 => array(
				'type'	 => 'text',
				'label'	 => esc_html__( 'Banner title', 'hostinza' ),
				'desc'	 => esc_html__( 'Add your post hero title', 'hostinza' ),
			),
			'header_image'	 => array( 
				'label'	 => esc_html__( ' Banner Image', 'hostinza' ),
				'desc'	 => esc_html__( 'Upload a post header image', 'hostinza' ),
				'help'	 => esc_html__( "This default header image will be used for all your post.", 'hostinza' ),
				'type'	 => 'upload'
			),
			'header_icons'	 => array(
                'type' => 'addable-popup',
                'label' => esc_html__('Banner Bouncing Icons', 'hostinza'),
                'template' => 'Banner icon',
                'popup-title' => 'Banner icon',
                'size' => 'small',
                'limit' => 0,
                'add-button-text' => esc_html__('Add icon', 'hostinza'),
                'sortable' => true,
                'popup-options' => array(
                    'header_ico' => array(
                        'label'	 => esc_html__( ' Banner Icon', 'hostinza' ),
                        'desc'	 => esc_html__( 'Upload a image icon', 'hostinza' ),
                        'type'	 => 'upload'
                    ),
                ),
            ),
			'video_url'	 => array(
				'type'	 => 'text',
				'label'	 => esc_html__( 'Video URL', 'hostinza' ),
				'desc'	 => esc_html__( 'Add your post video url', 'hostinza' ),
			),
			'soundcloud_embed'	 => array(
				'type'	 => 'textarea',
				'label'	 => esc_html__( 'Soundcloud Embed', 'hostinza' ),
				'desc'	 => esc_html__( 'Add your post soundcloud embeded code', 'hostinza' ),
			),
			'gallery_images'	 => array(
				'label'	 => esc_html__( ' Gallery Images', 'hostinza' ),
				'desc'	 => esc_html__( 'Upload your post\'s gallery images', 'hostinza' ),
				'type'	 => 'multi-upload'
			),
		),
	),
);
