<div class="car-inner row row-eq-height">
    <div class="car-image col-xl-8 col-lg-6 col-12">
        <a href="<?php the_permalink(); ?>">
            <?php  
                $image = get_post_meta( get_the_ID(), 'car_images_transparent', true );
                $size = 'full'; // (thumbnail, medium, large, full or custom size)
                if( $image ) {
                    echo wp_get_attachment_image( $image, $size );
                }
            ?>
        </a>
    </div>
    <div class="car-content col-xl-4 col-lg-6 col-12">
        <div class="car-content-top">
             <div class="car-tittle">
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </div>
        </div>
         <div class="car-content-center">
            <?php 
                jws_get_cars_list_attribute_grid('yes','');
                the_excerpt();
            ?>
        </div>
        <div class="car-content-bottom">
            <div class="car-price-wap">
                <?php echo esc_html__('Form ','idealauto'); jws_car_price_html(); ?>
            </div>
        </div>
    </div>
</div>
 