<div class="snp-fb snp-theme-gmap">
	<div class="snp-content">
		<div class="snp-content-inner">
			<?php
			if(!empty($POPUP_META['snp_coordinates']) && !empty($POPUP_META['snp_zoom']) && !empty($POPUP_META['snp_map_type']))
			{
			?>
			<script src="http://maps.google.com/maps/api/js?sensor=true&callback=snp_<?php echo ($ID>0 ? $ID.'_' : ''); ?>initialize"></script>
			<script>
				function snp_<?php echo ($ID>0 ? $ID.'_' : ''); ?>initialize() {
					var myLatlng = new google.maps.LatLng(<?php echo $POPUP_META['snp_coordinates']; ?>);
					var mapOptions = {
						zoom: <?php echo $POPUP_META['snp_zoom']; ?>,
						center: myLatlng,
						mapTypeId: google.maps.MapTypeId.<?php echo $POPUP_META['snp_map_type']; ?>
					}

					var map = new google.maps.Map(document.getElementById('snp-<?php echo $ID; ?>-map-canvas'), mapOptions);
					
					
					var marker = new google.maps.Marker({
						position: myLatlng,
						map: map,
						<?php 
						if(!empty($POPUP_META['snp_marker_icon'])) {echo "icon: '".addslashes($POPUP_META['snp_marker_icon'])."',";}
						?>
						title: '<?php if(!empty($POPUP_META['snp_marker_label'])) {echo addslashes($POPUP_META['snp_marker_label']);}?>'
						
					});
					
					<?php
					if(isset($POPUP_META['snp_display_infowindow']) && 
						$POPUP_META['snp_display_infowindow']==1 &&
						!empty($POPUP_META['snp_infowindow_content'])
						)
					{
						echo "\n						var contentString = '<p>'+\n";
						$snp_infowindow_content=explode("\n",str_replace("\r",'',$POPUP_META['snp_infowindow_content']));
						foreach($snp_infowindow_content as $v)
						{
							echo "						'".$v."<br /> '+\n";
						}
						echo "						'</p>';\n";
						?>
						var infowindow = new google.maps.InfoWindow({
							content: contentString
						});

						google.maps.event.addListener(marker, 'click', function() {
							infowindow.open(map,marker);
						});
						<?php
						if(isset($POPUP_META['snp_infowindow_open']) && $POPUP_META['snp_infowindow_open']==1)
						{
							echo 'infowindow.open(map,marker);';
						}
					}
					?>
				}
			</script>
			<div id="snp-<?php echo $ID; ?>-map-canvas" class="snp-gmap"></div>
			<?php
			}
			?>
        </div>
	</div>
	<?php
	if ($POPUP_META['snp_width'] > 260 && snp_get_option('PROMO_ON') && snp_get_option('PROMO_REF') && SNP_PROMO_LINK != '')
	{
		$PROMO_LINK = SNP_PROMO_LINK . snp_get_option('PROMO_REF');
		echo '<div class="snp-powered">';
		echo '<a href="' . $PROMO_LINK . '" target="_blank">Powered by <strong>Ninja Popups</strong></a>';
		echo '</div>';
	}
	?>
</div>
<?php
echo '<style>';
//echo '.snp-pop-'.$ID.' { border: 5px red solid;}';
if (intval($POPUP_META['snp_width']))
{
	echo '.snp-pop-' . $ID . ' .snp-theme-gmap, .snp-pop-' . $ID . ' .snp-gmap { width: ' . $POPUP_META['snp_width'] . 'px;}';
}
if (intval($POPUP_META['snp_height']))
{
	echo '.snp-pop-' . $ID . ' .snp-theme-gmap, .snp-pop-' . $ID . ' .snp-gmap { height: ' . $POPUP_META['snp_height'] . 'px;}';
}
if ($POPUP_META['snp_bg_gradient'])
{
	$POPUP_META['snp_bg_gradient'] = unserialize($POPUP_META['snp_bg_gradient']);
	if (!$POPUP_META['snp_bg_gradient']['to'])
	{
		$POPUP_META['snp_bg_gradient']['to'] = $POPUP_META['snp_bg_gradient']['from'];
	}
	?>
	.snp-pop-<?php echo $ID; ?> .snp-theme-gmap{
	background: <?php echo $POPUP_META['snp_bg_gradient']['to']; ?>;
	background-image: -moz-radial-gradient(50% 50%, circle contain, <?php echo $POPUP_META['snp_bg_gradient']['from']; ?>, <?php echo $POPUP_META['snp_bg_gradient']['to']; ?> 500%);
	background-image: -webkit-radial-gradient(50% 50%, circle contain, <?php echo $POPUP_META['snp_bg_gradient']['from']; ?>, <?php echo $POPUP_META['snp_bg_gradient']['to']; ?> 500%);
	background-image: -o-radial-gradient(50% 50%, circle contain, <?php echo $POPUP_META['snp_bg_gradient']['from']; ?>, <?php echo $POPUP_META['snp_bg_gradient']['to']; ?> 500%);
	background-image: -ms-radial-gradient(50% 50%, circle contain, <?php echo $POPUP_META['snp_bg_gradient']['from']; ?>, <?php echo $POPUP_META['snp_bg_gradient']['to']; ?> 500%);
	background-image: radial-gradient(50% 50%, circle contain, <?php echo $POPUP_META['snp_bg_gradient']['from']; ?>, <?php echo $POPUP_META['snp_bg_gradient']['to']; ?> 500%);
	}
	.snp-pop-<?php echo $ID; ?> .snp-theme-gmap .snp-powered {
	<?php if ($POPUP_META['snp_bg_gradient']['from'])
	{
		echo 'background:' . $POPUP_META['snp_bg_gradient']['from'] . ';';
	} ?>
	<?php if (!empty($POPUP_META['snp_closetext_color']))
	{
		echo 'color: ' . $POPUP_META['snp_closetext_color'] . ';';
	} ?>
	}
	<?php
}
if (!empty($POPUP_META['snp_closetext_color']))
{
	echo '.snp-pop-' . $ID . ' .snp-theme-gmap .snp-no-thx, .snp-pop-' . $ID . ' .snp-theme-gmap .snp-powered , .snp-pop-' . $ID . ' .snp-theme-gmap .snp-privacy { color: ' . $POPUP_META['snp_closetext_color'] . ';}';
}
echo '</style>';
?>