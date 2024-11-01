<?php
/*
Plugin Name: Woo Icon Stock
Plugin URI: http://www.best-of-site.fr/plugin
Description: Ajoutez une icône de niveau de stock sur la fiche produit. 3 niveaux de stock différents 'En stock', 'Stock faible', 'Hors stock' . 3 types d'icônes au choix.
Version: 2.1.0
Author: Best Of Site
Author URI: http://best-of-site.fr
*/

/*  Copyright 2014  Agence Best Of Site  (email : contact@bestofsite.fr)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

load_plugin_textdomain( 'woo-icon-stock', false, plugin_basename( dirname( __FILE__ ) ) . "/languages" );
add_action( 'woocommerce_single_product_summary', 'ico_pro', 30 );
wp_enqueue_style( 'icon-pro', plugins_url( '/css/style.css', __FILE__ ) );

// Upload box

add_action('admin_enqueue_scripts', 'upload_icon_custom');
 
function upload_icon_custom() {
    if (isset($_GET['page']) && $_GET['page'] == 'icon-stock-pro') {
        wp_enqueue_media();
        wp_register_script('upload_icon_custom_js', plugins_url( '/js/icon-pro.js', __FILE__ ), array('jquery'));
        wp_enqueue_script('upload_icon_custom_js');
    }
}
?>
<?php
$custom = get_option('woo-icon-stock-custom');
if (empty ($custom))
include_once ('default_icon.php');
if ($custom =='1')
include_once ('upload_style_icon.php');

add_action( 'admin_menu', 'add_links_menu' );
function add_links_menu() {
    add_menu_page('Gestion icon', 'Icon Stock', 'administrator', 'icon-stock-pro', 'admin_page', plugins_url( '/css/images/ico-admin.png', __FILE__ ) , 50);
}
function admin_page() {
    
include_once 'icon_admin.php';
}

register_activation_hook( __FILE__, 'set_up_options' );
function set_up_options(){
	add_option('qt_faible', '20');
	add_option('tx_rupture' , 'Article hors stock');
	add_option('tx_faible' , 'Article en quantité limitée');
	add_option('tx_ok' , 'En stock');
	add_option('icon_woo_stock_1','base-sto');}
	
function tab_woo_icon_stock() { ?>
    <li class="woo_icon_tab"><a href="#woo_icon_stock_tab"><?php _e('Woo Icon Stock', 'woo-icon-stock'); ?></a></li>
<?php }
add_action('woocommerce_product_write_panel_tabs', 'tab_woo_icon_stock');
function woo_tab_icon_stock() {
    global $post;
    $woo_tab_icon_stock = array(
	'seuil' => get_post_meta($post->ID, 'woo_icon_stock_seuil', true),
	);
    ?>
    
    <div id="woo_icon_stock_tab" class="panel woocommerce_options_panel">
	<div class="options_group">
	    <p class="form-field">		
    <?php woocommerce_wp_checkbox( array( 'id' => 'woo_icon_enabled', 'label' => __('Activer le seuil du stock faible?', 'woo-icon-stock'), 'description' => __('Cochez la case pour activer le stock faible personalisé pour ce produit', 'woo-icon-stock') ) ); ?>
	    </p>
	</div>
	
	<div class="options_group woo_tab_icon_stock">                								
	    <p class="form-field">
		<label><?php _e('Seuil du stock faible pour cet article', 'woo-icon-stock'); ?></label>
	    	<input type="text" name="woo_icon_stock_seuil" value="<?php echo @$woo_tab_icon_stock['seuil']; ?>" placeholder="<?php _e('Saisissez le seuil de stock', 'woo-icon-stock'); ?>" />
	    </p>
	</div>
    </div>
<?php }
add_action('woocommerce_product_write_panels', 'woo_tab_icon_stock');
function woo_icon_stock_custom_tab( $post_id ) {
    update_post_meta( $post_id, 'woo_icon_enabled', ( isset($_POST['woo_icon_enabled']) && $_POST['woo_icon_enabled'] ) ? 'yes' : 'no' );
    update_post_meta( $post_id, 'woo_icon_stock_seuil', $_POST['woo_icon_stock_seuil']); }
    add_action('woocommerce_process_product_meta', 'woo_icon_stock_custom_tab'); ?>