<div class="calculate-tabs">
    <div class="tabs-nav">
        <li data-tabs="finance" class="finance active"><?php echo esc_html__('Finance','idealauto'); ?></li>
        <li data-tabs="lease" class="lease"><?php echo esc_html__('Lease','idealauto'); ?></li>
    </div>
    <div class="calculate-content">
        <div class="tabcontent accordion-active" id="finance">
           <div class="cars-Tabs-panel"> 
           <div class="month-results">
                <label class="color-heading"><?php echo esc_html__('Estimated Payment','idealauto'); ?></label>
                <div class="month-price-results">
                  <span class="price"></span><span>/ month</span>
                </div> 
           </div>
           <div class="rate-results">
                <p class="rax-text"><?php echo esc_html__('incl. taxes & fees, on approved credit','idealauto'); ?></p>
                <p><span class="color-heading"><span class="month-rt">36</span> <?php echo esc_html__('Months','idealauto'); ?> @ <span class="rate-rt">1.99</span>% A.P.R.</span> (<?php echo esc_html__('estimated financing rate','idealauto'); ?>)</p>
                <p class="color-heading">(<span class="down-rt">$0</span> <?php echo esc_html__('Down Payment','idealauto'); ?>)</p>
           </div>
            <div>
                <a class="open-modal content-loaded" href="#" data-target="#calculate-payment"><?php echo esc_html__('Calculate Another Payment','idealauto'); ?></a>
                <div class="car-form-popup" id="calculate-payment">
                    <div class="modal-overlay"></div>
                    <div class="car-form-popup-inner">
                    <div class="car-form-popup-inner-animation"> 
                         <span class="close-modal jws-icon-icon_close"></span>   
                         <h3><?php echo esc_html__('Payment Calculator','idealauto'); ?></h3>  
                         <?php get_template_part( 'template-parts/content/cars/form/calculate-form' ); ?> 
                    </div>
                    </div>
                </div>
            </div>
           </div> 
        </div>
        <div class="tabcontent" id="lease">
            <div class="cars-Tabs-panel">
            <div class="month-results">
                <label class="color-heading"><?php echo esc_html__('Estimated Payment','idealauto'); ?></label>
                <div class="lease_month-price-results">
                  <span class="price"></span><span>/ month</span>
                </div> 
           </div>
            <div class="rate-results">
                <p class="rax-text"><?php echo esc_html__('incl. taxes & fees, on approved credit','idealauto'); ?></p>
                <p><span class="color-heading"><span class="lease_month-rt">36</span> <?php echo esc_html__('Months','idealauto'); ?></p>
                <p class="color-heading">(<span class="lease_down-rt">$0</span> <?php echo esc_html__('Down Payment','idealauto'); ?>)</p>
            </div>
             <div>
              <a class="open-modal content-loaded" href="#" data-target="#lease-payment"><?php echo esc_html__('Calculate Another Payment','idealauto'); ?></a>
              <div class="car-form-popup" id="lease-payment">
                    <div class="modal-overlay"></div>
                    <div class="car-form-popup-inner">
                         <div class="car-form-popup-inner-animation"> 
                         <span class="close-modal jws-icon-icon_close"></span>   
                         <h3><?php echo esc_html__('Payment Calculator','idealauto'); ?></h3>  
                         <?php get_template_part( 'template-parts/content/cars/form/lease-form' ); ?> 
                         </div>  
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>