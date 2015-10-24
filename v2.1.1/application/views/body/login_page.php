<?php $this->load->view('header') ?>
<?php $this->load->view('body_top') ?>
<?php $this->load->helper('form') ?>
				<!-- Brown Splash -->
                <section id="user-reg" class="splash-content register">
                	<!-- Login Form -->
                    <div class="form registration">
                    	<?php echo (isset($custom_error)) ? $custom_error : '';?>
                    	<?php echo validation_errors('<div id="error-msg"><a href="#" class="close" onclick="$(\'#error-msg\').hide();">Close X</a><p>', '</p></div>'); ?>
                    	<?php echo form_open('index.php/users/login/') ?>
                        	<div class="field" style="margin: 70px 0 0 90px;">
                            	<input type="number" id="mob_num" name="mob_num" value="<?php echo set_value('mobile_no'); ?>" placeholder="Mobile Number (Format: 98XXXXXXXX)" autocomplete="off" required />
                          	</div>
                        	<div class="field" style="margin: 10px 0 0 90px;">
                            	<input type="password" id="passwd" name="passwd" value="" placeholder="Password (alpha-numeric)" autocomplete="off" required />
                          	</div>
                            <div class="btn submit" style="position: relative; top: 10px; left: -90px;">
                            	 <?php echo form_submit('loginSubmit', 'Login'); ?>
                            </div>
                         <?php echo form_close(); ?>
                    </div>
                </section>
<?php $this->load->view('body_bottom') ?>
<?php $this->load->view('footer') ?>