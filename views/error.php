<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>404</title>

		<link rel="stylesheet" href="public/css/error/style.css" type="text/css" />
		<link href='public/fonts/error_font.css' rel='stylesheet' type='text/css' />
		
		<script type="text/javascript" src="public/js/error/jquery.js"></script>
		<script type="text/javascript" src="public/js/error/introtzikas.js"></script>
		<script type="text/javascript" src="public/js/error/script.js"></script>
		<script type="text/javascript">
			//<![CDATA[
				$(document).ready(function() {
					$().introtzikas({
							line: 'white', 
							speedwidth: 2000, 
							speedheight: 1000, 
							bg: '#474747',
							lineheight: 2
					});	
				});
			//]]>
		</script>
</head>

<body>

	<img src="public/img/error/bg.jpg" id="bg" alt="" /><!-- Background image -->
	<div class="bg_overlay"></div><!-- Pattern -->
	
		<div id="wrap">
			<div id="block">
				<div id="content">
					<div class="top_img">
						<div class="img_eror"></div>
					</div>
<!-- 					<div class="srch">
						<div class="search">
							<form method="get" id="s-form" action="#" class="s-form"> 
								<fieldset> 
										 <input type="text" class="s_text" name="s" id="s" value="Enter a keyword..." onfocus="this.value=(this.value=='Enter a keyword...') ? '' : this.value;" onblur="this.value=(this.value=='') ? 'Enter a keyword...' : this.value;" /> 
										 <input type="submit" class="s_button" value="Search" id="searchsubmit" /> 
								</fieldset> 
							</form>
						</div>
					</div> -->
					<div class="text_eror">
						<h1>"Ooops! Halaman tidak ditemukan..."</h1>
						<p>Enter a keyword(s) in the search field above, maybe you'll find the page you're looking for. <br />
						  Anda juga bisa kembali ke <a href="<?php echo SITE_ROOT;?>">HOME</a>.</p>
					</div>
					
					
				</div>
			</div>
		</div>

</body>
</html>