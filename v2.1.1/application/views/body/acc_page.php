<?php $this->load->view('header') ?>
<?php $this->load->view('body_top') ?>
				
                <?php $this->load->view('acc_nav') ?>
                
                <script type="text/javascript" src="<?php echo site_url("themes/scripts/acc-nav.js") ?>"></script>

				<section id="user-reg" class="splash-content register">
                	<div class="account-welcome">
                    	<p class="welcome">Welcome <span><?php echo $mobNum ?></span> !!!</p>
                    	<p class="balance">Your Current Balance</p>
                        <p class="balance-amm">Rs. <?php echo $balance ?></p>
                   	</div>
                </section>
				
<?php $this->load->view('body_bottom') ?>
<?php $this->load->view('footer') ?>