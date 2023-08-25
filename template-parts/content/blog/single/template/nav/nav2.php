<?php
$archive_year  = get_the_time('Y'); 
$archive_month = get_the_time('m'); 
$archive_day   = get_the_time('d');
$prev_post = get_previous_post(); $next_post = get_next_post(); 
?>
<nav class="navigation post-navigation" role="navigation">
    			<?php 
                        if(!empty($prev_post)){    
                            $image_id = get_post_thumbnail_id($prev_post->ID);
                            $img = jws_getImageBySize(array('attach_id' => $image_id, 'thumb_size' => '160x160', 'class' => 'attachment-large wp-post-image'));
                            $img = (!empty($img['thumbnail'])) ? ''.$img['thumbnail'] : '';
                            
                            $no_thumb = empty($img) ? ' no-thumbnail' : '';
                           
                            echo '<div class="left'.$no_thumb.'">
                                   <div class="images_nav">
                                   '.$img.'
                                   </div> 
                                   <div class="content_nav">
                                
                                        <h5 class="title">
                                              <a href="'.get_the_permalink($prev_post->ID).'">'.get_the_title($prev_post->ID).'</a>
                                        </h5>
                                         <span class="entry-date"><a href="'.esc_url(get_day_link($archive_year, $archive_month, $archive_day)).'">'.get_the_date('',$prev_post->ID).'</a></span>
                                   </div>
                            </div>'; 
                      
                            }else {
                                $first = new WP_Query('posts_per_page=1&order=DESC'); $first->the_post(); 
                                $image_id = get_post_thumbnail_id($first->ID);
                                $img = jws_getImageBySize(array('attach_id' => $image_id, 'thumb_size' => '160x160', 'class' => 'attachment-large wp-post-image'));
                                $img = (!empty($img['thumbnail'])) ? ''.$img['thumbnail'] : '';
                                $no_thumb = empty($img) ? ' no-thumbnail' : '';
                                echo '<div class="left'.$no_thumb.'">
                                    <div class="images_nav">
                                   '.$img.'
                                   </div> 
                                   <div class="content_nav">

                                        <h5 class="title">
                                              <a href="'.get_the_permalink($first->ID).'">'.get_the_title($first->ID).'</a>
                                        </h5>
                                         <span class="entry-date"><a href="'.esc_url(get_day_link($archive_year, $archive_month, $archive_day)).'">'.get_the_date('',$first->ID).'</a></span>
                                   </div>
                                </div>';  
                        
                                 wp_reset_postdata();   
                            }
                            
                            ?>
                                <a href="<?php echo get_option( 'page_for_posts' ) ? esc_url(get_permalink( get_option( 'page_for_posts' ) )) : get_home_url(); ?>"><span class="jws-icon-icon_grid-2x2"></span></a>
                            <?php
                            
                            if(!empty($next_post)){
                                  $image_id = get_post_thumbnail_id($next_post->ID);
                   
                                  $img = jws_getImageBySize(array('attach_id' => $image_id, 'thumb_size' => '160x160', 'class' => 'attachment-large wp-post-image'));
                                  $img = (!empty($img['thumbnail'])) ? ''.$img['thumbnail'] : '';  
                                  $no_thumb = empty($img) ? ' no-thumbnail' : '';
                                   echo '<div class="right'.$no_thumb.'">
                                            
                                            <div class="content_nav">

                                               <h5 class="title">
                                                   <a href="'.get_the_permalink($next_post->ID).'">'.get_the_title($next_post->ID).'</a>
                                               </h5>
                                                <span class="entry-date"><a href="'.esc_url(get_day_link($archive_year, $archive_month, $archive_day)).'">'.get_the_date('',$next_post->ID).'</a></span>
                                            </div>
                                            <div class="images_nav">
                                           '.$img.'
                                           </div> 
                                   </div>';   
                            }else {
                                $last  = new WP_Query('posts_per_page=1&order=ASC'); $last->the_post();
                                $image_id = get_post_thumbnail_id($last->ID);
                                $img = jws_getImageBySize(array('attach_id' => $image_id, 'thumb_size' => '160x160', 'class' => 'attachment-large wp-post-image'));
                                $img = (!empty($img['thumbnail'])) ? ''.$img['thumbnail'] : '';
                                $no_thumb = empty($img) ? ' no-thumbnail' : '';
                                 echo '<div class="right'.$no_thumb.'">
                                            <div class="content_nav">

                                               <h5 class="title">
                                                   <a href="'.get_the_permalink($last->ID).'">'.get_the_title($last->ID).'</a>
                                               </h5>
                                                <span class="entry-date"><a href="'.esc_url(get_day_link($archive_year, $archive_month, $archive_day)).'">'.get_the_date('',$last->ID).'</a></span>
                                            </div>
                                             <div class="images_nav">
                                           '.$img.'
                                           </div> 
                                   </div>';
                                   wp_reset_postdata(); 
                            }
                 ?>
</nav><!-- .navigation -->
