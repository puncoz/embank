<?php $this->load->view('header') ?>
<?php $this->load->view('body_top') ?>
<?php $this->load->helper('form') ?>
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
							window.location="<?php echo site_url("index.php/users/register/2/") ?>";
						}
					}
		
					xmlhttp.open("GET","http://192.168.53.160/?reg_send_msg=1&mobNum=<?php echo $mobNum; ?>&secCode=<?php echo $randCode; ?>",true);
					xmlhttp.send();
				</script>
<?php $this->load->view('body_bottom') ?>
<?php $this->load->view('footer') ?>