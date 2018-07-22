<?php
	/**
 	 * Define post label
  	 */
	$post_meta_label = get_post_meta( get_the_ID() , 'meta-box-product-label', true);


	$productlabelicons = $GLOBALS['product_label_webicons'];



	if( isset($post_meta_label) && $post_meta_label != 'none'){

		if( isset($productlabelicons[$post_meta_label]) ){
			$post_meta_label = $productlabelicons[$post_meta_label];
		}
		$productlabel = '<div class="labelbox"><span class="productlabel">'.$post_meta_label.'</span></div>';

	}

	/**
 	 * Define post product properties
  	 */
    $price = get_post_meta(get_the_ID(), "meta-box-product-price", true);
    $currency = get_post_meta(get_the_ID(), "meta-box-product-currency", true);
    $discount = get_post_meta(get_the_ID(), "meta-box-product-discount", true);
    $size = get_post_meta(get_the_ID(), "meta-box-product-size", true);
    $dmx = get_post_meta(get_the_ID(), "meta-box-product-dmx", true);
    $dmy = get_post_meta(get_the_ID(), "meta-box-product-dmy", true);
    $dmz = get_post_meta(get_the_ID(), "meta-box-product-dmz", true);
    $dms = get_post_meta(get_the_ID(), "meta-box-product-dms", true);
    $wms = get_post_meta(get_the_ID(), "meta-box-product-wms", true);
    $wmn = get_post_meta(get_the_ID(), "meta-box-product-wmn", true);

	$orderbymail = 'post'; // default custom
    if( !empty( get_post_meta(get_the_ID(), "meta-box-product-orderbymail", true) ) && get_post_meta(get_the_ID(), "meta-box-product-orderbymail", true) != 'null'){
		$orderbymail = get_post_meta(get_the_ID(), "meta-box-product-orderbymail", true);
    }


	/**
 	 * CURRENCY MAP
  	 */
	$currency_map = $GLOBALS['currency_symbols'];


	/**
 	 * SIZE MAP
  	 */
	$size_map = $GLOBALS['size_select'];



	/*
	 * PRICE
	 */
	$used_currency = $currency_map['EUR'];
	if( $currency != '' &&  $currency !== 'undefined' ){
	$used_currency =  $currency_map[$currency];
	}

	$productbox = '';
	if( $price != '' &&  $price !== 'undefined' ){
	$productbox .= '<div class="pricebox">';

	if( $discount != '' && $discount !== 'undefined' && is_numeric($discount) && is_numeric($price) ){

		$productbox .= '<span class="discount">'.__('Discount', 'onepiece').' '. $discount .'% </span>';

		$price = '<span class="price">'. $used_currency .' '. ($price / 100) * (100 - $discount) .'</span>';

	}else if( is_numeric($price) ){

		$price = '<span class="price">'. $used_currency .' '. $price .'</span>';

	}else{

		$price = '<span class="price">'. $price .'</span>'; // text
	}

	$productbox .=  $price;

	$productbox .= '</div>';
	}


	/*
	 * SIZE
	 */

	if( $size != '' && $size != 'none'){

	$productbox .= '<div class="sizebox">';

	$productbox .= '<span class="size">'.$size_map[ $size ].'</span>';

	$productbox .= '</div>';

	}



	/*
	 * PACKAGE
	 */
	$packagebox = '';
	if( $dms != 'none' && $dms != '' && $dms != 'undefined' ){

	$packsize = '';
	if( $dmx != '' && $dmx != 'undefined' && is_numeric($dmx)){
	$packsize .= $dmx.' ';
	}
	if( $dmy != '' && $dmy != 'undefined' && is_numeric($dmy)){
	$packsize .= 'x '.$dmy;
	}
	if( $dmz != '' && $dmz != 'undefined' && is_numeric($dmz)){
	$packsize .= ' x '.$dmz;
	}

	}

	if( isset($packsize) && $packsize != ''){
	$packagebox .= '<div class="packagebox">';
	$packagebox .= '<span class="packagesize">'.$packsize.' '.$dms.'</span>';
	$packagebox .= '</div>';
	}

	if( $wms != 'none' && $wmn != '' && $wmn !== 'undefined'
	&& is_numeric($wmn) && $wms !== 'undefined' ){
	$packagebox .= '<div class="weightbox">';
	$packagebox .= '<span class="packageweight">'.$wmn.' '.$wms.'</span>';
	$packagebox .= '</div>';
	}


	$orderbox = '';

	if( $price != '' &&  $price !== 'undefined' && $orderbymail != 'none' &&  $orderbymail !== 'undefined'
	&& ( ( is_single() && $orderbymail == 'post' ) || $orderbymail == 'ever') ){

	$orderbymailmarkup =  antispambot( get_theme_mod('onepiece_content_panel_product_orderemailaddress', get_option('admin_email') ) );
	$orderbymailmarkup .= '?subject=Order request '.esc_attr( get_bloginfo( 'name', 'display' ) ).' - '.get_the_title();
	$orderbymailmarkup .= '&body='. __('Hi,%0AIs this product still available? I would like to buy it. ', 'onepiece');
	$orderbymailmarkup .= '%0A%0A'.get_the_title();

    //markup += '<div class="coverbox"><img class="coverimage" src="'+obj.mediumimg[0]+'" alt="'+obj.title+'" /></div>';
	$orderbymailmarkup .= '%0A'.get_the_permalink();
	// https://gist.github.com/CatTail/4174511
	$orderbymailmarkup .= '%0A'.preg_replace('/<a href=\"(.*?)\">(.*?)<\/a>/', "\\2", get_the_content() ); // no links

	$orderbox .= '<div class="orderbox"><ul>';
	$orderbox .= '<li><span><a class="orderbyemailbutton" href="mailto:'.$orderbymailmarkup.'" target="_self">'.__('Order by Email', 'onepiece').'</a></span></li>';
	$orderbox .= '</ul></div>';


	}


	?>
