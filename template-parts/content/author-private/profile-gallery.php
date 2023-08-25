<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$user = get_userdata( $author );
$gallery = get_user_meta( $user->ID , 'dealer_images', true );
wp_enqueue_script( 'jquery-ui-droppable' );
?>
<div class="jws_add_car_form">

    <?php if ((is_array($gallery) && empty($gallery[0])) || empty($gallery)): ?>
        <div class="jws-add-media-car">
            <div class="jws-media-car-main-input clear-both">
                <input id="file_attachments" name="file_attachments" type="hidden" class="form-control file_attachments">
                <input type="file" name="dealer_images[]" multiple accept="image/png, image/svg, image/jpeg"/>
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

        <?php $images_js = array(); ?>
        <div class="jws-add-media-car<?php if(!empty($gallery)) echo ' hasImages'; ?>">
            <div class="jws-media-car-main-input">
                <input id="file_attachments" name="file_attachments" type="hidden" class="form-control file_attachments" value="">
                <input type="file" name="dealer_images[]" multiple accept="image/png, image/svg, image/jpeg"/>
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
