
<div class="cars-top-filters">
    <div class="cars-top-filters-left">
        <?php jws_cars_perpage(); ?>
    </div>    
    <div class="cars-top-filters-right">
        <?php jws_cars_catalog_ordering(); jws_get_catlog_view(); ?>
    </div> 
    <input id="get-page-favorites" type="hidden" name="page" value="favourite" />
</div>     
      
<div class="all-cars-list-arch row">

<?php 
    $user = wp_get_current_user();
    $car_id = get_the_author_meta( 'jws_user_favourites', $user->ID );  
   
    $wc_attr = array(
    'post_type'         => 'cars',
    'posts_per_page'    => '-1',
    'post__in' => array_unique(explode(',',$car_id))
    );
    $product_query = new WP_Query($wc_attr);

    if ($product_query->have_posts()) {
       while ($product_query->have_posts()) : $product_query->the_post();
     	$getlayout   = jws_get_cars_list_layout_style();
    
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
        
        
    endwhile;  
    }else {
       echo esc_html__('No result were found matching your selection.','idealauto'); 
    }
   
 ?>
</div>
                  