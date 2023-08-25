<div class="cars-top-filters">
    <div class="cars-top-filters-left">
        <?php jws_cars_perpage(); ?>
    </div>    
    <div class="cars-top-filters-right">
        <?php jws_cars_catalog_ordering(); jws_get_catlog_view(); ?>
    </div> 
</div>     
      
<div class="all-cars-list-arch row">
<?php 
    global $jws_option;
    if(isset( $jws_option['cars-per-page'] ) && ! empty( $jws_option['cars-per-page'][0] ) ) {
		$per_page = $jws_option['cars-per-page'][0];
	}else {
	   $per_page = 9;
	} 
    $wc_attr = array(
    'post_type'         => 'cars',
    'posts_per_page'    => $per_page,
    'author' => $author,

    );
    $product_query = new WP_Query($wc_attr);
    while ($product_query->have_posts()) : $product_query->the_post();
     	$getlayout   = jws_get_cars_list_layout_style();
        if($getlayout == 'view-list') {
           ?>
            <div class="col-xl-12 list">
                <?php 
                    get_template_part( 'template-parts/content/cars/list' );
                ?>
            </div>
            <?php 
                if (($product_query->current_post +1) != ($product_query->post_count)) {
                  echo '<span class="car-line"></span> ';
                }
            ?>
            
          <?php   
        }else{
           ?>
            <div class="col-xl-6 col-lg-6 grid car-item">
                <?php 
                    get_template_part( 'template-parts/content/cars/grid' );
                ?>
            </div> 
          <?php   
        }      
    endwhile;
 ?>
</div>
                  