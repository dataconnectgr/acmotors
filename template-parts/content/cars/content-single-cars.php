<?php
    global $jws_option;
    
    
    $layout = (isset($jws_option['cars-detail-layout'])) ? $jws_option['cars-detail-layout'] : 'layout1';
    
    if(isset($_GET['car_layout']) && $_GET['car_layout'] == 'layout2') {
         $layout =  'layout2';
    }
   
    get_template_part( 'template-parts/content/cars/single/layout/'.$layout);
?>