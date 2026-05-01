<?php
// This file is generated. Do not modify it manually.
return array(
	'sweem-block' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'create-block/sweem-block',
		'version' => '0.1.0',
		'title' => 'Sweem Team Block',
		'category' => 'widgets',
		'icon' => 'groups',
		'description' => 'Team member block with 9 separate skin styles.',
		'example' => array(
			
		),
		'attributes' => array(
			'name' => array(
				'type' => 'string',
				'default' => ''
			),
			'designation' => array(
				'type' => 'string',
				'default' => ''
			),
			'imgUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'imgId' => array(
				'type' => 'number',
				'default' => 0
			),
			'imgAlt' => array(
				'type' => 'string',
				'default' => ''
			),
			'facebookUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'twitterUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'linkedinUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'instagramUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'skinStyle' => array(
				'type' => 'string',
				'default' => 'style1'
			),
			'titleColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'subtitleColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'cardBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'contentBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'socialBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'socialIconColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'titleFontSize' => array(
				'type' => 'string',
				'default' => ''
			),
			'subtitleFontSize' => array(
				'type' => 'string',
				'default' => ''
			),
			'titleFontWeight' => array(
				'type' => 'string',
				'default' => ''
			),
			'subtitleFontWeight' => array(
				'type' => 'string',
				'default' => ''
			),
			'titleLineHeight' => array(
				'type' => 'string',
				'default' => ''
			),
			'titleLetterSpacing' => array(
				'type' => 'string',
				'default' => ''
			),
			'titleTextTransform' => array(
				'type' => 'string',
				'default' => ''
			),
			'subtitleLineHeight' => array(
				'type' => 'string',
				'default' => ''
			),
			'subtitleLetterSpacing' => array(
				'type' => 'string',
				'default' => ''
			),
			'subtitleTextTransform' => array(
				'type' => 'string',
				'default' => ''
			),
			'socialIconSize' => array(
				'type' => 'string',
				'default' => ''
			),
			'imageBorderRadius' => array(
				'type' => 'number',
				'default' => 20
			)
		),
		'supports' => array(
			'html' => false
		),
		'textdomain' => 'sweem-block',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'render' => 'file:./render.php',
		'viewScript' => 'file:./view.js',
		'style' => 'file:./style-index.css'
	)
);
