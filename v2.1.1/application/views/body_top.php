<body>
    	<section id="layout">
        	<!--<div id="server-warning">
                <a href="#" class="close" onclick="$('#server-warning').hide();">Close X</a>
                <p><strong>Problem in connecting to emBank Server, Please try again later...</strong></p>
            </div>-->
            
            <section class="main-body home">
            	<header>
                	<div class="logo"><a href="<?php echo base_url() ?>" title="emBank | Online Payment Gateway System"></a></div>
                    <div class="tag-line accent-font"><span>Embedded Server based Transaction System</span></div>
                    
                    
                    <!-- Top navigation list -->
                    <nav>
                        <ul>
                            <li <?php echo (($page == 'home') ? 'class="active"' : '') ?>><a href="<?php echo base_url() ?>">home</a></li>
                            <?php if($page == 'login') { ?>
                            	<li <?php echo (($page == 'register') ? 'class="active"' : '') ?>><a href="<?php echo site_url("index.php/users/register") ?>">register</a></li>
                            <?php } else if($loggedIn === true) { ?>
                            	<li <?php echo (($page == 'account_main') ? 'class="active"' : '') ?>><a href="<?php echo site_url("index.php/account") ?>">account</a></li>
                            <?php } else {?>
                            	<li <?php echo (($page == 'login') ? 'class="active"' : '') ?>><a href="<?php echo site_url("index.php/users/login") ?>">login</a></li>
                            <?php } ?>
                            <li <?php echo (($page == 'about') ? 'class="active"' : '') ?>><a href="<?php echo site_url("index.php/home/about") ?>">about</a></li>
                            <li <?php echo (($page == 'contact') ? 'class="active"' : '') ?>><a href="<?php echo site_url("index.php/home/contact") ?>">contact</a></li>
                        </ul>
                    </nav>
                    <div class="clear"></div>
                </header>