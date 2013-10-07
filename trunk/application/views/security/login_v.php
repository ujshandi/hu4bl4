<DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Dirjen Hubla  - Login</title>

    <style type="text/css">
		html {
			background-image: none;
		}
/* 
		#versionBar {
			background-color:#000;
			position:fixed;
			width:100%;
			height:35px;
			bottom:0;
			left:0;
			text-align:center;
			line-height:35px;
			z-index:11;
			
	
		} */

		.copyright{
			text-align:center; font-size:10px; color:#444ea8;
		}
		.copyright a{
			color:#444ea8;
			text-decoration:none;
		}
	</style>

    <!-- JQuery UI CSS Framework -->
    
    <!-- End JQuery UI CSS Framework -->
	
    <!-- General Styles common for all pages -->

    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/admin/css/default.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/admin/css/button.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/admin/css/login.css" />
    <!-- END General Styles -->
	
	<script type="text/javascript">var  base_url = "<?php echo base_url(); ?>"</script>
	<script>
	function runScript(e) {
		if (e.keyCode == 13) {
			document.getElementById('formLogin').submit();
		}
	}
	</script>
</head>

<body style="/* border:1px solid #ff0000; */">
<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bgWow">
<tr>
<td>
	<div class="bgWow">
    <div id="login">
		<div class="ribbon">
			<div class="inner">
				<div class="logo">
				<div class="bgLogo"></div>
            	<!--<image src="logo_login.png" alt="logo_login.png"/>-->
					<div class="captTit" align="center">
						<font color="#444ea8">Sistem dan Aplikasi Pengukuran Data Kinerja</font><br/>
						<font color="#444ea8">Direktorat Jenderal Perhubungan Laut</font>
					</div>
				</div>
				<div class="formLogin">
					<form id="formLogin" method="post" action="<?=base_url();?>security/login/login_usr">					
						<div class="titLogDiv"><div class="titLog">Username</div><input name="username" type="text"  id="username_id" title="Username"/></div>
				 		<div class="titLogDiv"><div class="titLog">Password</div><input name="password" type="password" id="password" title="Password" onkeypress="runScript(event)"/></div>
						<div class="loginButton">
							<div id="alertMessage" class="error"><?=$err_msg;?></div>
							<div style="float:right; padding:3px 0; margin-right:-12px;">
								<div>
									<ul class="uibutton-group">
										<li>
											<a class="uibutton normal" href="javascript:document.getElementById('formLogin').submit();" id="but_login">
												Login
											</a>
										</li>				   
									</ul>
								</div>
							</div>
							<div class="clear"></div>
						</div>
					</form>
				</div> 	        
			</div>
			<div class="clear"/>
				<div class="shadow"/> </div>
					
				<!--Login div-->
				<div class="clear"></div>
				<div id="footer">
					<div class="copyright" > Copyright 2013  All Rights Reserved 
						<span class="tip">
							<a href="#" style="color:#A31F1A" title="DirjenHubla">Direktorat Jenderal Perhubungan Laut</a>
						</span>
					</div>
				<!-- // copyright-->
				</div>
			</div>
		</div>
	</div>
	</div>
</td>
</tr>
</table>
</body>

</html>
