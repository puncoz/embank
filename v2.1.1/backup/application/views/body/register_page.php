<?php $this->load->view('header') ?>
<?php $this->load->view('body_top') ?>
<?php $this->load->helper('form') ?>
				<!-- Brown Splash -->
                <section id="user-reg" class="splash-content register">
                <?php if($step == 1) { ?>
                	<!-- Registration Step 1 Form -->
                	<div class="form registration">
                    	<?php echo (isset($custom_error)) ? $custom_error : '';?>
                    	<?php echo validation_errors('<div id="error-msg"><a href="#" class="close" onclick="$(\'#error-msg\').hide();">Close X</a><p>', '</p></div>'); ?>
						<?php echo form_open('index.php/users/register/1/') ?>
                    		<?php echo form_hidden('regStep', '1') ?>
                            <div class="field" style="margin: 90px 0 0 90px;">
                                <input type="number" id="mobile_no" name="mobile_no" value="<?php echo set_value('mobile_no'); ?>" placeholder="Mobile Number (Format: 98XXXXXXXX)" autocomplete="off" required />
                            </div>
                            <div class="btn submit" style="position: relative; top: 30px; left: -90px;">
                                <?php echo form_submit('regUserSubmit_1', 'Register'); ?>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
              	<?php } else if($step == 2) { ?>
                	<!-- Registration Step 2 Form -->
                    <div class="form registration">
                    	<?php echo (isset($custom_error)) ? $custom_error : '';?>
                    	<?php echo validation_errors('<div id="error-msg"><a href="#" class="close" onclick="$(\'#error-msg\').hide();">Close X</a><p>', '</p></div>'); ?>
                    	<?php echo form_open('index.php/users/register/2/') ?>
                        	<div class="field" style="margin: 90px 0 0 90px;">
                            	<input type="text" id="validCode" name="validCode" value="<?php echo set_value('validCode'); ?>" placeholder="Validation Code (Format: XXXXXX)" autocomplete="off" required />
                          	</div>
                            <div class="btn submit" style="position: relative; top: 30px; left: -90px;">
                            	 <?php echo form_submit('regUserSubmit_2', 'Next'); ?>
                            </div>
                         <?php echo form_close(); ?>
                    </div>
             	<?php } else if($step == 3) { ?>
                	<!-- Registration Step 3 Form -->
                    <div class="form registration">
                    	<?php echo (isset($custom_error)) ? $custom_error : '';?>
                    	<?php echo validation_errors('<div id="error-msg"><a href="#" class="close" onclick="$(\'#error-msg\').hide();">Close X</a><p>', '</p></div>'); ?>
                    	<?php echo form_open('index.php/users/register/3/') ?>
                        	<div class="field" style="margin: 70px 0 0 90px;">
                            	<input type="password" id="password" name="password" value="" placeholder="Password (alpha-numeric)" autocomplete="off" required />
                          	</div>
                        	<div class="field" style="margin: 10px 0 0 90px;">
                            	<input type="password" id="re_password" name="re_password" value="" placeholder="Confirm Password (alpha-numeric)" autocomplete="off" required />
                          	</div>
                            <div class="btn submit" style="position: relative; top: 10px; left: -90px;">
                            	 <?php echo form_submit('regUserSubmit_3', 'Complete Registration'); ?>
                            </div>
                         <?php echo form_close(); ?>
                    </div>
                <?php } ?>
                    <!-- Loading -->
                    <!--<div class="spinner" style="position: relative; top: 90px;">
                        <div class="rect1"></div>
                        <div class="rect2"></div>
                        <div class="rect3"></div>
                        <div class="rect4"></div>
                        <div class="rect5"></div>
                    </div>-->
                    <!-- Registration Step 2 Form -->
                    <!--<div class="form registration">
                    	<form method="post" action="">
                        	<div class="field" style="margin: 90px 0 0 90px;">
                            	<input type="number" id="confrmCode" class="validate[required,custom[onlyLetter],length[3,100]]" name="confrmCode" value="" placeholder="Confirmation Code (Format: XXXXXX)" />
                          	</div>
                            <div class="btn submit" style="position: relative; top: 30px; left: -90px;">
                            	 <input type="submit" name="asd" value="Next" />
                            </div>
                         </form>
                    </div>-->
                    <!-- Registration Step 3 Form -->
                    <!--<div class="form registration">
                    	<form method="post" action="">
                        	<div class="field" style="margin: 70px 0 0 90px;">
                            	<input type="text" id="password" class="validate[required,custom[onlyLetter],length[3,100]]" name="password" value="" placeholder="Password (alpha-numeric)" />
                          	</div>
                        	<div class="field" style="margin: 10px 0 0 90px;">
                            	<input type="text" id="re-password" class="validate[required,custom[onlyLetter],length[3,100]]" name="re-password" value="" placeholder="Confirm Password (alpha-numeric)" />
                          	</div>
                            <div class="btn submit" style="position: relative; top: 10px; left: -90px;">
                            	 <input type="submit" name="asd" value="Next" />
                            </div>
                         </form>
                    </div>-->
                </section>
<?php $this->load->view('body_bottom') ?>
<?php $this->load->view('footer') ?>