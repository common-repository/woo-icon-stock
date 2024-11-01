<?php
wp_enqueue_style( 'woo-icon-stock', plugins_url( '/css/admin-style.css', __FILE__ ) );

 if( isset($_GET['settings-updated']) ) { ?>
     <div id="icon-stock-message" class="sauvegarde">
        <p><strong><?php _e('Paramètres enregistrés','woo-icon-stock') ?></strong></p>
    </div>
<?php } ?>
<!-- Do not unlink / Ne pas supprimer le lien !-->
<div class="best-icon-wrap">
<div class="info-best-icon">
          <h2>Woo Best Icon Stock <span style="font-style: italic;font-size:12px;color:#aaaaaa;"><a class="link-bos"  target="blank" href="http://best-of-site.fr">By Best OF Site</a></span></h2>
          <?php echo '<img class="logo align-right" src="' . plugins_url( 'css/images/logo-best-of-site.jpg' , __FILE__ ) . '" > ';?></br>
           <p class="text-info"><?php _e('Le plugin Woo icon stock vous permet d\'afficher une icône à côté de la quantité, sur la page principale de l\'article.','woo-icon-stock','woo-icon-stock'); ?></p>
</div>

<div class="option-wrap-best-icon">
<!-- Formulaire des options -->
    
<form method="post" action="options.php">
    
    <div class="tableau-left">
		
		<table class="table-icon-stock">
			<caption><?php _e('Paramétres généraux des icônes...','woo-icon-stock');?></caption>
			<tbody>
            <tr valign="top">
                <th class="titre-icon-stock" scope="row">
                    <?php _e('Texte à afficher lorsque l\'article est hors stock', 'woo-icon-stock'); ?>
                </th>    
                <td class="champ">
                    <input type="text" name="tx_rupture" id="tx_rupture" value="<?php echo get_option('tx_rupture'); ?>"> 
                </td>    
            </tr>
            <tr valign="top">
                <th class="titre-icon-stock" scope="row">
                    <?php _e('Texte à afficher lorsque le stock est faible', 'woo-icon-stock'); ?>
                </th>    
                <td class="champ">
                    <input type="text" name="tx_faible" id="tx_faible" value="<?php echo get_option('tx_faible');?>">
                </td>    
            </tr>
            <tr valign="top">
                <th class="titre-icon-stock" scope="row">
                    <?php _e('Texte à afficher lorsque le stock est convenable', 'woo-icon-stock'); ?>
                </th>    
                <td class="champ">
                    <input type="text" name="tx_ok" id="tx_ok" value="<?php echo get_option('tx_ok'); ?>">
                </td>    
            </tr>
             <tr valign="top">
                <th class="titre-icon-stock" scope="row">
                    <?php _e('Seuil du stock faible', 'woo-icon-stock'); ?>
                </th>    
                <td class="champ">
                    <input maxlength="5" title="test" format="NNNNN" type="number" name="qt_faible" id="qt_faible" value="<?php echo get_option('qt_faible'); ?>"> 
                </td>    
            </tr>
            <tr valign="top">
                <th class="titre-icon-stock" scope="row">
                    <?php _e('Icône à afficher', 'woo-icon-stock'); ?>

                </th>    
                <td class="champ">
                    <p style="height:35px"><img src="<?php echo plugins_url('woo-icon-stock') ;?>/css/images/stock-ok.png"></p>
                    <p style="height:35px"><img src="<?php echo plugins_url('woo-icon-stock') ;?>/css/images/ico-sto-ok2.png"></p>
                    <p style="height:35px"><img src="<?php echo plugins_url('woo-icon-stock') ;?>/css/images/ico-s1.png"></p>
                    
                </td>
                <td>
                    <p style="height:35px"><label><input class="ios-switch" type="radio" name="icon_woo_stock_1" id="icon_woo_stock_1"   <?php checked( 'base-sto', get_option( 'icon_woo_stock_1' ) ); ?> value="base-sto"></label></p>
                    <p style="height:35px"><label><input class="ios-switch" type="radio" name="icon_woo_stock_1" id="icon_woo_stock_2"  <?php checked( 'base-sto2', get_option( 'icon_woo_stock_1' ) ); ?> value="base-sto2"></label></p>
                    <p style="height:35px"><label><input class="ios-switch" type="radio" name="icon_woo_stock_1" id="icon_woo_stock_3"  <?php checked( 'base-sto3', get_option( 'icon_woo_stock_1' ) ); ?> value="base-sto3"></label></p>
                </td>
            </tr>
      </tbody>
    </table>
    </div>
   
    
    <div class="tableau-right">
	<table class="table-icon-stock">
	    <caption><?php _e('Activez la fonction Woo Best Icon Custom !','woo-icon-stock');?></caption>
	    <tbody>
                            
            <tr>
		  
		<td>
			<p class="titre-icon-stock"><?php _e('Cochez la case si vous voulez utiliser vos icônes','woo-icon-stock');?></p>
		</td>
      
		<td>
			<label><input class="ios-switch" name="woo-icon-stock-custom" type="checkbox" value="1" <?php checked( '1', get_option( 'woo-icon-stock-custom' ) ); ?> /></label>
                </td>
                <td>
			
		</td>	
	    </tr>
            
            
            <?php $best_icon_stock = get_option('upload_icon_stock');?>
            <tr>
		    <td>
			    <p class="titre-icon-stock" style="clear: both;"><?php _e('Envoyer votre icône hors stock','woo-icon-stock');?></p>
		    </td>
		    <td>
                            <label for="upload_image">
			    	<p><?php if(!empty ($best_icon_stock )):?><input class="delete-icon" type="button" OnClick="sup_icon_stock_delete();" value="X"></input><?php endif ?>
                                    <input class="radius" id="upload_image" type="text" size="36" name="upload_icon_stock" value="<?php echo get_option('upload_icon_stock');?>" />
				    </p>
				    <input class="button" id="upload_image_button" type="button" value="<?php _e('Envoyer icône  ','woo-icon-stock');?>" />
				    <?php _e('Envoyez des icônes de 25px x 25px','woo-icon-stock'); ?>
			    </label>
		    </td>
                    <td>
                         <?php if(!empty($best_icon_stock)) echo '<img src="'.$best_icon_stock.'">';?>
                    </td>
	    </tr>
            
            <?php $best_icon_stock_faible = get_option('upload_icon_stock_faible');?>
            <tr>
		    <td>
			    <p class="titre-icon-stock" style="clear: both;"><?php _e('Envoyer votre icône stock faible','woo-icon-stock');?></p>
		    </td>
		    <td>
                            <label for="upload_image2">
			    	<p><?php if(!empty ($best_icon_stock_faible )):?><input class="delete-icon" type="button" OnClick="sup_icon_stock_faible();" value="X"></input><?php endif ?>
                                    <input class="radius" id="upload_image2" type="text" size="36" name="upload_icon_stock_faible" value="<?php echo get_option('upload_icon_stock_faible');?>" />
				    </p>
				    <input class="button" id="upload_image_button2" type="button" value="<?php _e('Envoyer icône  ','woo-icon-stock');?>" />
				    <?php _e('Envoyez des icônes de 25px x 25px','woo-icon-stock'); ?>
			    </label>
		    </td>
                    <td>
                         <?php if(!empty($best_icon_stock_faible)) echo '<img src="'.$best_icon_stock_faible.'">';?>
                    </td>
	    </tr>
            
            <?php $best_icon_stock_ok = get_option('upload_icon_stock_ok');?>
            <tr>
		    <td>
			    <p class="titre-icon-stock" style="clear: both;"><?php _e('Envoyer votre icône stock ok','woo-icon-stock');?></p>
                            
		    </td>
		    <td>
                            <label for="upload_image3">
			    	<p><?php if(!empty ($best_icon_stock_ok )):?><input class="delete-icon" type="button" OnClick="sup_icon_stock_ok();" value="X"></input><?php endif ?>
                                    <input class="radius" id="upload_image3" type="text" size="36" name="upload_icon_stock_ok" value="<?php echo get_option('upload_icon_stock_ok');?>" />
				   </p>
				    <input class="button" id="upload_image_button3" type="button" value="<?php _e('Envoyer icône  ','woo-icon-stock');?>" />
				    <?php _e('Envoyez des icônes de 25px x 25px','woo-icon-stock'); ?>
			    </label>
		    </td>
                    
                    <td>
                         <?php if(!empty($best_icon_stock_ok)) echo '<img src="'.$best_icon_stock_ok.'">';?>
                    </td>
	    </tr>
    
       </tbody>
    </table>
    </div>

   <script type="text/javascript">
        
         // JS pour checkbox et radio
var switches = document.querySelectorAll('input[type="checkbox"].ios-switch, input[type="radio"].ios-switch');

for (var i=0, sw; sw = switches[i++]; ) {
	var div = document.createElement('div');
	div.className = 'switch';
	sw.parentNode.insertBefore(div, sw.nextSibling);
}
    </script>
<?php wp_nonce_field('update-options'); ?>

<!-- Mise à jour des valeurs -->
<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="tx_rupture, tx_faible, tx_ok, qt_faible, icon_woo_stock_1, upload_icon_stock,upload_icon_stock_ok, upload_icon_stock_faible, woo-icon-stock-custom" />

<!-- Bouton de sauvegarde -->
<p class="buton-save">
<input class="button button-primary"type="submit" value="<?php _e('Sauvegarder', 'woo-icon-stock'); ?>" />
</p>
</form>
<!-- Do not unlink / Ne pas supprimer le lien !-->
<div class="link-bos">
   <a target="blank" href="http://best-of-site.fr">Woo Icon Stock By Best OF Site</a><br />
   <a class="link-love" target="blank" href="https://wordpress.org/plugins/woo-icon-stock/">Votez Si vous appréciez</a>
</div>
</div>
</div>