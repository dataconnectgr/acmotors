<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage idealauto
 * @since 1.0.0
 */
global $jws_option; 

    $comments_number = get_comments_number();
    $archive_year  = get_the_time('Y'); 
	$archive_month = get_the_time('m'); 
	$archive_day   = get_the_time('d');
    $gallery = get_post_meta( get_the_ID(), 'blog_gallery', true );
    $image_size = (isset($jws_option['blog_imagesize']) && !empty($jws_option['blog_imagesize'])) ? $jws_option['blog_imagesize'] : 'full';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <header>
                  <div class="jws_post_image<?php if(!has_post_thumbnail()) echo esc_attr(' post-no-thumbnail'); ?>">
                    <span class="entry-date"><a href="<?php echo esc_url(get_day_link($archive_year, $archive_month, $archive_day)); ?>"><?php echo get_the_date(); ?></a></span>
                    <div class="jws_post_image_inner<?php if(!empty($gallery)) echo esc_attr(' post-image-slider'); ?>">
                    <?php 
                        
                       echo !empty($gallery) ? '<div class="slick-slide">' : '<div>';
                           if (function_exists('jws_getImageBySize')) {
                                 $attach_id = get_post_thumbnail_id();
                                 $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => $image_size, 'class' => 'attachment-large wp-post-image'));
                                 echo ''.(!empty($img['thumbnail'])) ? ''.$img['thumbnail'] : '';
                           } 
                       echo '</div>'; 
                      if(!empty($gallery)) {
                           foreach($gallery as $image_id) {
                                echo '<div class="slick-slide">'; 
                                    if (function_exists('jws_getImageBySize')) {
                                         $img = jws_getImageBySize(array('attach_id' => $image_id, 'thumb_size' => $image_size, 'class' => 'blog-gallery'));
                                         echo ''.(!empty($img['thumbnail'])) ? ''.$img['thumbnail'] : '';
                                    }
                                echo '</div>';      
                           } 
                      }
                     
                  ?>
                </div>
                </div>
                <div class="post-bottom">
                    <div class="entry-category"><?php echo get_the_term_list(get_the_ID(), 'category', '', ', '); ?></div> 
                  <?php if(function_exists('jws_share_buttons2')) echo jws_share_buttons2(); ?>
                     <a href="<?php echo get_the_permalink().'#comments'; ?>" class="entry-comment"><span class="jws-icon-icon_comment"></span><?php echo ''.$comments_number; ?></span></a>
               </div>
                <h2 class="entry_title">
                    <?php echo get_the_title(); ?>
                </h2>
                <span class="post_author"><?php echo esc_html__('Written by ','idealauto'); ?><?php echo '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.get_the_author(); ?></a></span> 
               
           </header>
           <div class="entry_content">
                <?php the_content(); ?> 
           </div>
           <div class="clear-both"></div>
           <footer>
                <div class="row">
                    <div class="col-xl-7 col-lg-6 col-12">
                        <?php echo jws_get_tags(); ?>
                    </div>
                    <div class="col-xl-5 col-lg-6 col-12">
                        <?php if(function_exists('jws_share_buttons')) echo jws_share_buttons(); ?>
                    </div>
                </div>
                <?php 
                    get_template_part( 'template-parts/content/blog/single/template/author_box/author_box1' );
                    get_template_part( 'template-parts/content/blog/single/template/nav/nav2' ); 
                    if (did_action( 'elementor/loaded' ) ) { 
                 ?>
                <div class="post-related">
                    <h3><?php esc_html_e('Related Post','idealauto'); ?></h3>
                     <div class="post_related_slider jws-blog-archive" data-slick='{"slidesToShow":2 ,"slidesToScroll": 1, "infinite" : true, "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 2}},{"breakpoint": 767,"settings":{"slidesToShow": 2}},{"breakpoint": 480,"settings":{"slidesToShow": 1}}]}'>
                        <?php get_template_part( 'template-parts/content/blog/single/template/related' ); ?>
                     </div>
                </div>
                
       
                <?php
                }
                     // If comments are open or we have at least one comment, load up the comment template.
    				if ( comments_open() || get_comments_number() ) {
    					comments_template();
    				}
                 ?>
            </footer>   
		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'idealauto' ),
				'after'  => '</div>',
			)
		);
		?>

</article><!-- #post-<?php the_ID(); ?> -->
