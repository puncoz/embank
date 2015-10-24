<?php $this->load->view('header') ?>
<?php $this->load->view('body_top') ?>
<?php $this->load->helper('form') ?>
				
                <?php $this->load->view('acc_nav') ?>
                
                <script type="text/javascript" src="<?php echo site_url("themes/scripts/acc-nav.js") ?>"></script>

				<section id="user-reg" class="splash-content register">
                	<div class="form registration">
                    	<?php echo ($msg) ? '<div id="msg"><a href="#" class="close" onclick="$(\'#msg\').hide();">Close X</a><p>'.$msg.'</p></div>' : '' ?>
                    	<?php echo (isset($custom_error)) ? $custom_error : '';?>
                    	<?php echo validation_errors('<div id="error-msg"><a href="#" class="close" onclick="$(\'#error-msg\').hide();">Close X</a><p>', '</p></div>'); ?>
						<?php echo form_open('index.php/account/deposit') ?>
                            <div class="field" style="margin: 90px 0 0 90px;">
                                <input type="number" id="balance_pin" name="balance_pin" value="<?php echo set_value('balance_pin'); ?>" placeholder="Balance PIN (Format: XXXXXXXXX)" autocomplete="off" required />
                            </div>
                            <div class="btn submit" style="position: relative; top: 30px; left: -90px;">
                                <?php echo form_submit('regUserSubmit_1', 'Recharge'); ?>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </section>
				
<?php $this->load->view('body_bottom') ?>
<?php $this->load->view('footer') ?>