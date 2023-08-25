<?php
$related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 100,'post_type' => 'post', 'post__not_in' => array($post->ID) ) );
              
if( isset($related[0]) ) foreach( $related as $post ) {
setup_postdata($post); 
    $format = has_post_format() ? get_post_format() : 'no_format'; ?> 
   <div class="jws_blog_item col-xl-6 col-lg-6 col-12 slick-slide">
        <?php 
            get_template_part( 'template-parts/content/blog/layout/related' );
        ?>
    </div>       
<?php
}
wp_reset_postdata();

?>