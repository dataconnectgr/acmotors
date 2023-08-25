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
 
   
    $wc_attr = array(
    'post_type'         => 'cars',
    'posts_per_page'    => '-1',
    'author' => $author,
    'post_status' => array('publish', 'pending' , 'draft')    

    );
    $product_query = new WP_Query($wc_attr);

    if ($product_query->have_posts()) {
       while ($product_query->have_posts()) : $product_query->the_post();
     	$getlayout   = jws_get_cars_list_layout_style();
       
           ?>
            <div class="col-xl-12 list">
                <?php 
                    get_template_part( 'template-parts/content/cars/list-private' );
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
       echo '<div class="col-xl-12">'.esc_html__('No result were found matching your selection.','idealauto').'</div>'; 
    }
   
 ?>
</div>
 
<div class="jws-delete-confirmation-popup">
	<div class="jws-confirmation-text heading-font">
		<span class="jws-danger"><?php esc_html_e('Delete', 'idealauto'); ?></span>
		<span class="jws-car-title"></span>
	</div>
	<div class="actions">
		<a href="#" class="delete elementor-button btn-main"><?php esc_html_e('Delete', 'idealauto'); ?></a>
		<a href="#" class="cancel elementor-button"><?php esc_html_e('Cancel', 'idealauto'); ?></a>
	</div>
</div>
<div class="jws-delete-confirmation-overlay"></div>


<script>
	jQuery(document).ready(function(){
		var $ = jQuery;
		/*jws confirmation before delete*/
		var urlToProceed = '';
		//Open confirmation
		$('.remove-cars').on('click', function(e){
			e.preventDefault();

			urlToProceed = $(this).attr('href');
			var carTitle = $(this).data('title');

			$('.jws-delete-confirmation-popup').addClass('active');
			$('.jws-delete-confirmation-overlay').addClass('active');

			$('.jws-confirmation-text .jws-car-title').text(carTitle);
		});

		//Delete
		$('.jws-delete-confirmation-popup .actions .delete').on('click', function(e){
			    e.preventDefault();
                var urlToGo = urlToProceed;

                var confirm = window.confirm("<?php esc_html_e('Are you sure?','idealauto'); ?>");

                if (confirm) {
                    window.location = urlToGo;
                }
		});

		//Cancel delete
		$('.jws-delete-confirmation-popup .actions .cancel, .jws-delete-confirmation-overlay').on('click', function(e) {
			e.preventDefault();
			$('.jws-delete-confirmation-popup').removeClass('active');
			$('.jws-delete-confirmation-overlay').removeClass('active');
		});
	});
</script>                