<?php

$SNP_THEMES['theme_gmap'] = array(
	'NAME' => 'Google Maps',
	'STYLES' => 'style.css',
	'TYPES' => array(
		'iframe' => array('NAME' => 'Google Maps'),
	),
	'COLORS' => array(
		'gmap' => array('NAME' => '--')
	),
	'FIELDS' => array(
		array(
			'id' => 'width',
			'type' => 'text',
			'title' => __('Width', 'nhp-opts'),
			'desc' => __('px (default: 450)', 'nhp-opts'),
			'class' => 'mini',
			'std' => '450'
		),
		array(
			'id' => 'height',
			'type' => 'text',
			'title' => __('Height', 'nhp-opts'),
			'desc' => __('px (default: 300)', 'nhp-opts'),
			'class' => 'mini',
			'std' => '300'
		),
		array(
			'id' => 'coordinates',
			'type' => 'text',
			'title' => __('Coordinates', 'nhp-opts'),
			'desc' => __('(ex: -25.363882,131.044922)<br /><a target="_blank" href="http://support.google.com/maps/bin/answer.py?hl=en&answer=18539">How to Get Coordinates from Google Maps</a>', 'nhp-opts'),
			'std' => '-25.363882,131.044922'
		),
		array(
			'id' => 'marker_label',
			'type' => 'text',
			'title' => __('Marker Label', 'nhp-opts'),
			'desc' => __('', 'nhp-opts'),
			'std' => ''
		),
		array(
			'id' => 'marker_icon',
			'type' => 'upload',
			'title' => __('Marker Custom Icon', 'nhp-opts'),
			'desc' => __('(leave empty for default icon)', 'nhp-opts'),
			'std' => ''
		),
		array(
			'id' => 'zoom',
			'type' => 'select',
			'title' => __('Zoom Level', 'nhp-opts'),
			'desc' => __('(1-21)', 'nhp-opts'),
			'class' => 'mini',
			'std' => '12',
			'options' =>	array(
				1 => '1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21'
			)
		),
		array(
			'id' => 'map_type',
			'type' => 'select',
			'title' => __('Map Type', 'nhp-opts'),
			'std' => 'ROADMAP',
			'options' =>	array(
				'ROADMAP' => 'Road Map',
				'SATELLITE' => 'Satellite',
				'HYBRID' => 'Hybrid',
				'TERRAIN' => 'Terrain',
			)
		),
		array(
			'id' => 'display_infowindow',
			'type' => 'radio',
			'title' => __('Display Info Window', 'nhp-opts'),
			'options' => array(0 => 'No',1 => 'Yes'),
			'std' => 0
		),
		array(
			'id' => 'infowindow_content',
			'type' => 'textarea',
			'title' => __('Info Window - Content', 'nhp-opts')
		),
		array(
			'id' => 'infowindow_open',
			'type' => 'radio',
			'title' => __('Info Window - Default Open', 'nhp-opts'),
			'options' => array(0 => 'No',1 => 'Yes'),
			'std' => 0
		),
		
	)
);
?>