<?php
	session_start();

	if($_SESSION['id']!=''){
		header("location: profile.php");
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Neat &mdash; Free Website Template, Free HTML5 Template by freehtml5.co</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by freehtml5.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="freehtml5.co" />

	<!--
	//////////////////////////////////////////////////////

	FREE HTML5 TEMPLATE
	DESIGNED & DEVELOPED by FreeHTML5.co

	Website: 		http://freehtml5.co/
	Email: 			info@freehtml5.co
	Twitter: 		http://twitter.com/fh5co
	Facebook: 		https://www.facebook.com/fh5co

	//////////////////////////////////////////////////////
	 -->

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Oxygen:300,400" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700" rel="stylesheet">

	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Flexslider  -->
	<link rel="stylesheet" href="css/flexslider.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	<!-- jQuery --><script  src="https://code.jquery.com/jquery-3.3.1.js"  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="  crossorigin="anonymous"></script>
	<!-- form CSS --><link rel="stylesheet" type="text/css" href="CSS/form.css">
	<!-- form CSS --><link rel="stylesheet" type="text/css" href="CSS/signin.css">

	<!-- JavaScript -->
	<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/alertify.min.js"></script>

	<!-- CSS -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/alertify.min.css"/>
	<!-- Default theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/default.min.css"/>
	<!-- Semantic UI theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/semantic.min.css"/>
	<!-- Bootstrap theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/bootstrap.min.css"/>

<script>
alertify.minimalDialog || alertify.dialog('minimalDialog',function(){
    return {
        main:function(content){
            this.setContent(content);
        }
    };
});
alertify.minimalDialog("Minimal button-less dialog.");
</script>
<script>
	function isEmail(email) {
	  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  return regex.test(email);
	}

	$(document).ready( function() {
		$('#signup').hide();
	});

	function ShowSignUp(){
		$('#login').hide();
		$('#signup').show();
	}
	function ShowLogin(){
		$('#signup').hide();
		$('#login').show();
	}



	function SignUp(em,pw,conf){
	  $( document ).ready(function() {
		  var Ok=true;

		if(em==''){
			Ok=false;
			$('#S_em').html("<p class='error'>E-mail cím megadása kötelező!</p>");
		}else{
			if (!(isEmail(em))){
				Ok=false;
				$('#S_em').html("<p class='error'>Nem megfelelő E-mail cím!</p>");
			}else{
				$('#S_em').html(" ");
			}
		}

		if(pw==''){
			Ok=false;
			$('#S_pw').html("<p class='error'>Jelszó megadása kötelező!</p>");
		}else{
			$('#S_pw').html(" ");
		}

		if(pw.length>32 || pw.length<6){
			Ok=false;
			$('#S_pw').html("<p class='error'>Nem megfelelő hosszúságú jelszó!</p>");
		}else{
			$('#S_pw').html(" ");
		}

		if(conf==''){
			Ok=false;
			$('#S_conf').html("<p class='error'>Jelszó megerősítése kötelező!</p>");
		}else{
			$('#S_conf').html(" ");
			if(pw!='' && pw!=conf){
				Ok=false;
				$('#S_conf').html("<p class='error'>Jelszavak nem egyeznek!</p>");
			}else{
				$('#S_pw').html(" ");
			}
		}

		var isT=$('#isTrainer').val();
		if(Ok){
			$.ajax({
			url: "ajax.php",
			type: "POST",
			data: { action: "signup", email: em, password: pw, confirm: conf, isTrainer: isT }
			})
			.done(function( result ) {
				if (result=="success") {
					alert("Sikeres regisztráció!");
				}
			});
		}
	  });
	}

		function SignIn(em,pw){
			$( document ).ready(function() {
				var Ok=true;
				if(em==''){
					Ok=false;
					$('#L_em').html("<p class='error'>E-mail cím megadása kötelező!</p>");
				}else{
					if (!(isEmail(em))){
						Ok=false;
						$('#L_em').html("<p class='error'>Nem megfelelő E-mail cím!</p>");
					}else{
						$('#L_em').html(" ");
					}
				}

				if (pw=='') {
					Ok=false;
					$('#L_pw').html("<p class='error'>Adjon meg egy jelszót!</p>");
				}else{
					$('#L_pw').html(" ");
				}



				if(Ok){
					$.ajax({
					url: "ajax.php",
					type: "POST",
					data: { action: "signin", email: em, password: pw }
					})
					.done(function( result ) {
						if (result=="success") {
							alert("Sikeres bejelentkezés!");
							window.location="profile.php";
						}
						if (result=="wrong_login") {
							alert("Sikertelen bejelentkezés!");
						}
					});
				}
			});
		}

		function LogOut(){
		$(document).ready( function(){

			$.ajax({
				url: "ajax.php",
				type: "POST",
				data : { action: "logout" }
			})
			.done(function(result){
				window.location="index.php";
			});
		});
	}
</script>
	</head>
	<body>

	<div class="fh5co-loader"></div>

	<div id="page">
	<nav class="fh5co-nav" role="navigation">
		<div class="container-wrap">
			<div class="top-menu">
				<div class="row">
					<div class="col-xs-2">
						<div id="fh5co-logo"><a href="index.html">PTF</a></div>
					</div>
					<div class="col-xs-10 text-right menu-1">
						<ul>
							<li><a href="index.php">Kezdőlap</a></li>
							<li><a href="work.html">Rólunk</a></li>
							<?php
								if($_SESSION['id']!=""){
									echo "<li><a href='profile.php'>Profil</a></li>";
									echo "<li><a href=''><span onClick='LogOut()'>Kijelentkezés</span></a></li>";
								}else{
									echo "<li><a href='signin.php'>Belépés</a></li>";
								}
							?>
						</ul>
					</div>
				</div>

			</div>
		</div>
	</nav>
	<div class="container-wrap">
		<aside id="fh5co-hero">
			<div class="flexslider">
				<ul class="slides">
			   	<li style="background-image: url(images/img_bg_3.jpg);">
			   		<div class="overlay-gradient"></div>
			   		<div class="container-fluids">
			   			<div class="row">
				   			<div class="col-md-6 col-md-offset-3 slider-text slider-text-bg">
				   				<div class="slider-text-inner text-center">
				   					<div class="wrapper form-signin" id='signup'>
										<h2 class="form-signin-heading">Sign Up</h2>
										<input type="email" class="form-control" id="email" placeholder="Email Address" required="" autofocus="" /><br>
										<span id='S_em'></span>
										<input type="password" class="form-control" id="password" placeholder="Password" required=""/><br>
										<span id='S_pw'></span>
										<input type="password" class="form-control" id="confirm" placeholder="Confirm Password"><br>
										<span id='S_conf'></span>
										<select class="form-control" id="isTrainer">
											<option value='0'>Felhasználó</option>
											<option value='1'>Edző</option>
										</select><br>
										<input class="btn btn-lg btn-primary btn-block" type="submit" onClick="SignUp(document.getElementById('email').value, document.getElementById('password').value, document.getElementById('confirm').value)"/><br>
										<center><button onClick='ShowLogin()'>Bejelentkezés</button></center>
									</div>

									<div class="wrapper form-signin" id='login'>
										<h2 class="form-signin-heading">Please login</h2>
										<input type="email" class="form-control" id="L_email" placeholder="Email Address" autofocus="" /><br>
										<span id='L_em'></span>
										<input type="password" class="form-control" id="L_password" placeholder="Password" /><br>
										<span id='L_pw'></span>
										<label class="checkbox">
										<input type="checkbox" value="remember-me" id="rememberMe"> Remember me
										</label>
										<input class="btn btn-lg btn-primary btn-block" type="submit" onclick="SignIn(document.getElementById('L_email').value, document.getElementById('L_password').value)"/><br>
										<center><button onClick='ShowSignUp()'>Regisztráció</button></center>
									</div>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			  	</ul>
		  	</div>
		</aside>
	</div><!-- END container-wrap -->

	<div class="container-wrap">
		<footer id="fh5co-footer" role="contentinfo">
			<div class="row">
				<div class="col-md-3 fh5co-widget">
					<h4>About Neat</h4>
					<p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
				</div>
				<div class="col-md-3 col-md-push-1">
					<h4>Latest Posts</h4>
					<ul class="fh5co-footer-links">
						<li><a href="#">Amazing Templates</a></li>
						<li><a href="#">100+ Free Download Templates</a></li>
						<li><a href="#">Neat is now available</a></li>
						<li><a href="#">Download 1000+ icons</a></li>
						<li><a href="#">Big Deal for this month of March, Join Us here</a></li>
					</ul>
				</div>

				<div class="col-md-3 col-md-push-1">
					<h4>Links</h4>
					<ul class="fh5co-footer-links">
						<li><a href="#">Home</a></li>
						<li><a href="#">Work</a></li>
						<li><a href="#">Services</a></li>
						<li><a href="#">Blog</a></li>
						<li><a href="#">About us</a></li>
					</ul>
				</div>

				<div class="col-md-3">
					<h4>Contact Information</h4>
					<ul class="fh5co-footer-links">
						<li>198 West 21th Street, <br> Suite 721 New York NY 10016</li>
						<li><a href="tel://1234567920">+ 1235 2355 98</a></li>
						<li><a href="mailto:info@yoursite.com">info@yoursite.com</a></li>
						<li><a href="http://gettemplates.co">gettemplates.co</a></li>
					</ul>
				</div>

			</div>

			<div class="row copyright">
				<div class="col-md-12 text-center">
					<p>
						<small class="block">&copy; 2016 Free HTML5. All Rights Reserved.</small>
						<small class="block">Designed by <a href="http://freehtml5.co/" target="_blank">FreeHTML5.co</a> Demo Images: <a href="http://unsplash.co/" target="_blank">Unsplash</a></small>
					</p>
					<p>
						<ul class="fh5co-social-icons">
							<li><a href="#"><i class="icon-twitter"></i></a></li>
							<li><a href="#"><i class="icon-facebook"></i></a></li>
							<li><a href="#"><i class="icon-linkedin"></i></a></li>
							<li><a href="#"><i class="icon-dribbble"></i></a></li>
						</ul>
					</p>
				</div>
			</div>
		</footer>
	</div><!-- END container-wrap -->
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
	</div>

	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Flexslider -->
	<script src="js/jquery.flexslider-min.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- Counters -->
	<script src="js/jquery.countTo.js"></script>
	<!-- Main -->
	<script src="js/main.js"></script>

	</body>
</html>
