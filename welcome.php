<?php
	session_start();

	if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
		header('location: index.php');
		exit;
	}else{
		$loggedin_user = $_SESSION['loggedin_user'];
	}

	include ("database/config.php");

	// $sql = "SELECT rewards FROM users WHERE username = '$loggedin_user'";
	// $data = mysqli_query($link, $sql);

	// $result = mysqli_fetch_assoc($data);

	// $_SESSION['rewards'] = $result['rewards'];

?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome | Gozoop</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/welcome.css">

	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/welcome.js"></script>
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-light">
	  <a class="navbar-brand" href="#"><img src="assets/images/logo.png"></a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	      
	    </ul>
	    <form class="form-inline my-2 my-lg-0">
	      <p class="welcomeTxt">Welcome <?php echo $loggedin_user ?></p>
	      <a class="btn btn-outline-success my-2 my-sm-0" href="logout.php">Logout</a>
	    </form>
	  </div>
	</nav>

	<div class="container-fluid">
		<div class="row primaryBgColor primaryFontColor">
			<div class="col text-center">
				<h1>SPIN TO WIN</h1>
			</div>
		</div>
		<div class="row primaryBgColor">
			<div class="col">
				<div class="row slotsBg">
					<div class="col slotsCol">
						<img src="assets/images/1/1.png" id="slot1" class="slotImgs">
					
						<img src="assets/images/1/2.png" id="slot2" class="slotImgs">
					
					
						<img src="assets/images/1/3.png" id="slot3" class="slotImgs">
					
					</div>
				</div>
			</div>
		</div>
		<div class="row primaryBgColor">
			<div class="col">
				<div class="row btnBg">
					<div class="col d-flex justify-content-center">
						<button class="btn spinnow_btn" id="spin_now">SPIN NOW</button>	
					</div>
					
				</div>
			</div>
		</div>
		<div class="row primaryBgColor rewardsContainer">
			<div class="col d-flex justify-content-center">
				<div class="row rewardsBg">
					<div class="col">
						<div class="row">
							<p class="success-info">USE POINTS TO REDEEM FOLLOWING PRODUCTS:</p>
						</div>
						<div class="row">
							<div class="col-4 text-center">
								<div class="row">
									<div class="col slotCol">
										<img src="assets/images/1/1.png">
										<p>Points required: 100</p>
										<button class="btn redeemBtn">REDEEM</button>
									</div>
								</div>
							</div>
							<div class="col-4 text-center">
								<div class="row">
									<div class="col slotCol">
										<img src="assets/images/1/2.png">
										<p>Points required: 100</p>
										<button class="btn redeemBtn">REDEEM</button>
									</div>
								</div>
							</div>
							<div class="col-4 text-center">
								<div class="row">
									<div class="col slotCol">
										<img src="assets/images/1/3.png">
										<p>Points required: 100</p>
										<button class="btn redeemBtn">REDEEM</button>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-4">
								<p class="balanceTxt">Hint: Redeem done, Now balance: <span class="balance"></span></p>
							</div>
							<div class="col-4">
								<p class="balanceTxt">Hint: Redeem done, Now balance: <span class="balance"></span></p>
							</div>
							<div class="col-4">
								<p class="balanceTxt">Hint: Redeem done, Now balance: <span class="balance"></span></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<!-- Modal -->
	<div id="success" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content text-center">
	      <div class="modal-body">
	        <h1>Congratulations!</h1>
	        <p class="congo">You get <span id="points"></span> points.</p>
	        <p class="congo mb-3">Use this to redeem below products.</p>
	        <button class="btn okBtn" data-dismiss="modal">OK</button>
	      </div>
	    </div>

	  </div>
	</div>

	<div id="failure" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content text-center">
	      <div class="modal-body">
	        <h1>THAT WAS <br> A GREAT SPIN!</h1>
	        <p class="congo">One more try might make <br> you lucky.</p>
	        <p class="congo mb-3">To earn more spins click below</p>
	        <button class="btn okBtn" data-dismiss="modal">Spin Now</button>
	      </div>
	    </div>

	  </div>
	</div>

</html>