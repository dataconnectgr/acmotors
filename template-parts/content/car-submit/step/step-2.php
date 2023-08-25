<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$jws_option;
?>
<div id="add_car_step2" class="jws-form-row">

    <div class="step-number">
        <span><?php echo esc_html__('Step','idealauto'); ?> 2/5</span><span class="step-text"><?php echo esc_html__('Upload Media','idealauto'); ?></span>
    </div>
   
    <div class="section-inner add-car-gallery">
    <div class="upload-gallery-notes">
        <h4 class="section-title"><?php echo esc_html__('Recommendation & guides','idealauto'); ?></h4>
        <h5><?php echo esc_html__('Recomended Image Resolution: 800 x 470 px or higher','idealauto'); ?></h5>
        <p><?php echo esc_html__('Pellentesque non lorem auctor sem commodo blandit. Vestibulum posuere sit amet mi quis luctus. Proin placerat purus metus, vel consequat tellus efficitur vel.','idealauto'); ?></p>
    </div>

    <!--  -->
    <div class="ac-upload-des">
        <h5><?php echo esc_html__('Upload Vehicle Photo:','idealauto'); ?></h5>
        <span><?php echo esc_html__('Add at least 5 pictures to get more response','idealauto'); ?></span>
    </div>
    <?php if (empty($id)): ?>
        <div class="jws-add-media-car">
            <div class="jws-media-car-main-input clear-both">
                <input id="file_attachments" name="file_attachments" type="hidden" class="form-control file_attachments">
                <input type="file" name="car_images[]" multiple accept="image/png, image/svg, image/jpeg"/>
                <div class="jws-placeholder">
                    <i class="jws-icon-upload"></i>
                    <div class="text-between">
                        <?php echo esc_html__('Drag & Drop your files here','idealauto'); ?> 
                        <p><?php echo esc_html__('OR','idealauto'); ?></p>     
                    </div>
                    <button type="submit"><?php esc_html_e('Choose files', 'idealauto'); ?></button>
                </div>
            </div>
            <div class="jws-media-car-gallery clear-both">
                <?php $i = 1;
                while ($i <= 4): $i++; ?>
                    <div class="jws-placeholder jws-placeholder-native">
                        <div class="inner">
                            <i class="jws-icon-add"></i>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php else: ?>
        <?php $gallery = get_post_meta($id, 'car_images', true);   ?>
        <?php $images_js = array(); ?>
        <div class="jws-add-media-car<?php if(!empty($gallery)) echo ' hasImages'; ?>">
            <div class="jws-media-car-main-input">
                <input id="file_attachments" name="file_attachments" type="hidden" class="form-control file_attachments" value="">
                <input type="file" name="car_images[]" multiple accept="image/png, image/svg, image/jpeg"/>
                <div class="jws-placeholder">
                    <i class="jws-icon-upload"></i>
                    <div class="text-between">
                        <?php echo esc_html__('Drag & Drop your files here','idealauto'); ?> 
                        <p><?php echo esc_html__('OR','idealauto'); ?></p>     
                    </div>
                    <button type="submit"><?php esc_html_e('Choose files', 'idealauto'); ?></button>
                </div>
                <?php if (!empty($gallery)):
                        $image = wp_get_attachment_image_src($gallery[0], 'full');
                        if (!empty($image[0])) {
                            $image = 'style=background-image:url("' . $image[0] . '")';
                        } 
                 ?>
                 <div class="jws-image-preview jws-placeholder-generated-php" <?php echo esc_attr($image); ?>></div>
               <?php endif; ?>
            </div>
            <div class="jws-media-car-gallery clear-both">
            <?php if (!empty($gallery)):  ?>
                
                    
                    <?php if (!empty($gallery)): ?>
                        <?php foreach ($gallery as $gallery_key => $gallery_id): ?>
                            <?php $image = '';
                            if (!empty($gallery_id)) {
                                $image = wp_get_attachment_image_src($gallery_id, 'full');
                                if (!empty($image[0])) {
                                    $image = 'style=background-image:url("' . $image[0] . '")';
                                    $images_js[] = intval($gallery_id);
                                }
                            }

                            if (!empty($image)): ?>
                                <div
                                    class="jws-placeholder jws-placeholder-generated jws-placeholder-generated-php">
                                    <div class="inner">
                                        <div class="jws-image-preview"
                                             data-media="<?php echo intval($gallery_id); ?>"
                                             data-id="<?php echo esc_attr($gallery_key); ?>" <?php echo esc_attr($image); ?>>
                                            <i class="remove jws-icon-icon_close"
                                               data-id="<?php echo esc_attr($gallery_key); ?>"
                                               data-media="<?php echo intval($gallery_id); ?>"></i>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
              

                <script type="text/javascript">
                    var jwsUserFilesLoaded = [
                        <?php foreach ($images_js as $image_js) {
                        echo intval($image_js) . ',';
                    } ?>
                    ]
                </script>

            <?php else: ?>
             <?php $i = 1;
                while ($i <= 4): $i++; ?>
                    <div class="jws-placeholder jws-placeholder-native">
                        <div class="inner">
                            <i class="jws-icon-add"></i>
                        </div>
                    </div>
                <?php endwhile; ?>
            
            <?php endif; ?>
            </div>
        </div> 
    <?php endif; ?>
    </div>

    <?php if(isset($jws_option['car_sub_video']) && $jws_option['car_sub_video']) : ?>
    <div class="section-inner add-car-video">
        <h4 class="section-title"><?php echo esc_html__('ADD VIDEO','idealauto'); ?></h4>
        <div class="video-wap">
            <?php if (empty($id)): ?>
                 <div class="video-item">
                    <label><i class="jws-icon-icon_link_alt"></i><?php echo esc_html__('Video Link ','idealauto'); ?><span class="number">1</label></h5>
                    <div class="video-link-input">
                        <input type="text" name="car_data[video_link][]" placeholder="<?php echo esc_attr_x( '-- Enter a Link --', 'placeholder', 'idealauto' ); ?>" value=""/>
                        <button type="button"><i class="jws-icon-icon_plus"></i></button>
                    </div>
                </div>
            <?php else :
            $video_list = get_post_meta($id, 'video_link', true);  $video_list = explode(',',$video_list);
                $count = 1;
                if(!empty($video_list)) {
                    foreach($video_list as $video) { ?>
                       <div class="video-item">
                            <h5><i class="jws-icon-icon_link_alt"></i><?php echo esc_html__('Video Link ','idealauto'); ?><span class="number"><?php echo esc_html($count); ?></span></h5>
                            <div class="video-link-input">
                                <input type="text" name="car_data[video_link][]" placeholder="<?php echo esc_attr_x( '-- Enter a Link --', 'placeholder', 'idealauto' ); ?>" value="<?php echo esc_attr($video); ?>"/>
                                <button type="button"><i class="jws-icon-icon_plus"></i></button>
                            </div>
                       </div> 
                       <?php
                       $count++; 
                    }  
                }
           endif;  ?>
           
        </div>
        <p><i class="jws-icon-icon_info"></i><?php echo esc_html__('If you don\'t have the videos handy, don\'t worry. You can add or edit them after you complete your ad using the "My Ads" page.','idealauto'); ?></p>
    </div>
    <?php endif; ?>
    <?php if(isset($jws_option['car_sub_brochure']) && $jws_option['car_sub_brochure']) : ?>
    <div class="section-inner brochure">
        <h4 class="section-title"><?php echo esc_html__('ADD VEHICLE BROCHURE','idealauto'); ?></h4>
        <?php 
        
            $value = get_post_meta($id, 'window_sticker_file', true);
            if ( !empty( $value ) ) {
					if ( wp_attachment_is( 'pdf', $value ) ) {
						$pdf_file_url = wp_get_attachment_url( $value );
						?>
						<div class="pdf-value">
						<a href="javascript:void(0)" data-attach_id="<?php echo esc_attr( $value ); ?>" class="drop_img_item"><span class="remove"><i class="jws-icon-clear"></i></span></a>
						<a href="<?php echo esc_url( $pdf_file_url ); ?>" download><i class="fa fa-file-pdf-o"></i><?php echo esc_html__( 'PDF Brochure', 'idealauto' ); ?></a></div>
						<?php
					}
			}
       
        
        ?>
        <input type="file" id="car-pdf" name="window_sticker_file" accept="application/pdf">
        <input type="hidden" name="pdf-value"  value="<?php echo esc_attr($value); ?>"/>
    </div>
    <?php endif; ?>
    <div class="step-button">
        <button type="button" id="previous1" class="previous"><i class="jws-icon-arrow-left"></i><?php echo esc_html__('Prev','idealauto'); ?></button>
        <button type="button" id="next2" class="next"><?php echo esc_html__('Next','idealauto'); ?><i class="jws-icon-arrow-right"></i></button>
    </div>
</div>
