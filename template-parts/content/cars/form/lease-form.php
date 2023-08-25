<?php
        $car_id = get_the_ID(); 
		$regular_price =  get_post_meta( $car_id, 'regular_price', true );
		$sale_price    =  get_post_meta( $car_id, 'sale_price',  true );
        
        $defaul_price = '';
        if(!empty($sale_price)) {
          $defaul_price = $regular_price;  
        }elseif(!empty($regular_price)) {
          $defaul_price = $regular_price;  
        }
        
?>
<div id="calculate-payment-form">
    
    <form>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-12">
                <div class="form-tabs">
                  
                    <div class="form-tabs-content row">
                        <div class="col-xl-6">
                           <label><?php echo esc_html__('My asking price','idealauto'); ?></label>
                           <input type="number" id="lease_price" name="lease_price" value="<?php echo esc_attr($defaul_price); ?>">
                        </div>
                        <div class="col-xl-6">
                          <label><?php echo esc_html__('Miles per year','idealauto'); ?></label>
                          <select name="lease_miles" id="lease_miles">
                                <option value="0"><?php echo esc_html('10000'); ?></option>
                                <option value="4"><?php echo esc_html('12000'); ?></option>
                                <option value="8"><?php echo esc_html('15000'); ?></option>
                          </select>
                        </div>
                        <div class="col-xl-6">
                          <label><?php echo esc_html__('Due at Signing','idealauto'); ?></label>
                          <input type="number" id="lease_cash_down" name="lease_cash_down" value="0">  
                        </div>
                        <div class="col-xl-6">
                          <label><?php echo esc_html__('Residual value','idealauto'); ?></label>
                          <input type="number" id="lease_residual" name="lease_residual" value="50">  
                        </div>
                         <div class="col-xl-12">
                        <label><?php echo esc_html__('Money factor','idealauto'); ?></label>  
                          <input type="number" id="lease_interest" name="lease_interest" value="0.00183">  
                        </div>
                        <div class="col-xl-12">
                           <label><?php echo esc_html__('Credit Score','idealauto'); ?></label> 
                           <select name="lease_score_credit" id="lease_score_credit">
                                <option value="0.00183"><?php echo esc_html__('Excellent (850 - 750)','idealauto'); ?></option>
                                <option value="0.00225"><?php echo esc_html__('Good (749 - 700)','idealauto'); ?></option>
                                <option value="0.00246"><?php echo esc_html__('Fair (699 - 641)','idealauto'); ?></option>
                                <option value="0.00392"><?php echo esc_html__('Rebuilding 640 or under','idealauto'); ?></option>
                          </select>
                        </div>
                         <div class="col-xl-12">
                           <label><?php echo esc_html__('Lease Term','idealauto'); ?></label>  
                           <select name="lease_term" id="lease_term">
                                <option  value="36">36 mo</option>
                                <option  value="48">48 mo</option>
                                <option value="60">60 mo</option>
                                <option  value="72">72 mo</option>
                          </select>
                        </div>
                       

                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-12">
               <div class="calculate-result">
                    <h4><?php echo esc_html__('Estimated Payment','idealauto'); ?></h4>
                    <div id="txtPayment">
                        <div class="lease_month-price-results">
                            <span class="price"></span><span>/ month</span>
                        </div> 
                        <div class="lease_rate-results">for <span class="lease_month-rt">36</span> months</div>
                    </div>
                       <div class="clear-both"></div>
                    <div class="calculate-list">
                        <div class="calculate-list-top">
                            <ul class="ct_ul_ol">
                                <li>
                                    <span><?php echo esc_html__('My Asking Price','idealauto'); ?></span>
                                    <span class="lease_list-price li-right"></span>
                                    <span class="clear-both"></span>
                                </li>
                                <li>
                                    <span><?php echo esc_html__('Down Payment','idealauto'); ?></span>
                                    <span class="lease_list-down li-right"></span>
                                    <span class="clear-both"></span>
                                </li>
                            </ul>
                        </div>
                        <div class="calculate-list-center">
                            <ul class="ct_ul_ol">
                                <li>
                                    <span><?php echo esc_html__('Annual Mileage ','idealauto'); ?></span>
                                    <span class="lease_mileage li-right"></span>
                                    <span class="clear-both"></span>
                                </li>
                                 <li>
                                    <span><?php echo esc_html__('Residual Value ','idealauto'); ?>(<span class="residual_number">50</span>%)</span>
                                    <span class="lease_residual li-right"></span>
                                    <span class="clear-both"></span>
                                </li>
                            </ul>
                        </div>
                        <div class="calculate-list-bottom">
                            <ul class="ct_ul_ol">
                                 <li>
                                    <span><?php echo esc_html__('MONTHLY PAYMENT','idealauto'); ?></span>
                                    <span class="lease_list-totals-loan li-right"></span>
                                    <span class="clear-both"></span>
                                </li>
                            </ul>
                        </div>
                        <p>
                            <?php echo esc_html__("*Estimated payments are for informational purposes only and don't account for financing pre-qualifications, acquisition fees, destination charges, tax, title, and other fees and incentives or represent a financing offer or guarantee of credit from the seller.",'idealauto'); ?>
                        </p>
                    </div>
                    <a class="calculator_btn do_calculator_clear btn-main elementor-button" href="javascript:void(0);"><?php echo esc_html__('Clear','idealauto'); ?></a>
                    <a class="calculator_btn do_calculator btn-main elementor-button" href="javascript:void(0);"><?php echo esc_html__('Calculate','idealauto'); ?></a>
               </div>
            </div>
        </div>
    </form>
</div>