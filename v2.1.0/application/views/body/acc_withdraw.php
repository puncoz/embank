<?php $this->load->view('header') ?>
<?php $this->load->view('body_top') ?>
<?php $this->load->helper('form') ?>
				
                <?php $this->load->view('acc_nav') ?>
                
                <script type="text/javascript" src="<?php echo site_url("themes/scripts/acc-nav.js") ?>"></script>

				<section id="user-reg" class="splash-content register">
                	<div class="bal-nav">
                    	<a class="button<?php echo ($option == 'acc') ? ' active' : '' ?>" href="<?php echo site_url("index.php/account/withdraw/1/") ?>">To account</a>
                        <a class="button<?php echo ($option == 'num') ? ' active' : '' ?>" href="<?php echo site_url("index.php/account/withdraw/2/") ?>" style="margin-left: 10px;">To number</a>
                    </div>
                	<div class="form bal-trf-form">
                    	<?php echo ($msg) ? '<div id="msg"><a href="#" class="close" onclick="$(\'#msg\').hide();">Close X</a><p>'.$msg.'</p></div>' : '' ?>
                    	<?php echo (isset($custom_error)) ? $custom_error : '';?>
                    	<?php echo validation_errors('<div id="error-msg"><a href="#" class="close" onclick="$(\'#error-msg\').hide();">Close X</a><p>', '</p></div>'); ?>
                        <?php if($option == 'acc') { ?>
							<?php echo form_open('index.php/account/withdraw/1/') ?>
                                <div class="field" style="">
                                    <input type="number" id="acc_num" name="acc_num" value="<?php echo set_value('acc_num'); ?>" placeholder="Account no. (Format: 98XXXXXXXX)" autocomplete="off" required />
                                    <select name="amount">
                                        <option value="10" <?php echo set_select('amount', '10', TRUE); ?>>Rs. 10</option>
                                        <option value="20" <?php echo set_select('amount', '20'); ?>>Rs. 20</option>
                                        <option value="50" <?php echo set_select('amount', '50'); ?>>Rs. 50</option>
                                        <option value="100" <?php echo set_select('amount', '100'); ?>>Rs. 100</option>
                                        <option value="200" <?php echo set_select('amount', '200'); ?>>Rs. 200</option>
                                        <option value="500" <?php echo set_select('amount', '500'); ?>>Rs. 500</option>
                                        <option value="1000" <?php echo set_select('amount', '1000'); ?>>Rs. 1000</option>
                                    </select>
                                </div>
                                <div class="btn submit" style="position: absolute; top: 80px; left: -170px;">
                                    <?php echo form_submit('regUserSubmit_1', 'Transfer'); ?>
                                </div>
                            <?php echo form_close(); ?>
                        <?php } else if($option == 'num') { ?>
                        	<?php echo form_open('index.php/account/withdraw/2/') ?>
                                <div class="field" style="">
                                    <input type="number" id="mob_num" name="mob_num" value="<?php echo set_value('mob_num'); ?>" placeholder="Mob. no. (Format: 98XXXXXXXX)" autocomplete="off" required />
                                    <select name="amount">
                                        <option value="10" <?php echo set_select('amount', '10', TRUE); ?>>Rs. 10</option>
                                        <option value="20" <?php echo set_select('amount', '20'); ?>>Rs. 20</option>
                                        <option value="50" <?php echo set_select('amount', '50'); ?>>Rs. 50</option>
                                        <option value="100" <?php echo set_select('amount', '100'); ?>>Rs. 100</option>
                                        <option value="200" <?php echo set_select('amount', '200'); ?>>Rs. 200</option>
                                        <option value="500" <?php echo set_select('amount', '500'); ?>>Rs. 500</option>
                                        <option value="1000" <?php echo set_select('amount', '1000'); ?>>Rs. 1000</option>
                                    </select>
                                </div>
                                <div class="btn submit" style="position: absolute; top: 80px; left: -170px;">
                                    <?php echo form_submit('regUserSubmit_1', 'Transfer'); ?>
                                </div>
                            <?php echo form_close(); ?>
                        <?php } ?>
                    </div>
                </section>
				
<?php $this->load->view('body_bottom') ?>
<?php $this->load->view('footer') ?>