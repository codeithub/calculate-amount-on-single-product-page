/**
 * @snippet       Calculate Subtotal Based on Quantity - WooCommerce Single Product
 * @author        Codeithub
 */
 
add_action( 'woocommerce_after_add_to_cart_button', 'Codeithub_product_price_recalculate' );
 
function codeithub_product_price_recalculate() {
   global $product;
   echo '<div id="subtot" style="display:inline-block;">Total: <span></span></div>';
   $price = $product->get_price();
   $currency = get_woocommerce_currency_symbol();
   wc_enqueue_js( "      
      $('[name=quantity]').on('input change', function() { 
         var qty = $(this).val();
         var price = '" . esc_js( $price ) . "';
         var price_string = (price*qty).toFixed(2);
         $('#subtot > span').html('" . esc_js( $currency ) . "'+price_string);
      }).change();
   " );
}
