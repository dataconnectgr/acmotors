<?php        
               
               global $jws_option;
               $locations = array(); 
               $unit ='km'; 
               $unit_text = esc_html__(' km','idealauto');
               if(isset($jws_option['unit_distance'])) {
                    $unit = 'mile';
               }
               if(isset($_GET['results']) && !empty($_GET['results']) ) {
                    $number = $_GET['results'];  
               }else {
                    $number = '-1'; 
               }  
                
                $loc =  array( 
                    'include' => return_dealer_id_from_query(),
                    'number' => $number,
                );

              $user_query = new WP_User_Query($loc);
              $users = $user_query->get_results();
              $i = 0;
               ?> <div class="row">
               <div class="col-xl-6 col-lg-6">
               <div class="dealer-list-result">
               <?php if(!empty($users)) {
                    
                    foreach ( $user_query->get_results() as $user ) {
                        $location_object = array();
                        $author_id = $user->ID;
                    
                        $long =  get_the_author_meta('dealer_location',$author_id); 

                        if(!empty($_GET['lat']) && !empty($_GET['lng'])) {
                            $check = check_km_location($_GET['address'],$long['address']);
                            
                            if(!is_null($check)) {
                                
                               $check = $check / 1000;
                                if($unit == 'mile') {
                                   $check = $check * 0.621371192;
                                   if($check >= 2) {
                                        $unit_text = esc_html__(' miles','idealauto');
                                   }else{
                                    $unit_text = esc_html__(' mile','idealauto');
                                   }
                                   
                                }
                          
                                if(isset($_GET['dealer_radius']) && $check > $_GET['dealer_radius']) {
                                    continue;
                                } 
                               }else {
                                       continue;
                               } 
                        }else{
                            $check = '0';
                        } 

                    ?>
                    
                    <div class="dealer-info-list"> 
                            <div class="car-status">
                            <?php if($check != '0') { ?>
                                   <span class="car-km"><?php echo esc_html(round($check, 1)).$unit_text; ?></span>      
                            <?php } ?>    
                            <?php echo '<span class="number-cars">'.get_cars_number_in_dealer($author_id).esc_html__(' cars','idealauto').'</span>'; ?>
                            </div>   
                            <a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>">
                            <div class="dealer-image">
                                <?php
                                   $author_badge = get_the_author_meta('dealer-avatar',$author_id);
                                
                             
                                    if(!empty($author_badge)) {
                                      $img = jws_getImageBySize(array('attach_id' => $author_badge, 'thumb_size' => 'thumbnail', ''));  
                                      echo ''.$img['thumbnail'];
                                    }else{
                        			     echo '<img src="http://0.gravatar.com/avatar/?s=160&d=mm&r=g%202x" width="80" height="80" alt="car-image-default">';
                        			} 
                                  ?>
                                <div>
                                    <h4 class="dealer-name"><?php echo get_the_author_meta('display_name',$author_id); ?></h4>
                                    <?php $ratings = jws_get_dealer_marks($author_id);  ?>
                                    <?php if (!empty($ratings['average'])): ?>
                                        <div class="jws-star-rating">
                                            <?php dealer_review_html($ratings); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div><ul class="ct_ul_ol contact-info">
                                <?php 
                                    if(!empty($long)) {
                                       echo '<li class="dealer-address"><i class="fas fa-map-marker-alt"></i><span>'.$long['address'].'</span></li>'; 
                                    }
                                    $phone = get_the_author_meta('dealer_phone',$author_id);
                                    if(!empty($phone)) {
                                       echo '<li class="dealer-phone"><i class="fas fa-phone-alt"></i><span>'.$phone.'<span></li>'; 
                                    }
                                    $mail = get_the_author_meta('email',$author_id);
                                    if(!empty($phone)) {
                                       echo '<li class="dealer-email"><i class="fas fa-envelope"></i>'.$mail.'</li>'; 
                                    }
                                 ?>
                           </ul>
                            </a>
                    </div>   
                      <?php
                        $location_object[] = get_the_author_meta('display_name',$author_id);
                        if(!empty($long['address'])) $location_object[] = $long['address'];
                        $location_object[] = get_author_posts_url( $author_id );
                        if(!empty($author_badge)) {
                          $img = jws_getImageBySize(array('attach_id' => $author_badge, 'thumb_size' => 'thumbnail', ''));  
                          $location_object[] = $img['thumbnail'];
                        }else{
            			 $location_object[] = '<img src="http://0.gravatar.com/avatar/?s=160&d=mm&r=g%202x" width="80" height="80" alt="car-image-default">';
            			} 
                        $location_object[] = esc_html__('View Dealer','idealauto');               
                        $locations[] = $location_object;
                       
                       $i++; }
                        
                          if($i < 1) {
                                echo esc_html('No dealer found.','idealauto');
                          }
                          }
                          
                          else {
                            echo esc_html('No dealer found.','idealauto');
                          }
                      ?> 
                      </div>
                      </div>
                      <div class="col-xl-6 col-lg-6">
                 
                        <?php
                        
                            $address = ''; 
                            $short_address = '';
                            $lat = '43.656081'; 
                            $lng = '-79.380171';
                                
                                
                            if(!empty($_GET['address'])) {
                                $locations[] = array(
                                 esc_html__('Start Location','idealauto'),   
                                 $_GET['address'],
                                 '',
                                 '',
                                 ''
                                );
                            }        
                      
                            	// get the default
                            	 $location_exits = true; $lat = $lan = "";
                            	
                            	if( isset( $jws_option['default_value_lat'] ) && isset( $jws_option['default_value_long'] ) && !empty( $jws_option['default_value_lat'] ) && !empty( $jws_option['default_value_long'] ) ){
                            		$lat = $jws_option['default_value_lat'];
                            		$lng = $jws_option['default_value_long'];
                            	}
                    
                        
                        ?>
                        <div class="section-inner maps">
                        <div class="map_container">
                            <div id="canvas2">
                        
                        
                                <div id="type-selector" class="controls control-group">
                                
                                    <input id="cordinats2" type="hidden"  name="location_lat_long" value="<?php echo
                        			esc_attr( $lat.','.$lng ); ?>"/>
                        
                                    <input id="formatted_address" data-geo="formatted_address"
                                           name="location_formatted_address" type="hidden" value="<?php echo esc_attr($address ); ?>">
                        
                        
                                    <input type="hidden" id="location_lon" name="jws_lng" value="<?php echo
                        			esc_attr( $lng ); ?>">
                                    <input type="hidden" id="location_lat" name="jws_lat" value="<?php echo
                        			esc_attr( $lat ); ?>">
                        
                                </div>
                                
                            </div>
                            <div style="height: 760px;" data-location='<?php echo wp_json_encode( $locations ); ?>' id="map-canvas"></div>
                        </div>
                        </div>
                      </div>
                      </div>
                
