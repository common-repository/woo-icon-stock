<?php function ico_pro() { ?>


<!-- Affichage des icônes -->
<div class="mon-stock">
	<?php global $post, $product;
		$stockpro =  $product->get_stock_quantity() ;
		$tx_rupture = get_option('tx_rupture');
		$tx_faible = get_option('tx_faible');
		$tx_ok = get_option('tx_ok');
		$qt_faible = get_option('qt_faible');
		$option_ico = get_option('icon_woo_stock_1');
		$woo_tab_icon_stock = array(
			'enabled' => get_post_meta($post->ID, 'woo_icon_enabled', true),
			'seuil' => get_post_meta($post->ID, 'woo_icon_stock_seuil', true),
		);
		
		
add_filter( 'woocommerce_get_availability', 'custom_get_availability', 1, 2);
  
function custom_get_availability( $availability, $_product ) {
	global $product;
    //supprime le texte 'en stock'
    if ( $_product->is_in_stock() & $product->is_type( 'simple' )) $availability['availability'] = __('', 'woocommerce');
  
    //supprime le texte 'hors stock'
    if ( !$_product->is_in_stock() & $product->is_type( 'simple' )) $availability['availability'] = __('', 'woocommerce');
        return $availability;
    }
    if (get_option( 'woocommerce_stock_format' ) == 'no_amount'){
//Icône pour le produit simple
if ( $product->managing_stock() & $product->is_type( 'simple' ) &  ( $woo_tab_icon_stock['enabled'] != 'yes' )   ){
if ($stockpro == 0) 
{echo '<p class="'.$option_ico. ' stock-faible">'.$tx_rupture.'</p>';}
elseif ($stockpro <= $qt_faible)
{echo '<p class="'.$option_ico. ' stock-moyen"> ' .$tx_faible.'</p>';}
else {echo '<p class="'.$option_ico. ' stock-ok"> ' . $tx_ok.'</p>';} }

// Ooption active pour un seul produit

elseif ( $product->managing_stock() & $product->is_type( 'simple' ) &  ( $woo_tab_icon_stock['enabled'] != 'no' )   ){
if ($stockpro == 0) 
{echo '<p class="'.$option_ico. ' stock-faible">'.$tx_rupture.'</p>';}
elseif ($stockpro <= $woo_tab_icon_stock['seuil'])
{echo '<p class="'.$option_ico. ' stock-moyen">' .$stockpro. ' ' .$tx_faible.'</p>';}
else {echo '<p class="'.$option_ico. ' stock-ok">' .$stockpro . ' ' . $tx_ok.'</p>';}}
    }
    
    elseif (get_option( 'woocommerce_stock_format' ) == ''){
 
//Icône pour le produit simple
if ( $product->managing_stock() & $product->is_type( 'simple' ) &  ( $woo_tab_icon_stock['enabled'] != 'yes' )   ){
if ($stockpro == 0) 
{echo '<p class="'.$option_ico. ' stock-faible">'.$tx_rupture.'</p>';}
elseif ($stockpro <= $qt_faible)
{echo '<p class="'.$option_ico. ' stock-moyen">' .$stockpro. ' ' .$tx_faible.'</p>';}
else {echo '<p class="'.$option_ico. ' stock-ok">' .$stockpro . ' ' . $tx_ok.'</p>';} }

// Ooption active pour un seul produit

elseif ( $product->managing_stock() & $product->is_type( 'simple' ) &  ( $woo_tab_icon_stock['enabled'] != 'no' )   ){
if ($stockpro == 0) 
{echo '<p class="'.$option_ico. ' stock-faible">'.$tx_rupture.'</p>';}
elseif ($stockpro <= $woo_tab_icon_stock['seuil'])
{echo '<p class="'.$option_ico. ' stock-moyen">' .$stockpro. ' ' .$tx_faible.'</p>';}
else {echo '<p class="'.$option_ico. ' stock-ok">' .$stockpro . ' ' . $tx_ok.'</p>';}}
   
    }
    
//Icon pour le produit variable

if ($product->is_type( 'variable' )  ){
echo' <script type=\'text/javascript\'>
jQuery(document).ready(function(){
jQuery(\'.single_variation\').addClass(\''.$option_ico.'\');
});
</script>';}
?>		
</div>
<?php }?>