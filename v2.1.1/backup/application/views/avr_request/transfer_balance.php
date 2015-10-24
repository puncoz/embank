<?php $this->load->view('header') ?>
<?php $this->load->view('body_top') ?>

				<?php $this->load->view('acc_nav') ?>
                <script type="text/javascript" src="<?php echo site_url("themes/scripts/acc-nav.js") ?>"></script>
                
				<!-- Brown Splash -->
                <section id="user-reg" class="splash-content register">
                    <!-- Loading -->
                    <div class="spinner" style="position: relative; top: 90px;">
                        <div class="rect1"></div>
                        <div class="rect2"></div>
                        <div class="rect3"></div>
                        <div class="rect4"></div>
                        <div class="rect5"></div>
                    </div>
                    <div id="emBankResponse"/>
                </section>
                 <script type="text/javascript">
					if (window.XMLHttpRequest) {
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp = new XMLHttpRequest();
					} else {
						// code for IE6, IE5
						xmlhttp = new ActiveObject("Microsoft.XMLHTTP");
					}
		
					xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							document.getElementById("emBankResponse").innerHTML = xmlhttp.responseText;
							window.location="<?php echo site_url("index.php/account/withdraw/2/") ?>";
						}
					}
		
					xmlhttp.open("GET","http://192.168.53.160/?bal_trf=1&receiver=<?php echo $receiver; ?>&ammount=<?php echo $ammount; ?>",true);
					xmlhttp.send();
				</script>
<?php $this->load->view('body_bottom') ?>
<?php $this->load->view('footer') ?>