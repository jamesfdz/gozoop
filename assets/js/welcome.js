$(document).ready(function(){

	var images = ["assets/images/1/1.png", "assets/images/1/2.png", "assets/images/1/3.png", "assets/images/2/1.png", "assets/images/2/2.png", "assets/images/2/3.png", "assets/images/3/1.png", "assets/images/3/2.png", "assets/images/3/3.png", "assets/images/4/1.png", "assets/images/4/2.png", "assets/images/4/3.png"];
	
	var randomImg_num = 0;
	var rewards = 0;
	var countdown = 30 * 60 * 1000;
	var intervals, countdownInterval;

	$('#spin_now').on("click", function(){
		// debugger;
		//check if 30 mins

		if(parseFloat(sessionStorage.getItem('countdown')) > 0){
			var remainingTime = Math.floor(parseInt(sessionStorage.getItem('countdown')) / 60 / 1000);
			alert("Please wait more for " + remainingTime + "mins");
			countdown = parseFloat(sessionStorage.getItem('countdown'));
			countdownInterval = setInterval(function(){
											countdown -= 1000;
											sessionStorage.setItem('countdown', countdown);
											sessionStorage.removeItem('attempts');
										}, 1000);
			if(countdown <= 0){
					clearInterval(countdownInterval);
					sessionStorage.removeItem('countdown');
				}
		}else{
			var attempts = sessionStorage.getItem('attempts');
			if(attempts == null){
				attempts = 1
				sessionStorage.setItem('attempts', attempts);
			}

			if(attempts > 3){
				debugger;
				alert('Please wait for 30mins');
				countdownInterval = setInterval(function(){
											countdown -= 1000;
											sessionStorage.setItem('countdown', countdown);
											sessionStorage.removeItem('attempts');
										}, 1000);
				

				if(countdown <= 0){
					clearInterval(countdownInterval);
					sessionStorage.removeItem('countdown');
				}
			}else{
				var timeLeft = 20; //seconds

				intervals = setInterval(function(){
									if(timeLeft <= 0){
										checkForRewards();
									}else{
										timeLeft--;
										spinImages();
									}

								}, 100);
				attempts++;
				sessionStorage.setItem('attempts', attempts);
			}
		}


	});

	function spinImages(){

		randomImg_num = Math.floor(Math.random() * 13);
		$('#slot1').attr('src', images[randomImg_num]);
		randomImg_num = Math.floor(Math.random() * 13);
		$('#slot2').attr('src', images[randomImg_num]);
		randomImg_num = Math.floor(Math.random() * 13);
		$('#slot3').attr('src', images[randomImg_num]);
		
	}

	function checkForRewards(){
		window.clearInterval(intervals);
		//check images are same
		var slot1 = $('#slot1').attr('src');
		var slot2 = $('#slot2').attr('src');
		var slot3 = $('#slot3').attr('src');

		if(slot1 == slot2 && slot1 == slot3 || slot2 == slot1 && slot2 == slot3 || slot3 == slot1 && slot3 == slot2) {
			rewards = 500;
			console.log(rewards);
			$('#success').modal('show');
			$('.rewardsContainer').show();
			$('#points').html(rewards);


			$.ajax({
		        type: "POST",
		        url: "database/updateRewards.php?rewards="+rewards,
		        data: {
		        	rewards : parseInt(rewards)
		        },
		        success: function(result){
		        	var json_result = JSON.parse(result);
		        	$('.balance').html(json_result.totalRewards);
		        }
			});
		}else if((1 == 1 || slot1 == slot3) || (slot2 == slot1 || slot2 == slot3) || (slot3 == slot1 || slot3 == slot2)){
			rewards = 200;
			console.log(rewards);
			$('#success').modal('show');
			$('.rewardsContainer').show();
			$('#points').html(rewards);

			$.ajax({
		        type: "POST",
		        url: "database/updateRewards.php?rewards="+rewards,
		        data: {
		        	rewards : parseInt(rewards)
		        },
		        success: function(result){
		        	// debugger;
		        	var json_result = JSON.parse(result);
		        	$('.balance').html(json_result.totalRewards);
		        }
			});
		}else{
			$('#failure').modal('show');
		}
	}

});