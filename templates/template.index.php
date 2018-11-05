

	<div class="home">
		<header class="main animated bounceIn delay-05s">
					<div class="logo-img"></div>
			</header>
		<section>
		<div class="container">
			<div class="row">
				<div class="col-xl-7">
					<a href="test1">
						<img src="./static/images/auto.jpg" class="img-fluid from-left-mover ">
					</a>
				</div>
				<div class="col-xl-5">
					<a href="test2">
						<img src="./static/images/auto.jpg" class="img-fluid from-right-mover">
					</a>
				</div>
				<div class="col-xl-5">
					<a href="test3">
						<img src="./static/images/auto.jpg" class="img-fluid from-left-mover">
					</a>
				</div>
				<div class="col-xl-7">
					<a href="test4">
						<img src="./static/images/auto.jpg" class="img-fluid from-right-mover">
					</a>
				</div>
			</div>
		</div>
		</section> 
	</div>
	
	<?php 
	//admin login form
		if (isset($_GET["admin"])){
			if (!(isset($_SESSION["login"])) || ($_SESSION["login"] != TRUE)){
				if ($_GET["admin"] == "true"){
					echo "<script>"."\xA";
					echo "$('body').toggleClass('is-active');"."\xA";
					echo "$('.overlay').css('display', 'flex');"."\xA";
					echo '$("#login-form").submit(function(event) {
						var ajaxRequest;
						event.preventDefault();
						var data = $(this).serialize();
						ajaxRequest= $.ajax({
							url: "engine/login.php",
							type: "post",
							data: data
						});
						ajaxRequest.done(function (response){
							if (response == "Bad"){
								$(".error").show();
							}
						else if (response == "Succ"){
							$("#login-form").hide();
							location.reload();
						}
						});
					});';
			echo "</script>";
				}
			}
			
		}
?>

    
    

