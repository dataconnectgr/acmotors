<?php 
$getlayout   = jws_get_cars_list_layout_style();
if($getlayout == 'view-list') {
   ?>
    <div class="col-xl-12 list">
        <?php 
            get_template_part( 'template-parts/content/cars/list' );  
        ?>
    </div>
    <span class="car-line"></span> 
  <?php   
}else{
   ?>
    <div class="car-item col-xl-4 col-lg-6 grid">
        <?php 
            get_template_part( 'template-parts/content/cars/grid' );
        ?>
    </div> 
  <?php   
} 