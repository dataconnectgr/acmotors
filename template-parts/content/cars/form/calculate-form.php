<?php
        $car_id = get_the_ID(); 
		$regular_price = get_post_meta( $car_id, 'regular_price', true );
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
                 <div class="form-tabs-nav">
                        <span class="form-tabs-nav-left">
                            <input type="radio" class="stv-radio-tab" name="apr" value="1" id="tab1" checked />
                        	<label for="tab1"><?php echo esc_html__('Estimate my APR','idealauto'); ?></label>
                        </span>
                    	<span class="form-tabs-nav-right">
                            <input type="radio" class="stv-radio-tab" name="apr" value="2" id="tab2" />
                            <label for="tab1"><?php echo esc_html__('I know my APR','idealauto'); ?></label>
                        </span>	
                </div>
                <div class="form-tabs">
                  
                    <div class="form-tabs-content row">
                        <div class="col-xl-6">
                           <label><?php echo esc_html__('Vehicle Price','idealauto'); ?></label>
                           <input type="number" id="price" name="price" value="<?php echo esc_attr($defaul_price); ?>">
                        </div>
                        <div class="col-xl-6">
                          <label><?php echo esc_html__('Sale Tax','idealauto'); ?></label>  
                          <input type="number" id="sale_tax" name="sale_tax" value="0" >  
                        </div>
                        <div class="col-xl-6">
                          <label><?php echo esc_html__('Cash Down','idealauto'); ?></label>
                          <input type="number" id="cash_down" name="cash_down" value="0">  
                        </div>
                        <div class="col-xl-6">
                          <label><?php echo esc_html__('Trade-in Value','idealauto'); ?></label>
                          <input type="number" id="trade_value" name="trade_value" value="0">  
                        </div>
                        <div class="col-xl-12 no-apr">
                           <label><?php echo esc_html__('Credit Score','idealauto'); ?></label> 
                           <select name="score_credit" id="score_credit">
                                <option value="excellent"><?php echo esc_html__('Excellent (850 - 750)','idealauto'); ?></option>
                                <option value="good"><?php echo esc_html__('Good (749 - 700)','idealauto'); ?></option>
                                <option value="fair"><?php echo esc_html__('Fair (699 - 641)','idealauto'); ?></option>
                                <option value="rebuilding"><?php echo esc_html__('Rebuilding 640 or under','idealauto'); ?></option>
                          </select>
                        </div>
                        <div class="col-xl-12 no-apr">
                           <label><?php echo esc_html__('Loan Term & Est.APR','idealauto'); ?></label>  
                           <select name="loan_term" id="loan_term">
                                <option data-month="36" data-position="1" value="1.99">36 mo <small>1.99% APR</small></option>
                                <option data-month="48" data-position="2" value="2.49">48 mo <small>2.49% APR</small></option>
                                <option data-month="60" data-position="3" value="2.99">60 mo <small>2.99% APR</small></option>
                                <option data-month="72" data-position="4" value="3.24">72 mo <small>3.24% APR</small></option>
                          </select>
                        </div>
                        <div class="col-xl-12 my-apr">
                          <label><?php echo esc_html__('Interest Rate','idealauto'); ?></label>  
                          <input type="number" id="interest" name="interest" value="0">  
                        </div>
                        <div class="col-xl-12 my-apr">
                           <label><?php echo esc_html__('Loan Term (Months)','idealauto'); ?></label>  
                           <select name="loan_term_2" id="loan_term_2">
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
                        <div class="month-price-results">
                             <span class="price"></span><span>/ month</span>
                        </div> 
                        <div class="rate-results">for <span class="month-rt">36</span> months at <span class="rate-rt">4.5</span>% APR.</div>
                    </div>
                    <div class="clear-both"></div>
                    <div class="calculate-list">
                        <div class="calculate-list-top">
                            <ul class="ct_ul_ol">
                                <li>
                                    <span><?php echo esc_html__('Price','idealauto'); ?></span>
                                    <span class="list-price li-right"></span>
                                    <span class="clear-both"></span>
                                </li>
                                <li>
                                    <span><?php echo esc_html__('Down Payment','idealauto'); ?></span>
                                    <span class="list-down li-right"></span>
                                    <span class="clear-both"></span>
                                </li>
                                <li>
                                    <span><?php echo esc_html__('Trade-in Value','idealauto'); ?></span>
                                    <span class="list-trade li-right"></span>
                                    <span class="clear-both"></span>
                                </li>
                                <li>
                                    <span><?php echo esc_html__('Sales Tax','idealauto'); ?></span>
                                    <span class="list-sales li-right"></span>
                                    <span class="clear-both"></span>
                                </li>
                            </ul>
                        </div>
                        <div class="calculate-list-center">
                            <ul class="ct_ul_ol">
                                <li>
                                    <span><?php echo esc_html__('Est. Total Financed','idealauto'); ?></span>
                                    <span class="list-totals-financed li-right"></span>
                                    <span class="clear-both"></span>
                                </li>
                                 <li>
                                    <span><?php echo esc_html__('Est. Total Interest','idealauto'); ?></span>
                                    <span class="list-totals-interest li-right"></span>
                                    <span class="clear-both"></span>
                                </li>
                            </ul>
                        </div>
                        <div class="calculate-list-bottom">
                            <ul class="ct_ul_ol">
                                 <li>
                                    <span><?php echo esc_html__('Est. Total Loan','idealauto'); ?></span>
                                    <span class="list-totals-loan li-right"></span>
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