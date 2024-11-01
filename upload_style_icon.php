<?php function ico_pro() { ?>

<?php
$ico_out = get_option('upload_icon_stock');
$ico_fai = get_option('upload_icon_stock_faible');
$ico_ok = get_option('upload_icon_stock_ok');

?>
<!-- Affichage des icônes -->
<style type="text/css" media="screen">
/* Style CSS batterie 4 Custom */
.base-sto4{
    display: block;line-height: 15px;
}
.base-sto4.stock-faible:before {
    content: url("<?php echo $ico_out;?>");
    display: inline-block;
    padding: 5px 5px 5px 0;
    position: relative;
    top: 3px;
}
.base-sto4.stock-faible {
    color: #9D2A2A;
}
.base-sto4.stock-moyen:before {
    content: url("<?php echo $ico_fai;?>");
    display: inline-block;
    padding: 5px 5px 5px 0;
    position: relative;
    top: 3px;
}
.base-sto4.stock-ok:before {
    content: url("<?php echo $ico_ok;?>");
    display: inline-block;
    padding: 5px 5px 5px 0;
    position: relative;
    top: 3px;
}

/* CSS pour produit variable....base-sto4 Custom */
.single_variation.base-sto4 > .stock:before{
    content: url("<?php echo $ico_ok;?>");
    display: inline-block;
    padding: 5px 5px 5px 0;
    position: relative;
    top: 3px;
    vertical-align: middle;
}
.single_variation.base-sto4 >.out-of-stock:before{
    content: url("<?php echo $ico_out;?>");
    display: inline-block;
    padding: 5px 5px 5px 0;
    position: relative;
    top: 3px;
}
</style>

<div class="mon-stock">
	<?php global $post, $product;
		$stockpro =  $product->stock ;
		$tx_rupture = get_option('tx_rupture');
		$tx_faible = get_option('tx_faible');
		$tx_ok = get_option('tx_ok');
		$qt_faible = get_option('qt_faible');

add_filter( 'woocommerce_get_availability', 'custom_get_availability', 1, 2);
  
function custom_get_availability( $availability, $_product ) {
	global $product;
    //supprime le texte 'en stock'
    if ( $_product->is_in_stock() & $product->is_type( 'simple' )) $availability['availability'] = __('', 'woocommerce');
  
    //supprime le texte 'hors stock'
    if ( !$_product->is_in_stock() & $product->is_type( 'simple' )) $availability['availability'] = __('', 'woocommerce');
        return $availability;
    }

//Icône pour le produit simple
if ( $product->managing_stock()&$product->is_type( 'simple' )  ){
if ($stockpro == 0)
{echo '<p class="base-sto4 stock-faible">'.$tx_rupture.'</p>';}
elseif ($stockpro <= $qt_faible)
{echo '<p class="base-sto4 stock-moyen">' .$stockpro. ' ' .$tx_faible.'</p>';}
else {echo '<p class="base-sto4 stock-ok">' .$stockpro . ' ' . $tx_ok.'</p>';}}

//Icon pour le produit variable

if ($product->is_type( 'variable' )  ){
echo' <script type=\'text/javascript\'>
jQuery(document).ready(function(){
jQuery(\'.single_variation\').addClass(\'base-sto4\');
}); </script>';}
?>
</div>

<?php }?>