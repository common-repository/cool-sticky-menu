<?php
/*
Plugin Name: Cool Sticky Menu
Description: Make a menu or element sticky.
Tags: sticky menu, sticky element, sticky, menu
Author URI: http://www.ledproff.dk/
Author: Kjeld Hansen
Text Domain: sticky_menu
Requires at least: 4.0
Tested up to: 4.4.2
Version: 1.0
*/

if ( ! defined( 'ABSPATH' ) ) exit;

add_action('admin_menu','sticky_menu_admin_menu');
function sticky_menu_admin_menu() { 
    add_menu_page(
		"Sticky Menu",
		". Menu",
		8,
		__FILE__,
		"sticky_menu_admin_menu_list",
		plugins_url( 'img/sticky-icon.png', __FILE__ ) 
	); 
}

function sticky_menu_admin_menu_list(){
	include 'sticky-admin.php';
}

add_action('wp_head','sticky_menu_load_js');

function sticky_menu_load_js(){
	if(get_option( 'ri_sticky_menu_id' )){
		$stky_option = unserialize(get_option( 'ri_sticky_menu_id' ));
		$mc = $stky_option['menuids'];
		$mw = $stky_option['minwidth'];
		$mp = $stky_option['ptop'];
		if($mc!='')
	
	if($mc!=''):
	?>
    <script type="text/javascript">
		jQuery( document ).ready(function() {
			 var wspos = jQuery("<?php echo $mc; ?>").offset();
			 if(jQuery(window).scrollTop()){
				 var w = jQuery(window).scrollTop();
				 var top1 = wspos.top-w;
				 if(top1<0){ jQuery("<?php echo $mc; ?>").addClass('ri-sticky-fixed'); }
			 }
			 jQuery( window ).scroll(function() {
				w = jQuery(window);
				top1 = wspos.top-w.scrollTop();
				if(top1<0){ jQuery("<?php echo $mc; ?>").addClass('ri-sticky-fixed'); }else{ jQuery("<?php echo $mc; ?>").removeClass('ri-sticky-fixed'); }
				jQuery("<?php echo $mc; ?>").css({'top':-top1});
			 });
		});
    </script>
    <style type="text/css">
    	
		@media screen and (min-width: <?php echo $mw; ?>px) {
			<?php echo $mc; ?>{  position: static; }
			.ri-sticky-fixed<?php echo $mc; ?> {
				position: relative;
				margin-top:<?php echo $mp; ?>px;
			}
		}
    </style>
    <?php
	endif;
	}
}

function sticky_menu_valid_class_id($elm){
	$ret = false;
	if ( strlen( $elm ) < 30 && strpos($elm, " ") == false ) {
		if($elm[0]=='#' || $elm[0]=='.'){
			$elm1 = substr($elm, 1);
			if(sanitize_html_class($elm1)){	$ret = $elm[0].sanitize_html_class($elm1); }
		}
	}
	return $ret;
}