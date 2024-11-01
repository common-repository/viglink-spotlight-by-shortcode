<?php
/*
Plugin Name: VigLink SpotLight By ShortCode
Version: 1.0.a
Plugin URI: http://susantaslab.com/plugins/viglinksp/
Description: Make your content more shoppable while boosting revenue. Adding VigLink Spotlight to your site enhances your content by showcasing the products discussed on each page, making it easier for readers to buy (and you to earn revenue).
Author: Susanta K Beura
Author URI: http://susantaslab.com/
Usages: [spotlight width="300" height="250" float="left" border="0"]

*/

function SLB_VigLink_sp( $atts ) {
	extract(shortcode_atts(array(  
	    "width"		=> '300',
	    "height"		=> '250',
	    "float"		=> 'left',
	    "border"		=> '0'
	), $atts));
	$RetString  = "<div style='float:".$float.";width:".$width."px;height:".$height."px;border:".$border."px;overflow:hidden;'>";
	$RetString .= "	<div class='".((get_option( 'slb_vl_sl_class_id' ))?get_option( 'slb_vl_sl_class_id' ):'vl-sp-a52087de8385a4da17f273750d954d60')."'></div>";
	$RetString .= "</div>";

	return $RetString;
}

add_shortcode( 'spotlight', 'SLB_VigLink_sp' );

add_action( 'admin_menu', 'SLB_VL_Plugin_Menu' );

function SLB_VL_Plugin_Menu() {
	add_options_page( 'Susanta'."'".'s Lab VigLink Spotlight Plugin Options', 'VigLink SpotLight', 'manage_options', 'slb-viglink-spotlight', 'slb_vl_plugin_options' );
}

function slb_vl_plugin_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
    $opt_name = 'slb_vl_sl_class_id';
    $hidden_field_name = 'slb_vl_sl_submit_hidden';
    $data_field_name = 'slb_vl_sl_class';

    $opt_val = get_option( $opt_name );

    if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
        $opt_val = $_POST[ $data_field_name ];
        update_option( $opt_name, $opt_val );

?>
<div class="updated"><p><strong><?php _e('Settings saved.'); ?></strong></p></div>
<?php
    }
    echo '<div class="wrap">';
    echo "<h2>" . __( 'Susanta'."'".'s Lab VigLink SpotLight Plugin Settings') . "</h2>";
  
    ?>
<p>In order to make money from your blog/website with VigLink SpotLight please add your VigLink Spotlight Class ID<br />
<img src="<?php echo plugins_url( 'images/vlsl.png' , __FILE__ ); ?>" style="width:275px;align:left;" /><br />
Dont have a VigLink affiliate account? Get one <a href="https://www.viglink.com/?vgref=1593661" target="_blank" rel="nofollow" onmouseover="self.status='Monetize your website with clickable links from VigLink.';return true;" onmouseout="self.status=''">here</a>.
</p>
<form name="form1" method="post" action="">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
<p><strong><?php _e("VigLink SpotLight Class ID:" ); ?> </strong>
<input type="text" name="<?php echo $data_field_name; ?>" value="<?php echo $opt_val; ?>" size="20">
</p><hr />

<p class="submit">
<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
</p>

</form>
</div>

<?php
}
?>