<?php

function tstp_back(){
wp_enqueue_script('jsPDF', plugin_dir_url(__FILE__) . 'js/jspdf.js');
wp_enqueue_script('jstest', plugin_dir_url(__FILE__) . 'js/jstest.js');
    }
add_action('admin_enqueue_scripts', 'tstp_back');





add_filter( 'manage_edit-shop_order_columns', 'test_plugin_order_detail_column' );
 
function test_plugin_order_detail_column( $columns ) {
    $columns['order_details'] = 'Details';
    return $columns;
}
 
add_action( 'manage_shop_order_posts_custom_column', 'test_plugin_order_detail_column_content' );
 
function test_plugin_order_detail_column_content( $column ) {
   
    global $post;
 
    if ( 'order_details' === $column ) {
 
        $order = wc_get_order( $post->ID );
        echo "<a href='javascript:generatePDF()'>Dowload PDF</a>"."<br>";
        foreach ( $order->get_items() as $item_id => $item ) {
   $product_name = $item->get_name();
   $quantity = $item->get_quantity();
   $subtotal = $item->get_subtotal();
   $total = $item->get_total();
   $product_type = $item->get_type();
}
     // echo $total . $product_name .  $quantity . $subtotal . $product_type;
  ?>  

 <div id="test" style="display:none;">
      
       <p>Name : <font size="3" color="green"><?php  echo $order->get_billing_first_name() . $order->get_billing_last_name(); ?></font></p>
       <p>Country : <font size="3" color="green"><?php  echo $order->get_billing_country(); ?></font></p>

       <p>Email : <font size="3" color="green"><?php  echo $order->get_billing_email(); ?></font></p>
       <p>Number : <font size="3" color="green"><?php  echo $order->get_billing_phone(); ?></font></p>
       <p>Order Total : <font size="3" color="green"><?php  echo $total; ?></font></p>

       <p>Product Name : <font size="3" color="green"><?php  echo $product_name; ?></font></p>

       <p>Product Quantity : <font size="3" color="green"><?php  echo $quantity; ?></font></p>

       <p> Subtotal : <font size="3" color="green"><?php  echo $subtotal; ?></font></p>
       <p>Product Type : <font size="3" color="green"><?php  echo $product_type; ?></font></p>
       <p>Payment Method : <font size="3" color="green"><?php  echo $order->get_payment_method(); ?></font></p>
       <p>Payment Method Title : <font size="3" color="green"><?php  echo $order->get_payment_method_title(); ?></font></p>


           
  
    </div>


  <?php 
    }
}