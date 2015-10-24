				<div class="menu">
                    <div class="item">
                        <a class="link icon_enquiry"></a>
                        <div class="item_content">
                            <h2><strong>Balance:</strong> Rs. <?php echo $balance ?></h2>
                        </div>
                    </div>
                    <div class="item">
                        <a class="link icon_deposit"></a>
                        <div class="item_content">
                            <h2><a href="<?php echo site_url("index.php/account/deposit/") ?>">Deposit Balance</a></h2>
                        </div>
                    </div>
                    <div class="item">
                        <a class="link icon_withdraw"></a>
                        <div class="item_content">
                            <h2><a href="<?php echo site_url("index.php/account/withdraw/") ?>">Withdraw Balance</a></h2>
                        </div>
                    </div>
                    <div class="item">
                        <a class="link icon_logout"></a>
                        <div class="item_content">
                            <h2><a href="<?php echo site_url("index.php/users/logout/") ?>">logout</a></h2>
                        </div>
                    </div>
                    <?php if($user_role == 'admin') { ?>
                    <div class="item">
                        <a class="link icon_control"></a>
                        <div class="item_content">
                            <h2><a href="http://192.168.53.160/?control=1" target="_blank">Control Room</a></h2>
                        </div>
                    </div>
                    <?php } ?>
                </div>