<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<div class="wrap">
<?php
if(current_user_can('manage_options')):

$optset = 0; $stky_option = array();
$mc = $mw = $mp = '';


if(isset($_POST['_ricsmnonce']) && wp_verify_nonce( $_POST['_ricsmnonce'], 'ricsm-nonce' )){
	$sou = array();
	if ( sticky_menu_valid_class_id($_POST['menuids']) !== false ) { $sou['menuids'] = sticky_menu_valid_class_id($_POST['menuids']); }else{  $sou['menuids'] = ''; }
	if ( strlen( $_POST['minwidth'] ) < 5 ) { $sou['minwidth'] = intval($_POST['minwidth']); }
	if ( strlen( $_POST['ptop'] ) < 4 ) { $sou['ptop'] = intval($_POST['ptop']); }
	
	update_option( 'ri_sticky_menu_id', serialize($sou) );
}else{  }

if(get_option( 'ri_sticky_menu_id' )){
	$stky_option = unserialize(get_option( 'ri_sticky_menu_id' ));
	$optset = 1;
	$mc = $stky_option['menuids'];
	$mw = $stky_option['minwidth'];
	$mp = $stky_option['ptop'];
}
else{ if(add_option( 'ri_sticky_menu_id' )){  } }
?><form action="" method="post">
	<input type="hidden" name="_ricsmnonce" value="<?php echo wp_create_nonce( 'ricsm-nonce' ); ?>" />
	<table class="manage-social wp-list-table widefat fixed striped pages">
    <thead>
    	<tr><td class="column-date"> </td> <td>  </td></tr>
    </thead>
    <tbody>
    	<tr>
        	<td> Element/Menu id or class : </td> <td> <input type="text" name="menuids" placeholder="eg. #main-menu or .menu1" value="<?php echo $mc; ?>" /></td>
        </tr>
        <tr>
        	<td>Minimum device width :</td> <td> <input type="text" name="minwidth" placeholder="in px, eg : 640" value="<?php echo $mw; ?>" />PX</td>
        </tr>
        <tr>
        	<td>Position from top : </td><td> <input type="text" name="ptop" placeholder="in px, eg : 10" value="<?php echo $mp; ?>" />PX </td>
        </tr>
    </tbody>
    <tfoot><tr> <td colspan="2"><input type="submit" name="ssn" value="Save" /></td></tr></tfoot>
    </table>
    </form>
    <div class="ri_sticky_menu_op">
        <ul>
            
        </ul>
    </div>
<?php endif; ?>
</div>