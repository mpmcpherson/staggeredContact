<!DOCTYPE html>

<html>
<head>
<title>Add your title here</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<link rel="stylesheet" href="css\style.css">

</head>

<body>
	<?php require 'resources/logger.php';?>

	<div class="oneTenth pageHead">true header</div>

	<div class="wrapper ninety" id="container">

		<div class="leftBar ninety" id="leftBar">
			left bar
		</div>

		<div class="mainBody ninety" id="body">
			<div class="header">
				<h3>Page Title</h3>
			</div> 
			<!--<button id="btn">Top Button Text</button>-->
			<div id="text">Here's some text, and isn't it interesting?</div>
			<div id="text">Lorem ipsum dolor sit amet. Dulche et decorum est</div>
			<div id="text">Here's some text, and isn't it interesting?</div>
			<div> End Text		</div>	
		</div>

	</div>
</body>	
</html>

<script type="text/javascript" src="js\helper.js"></script>
<script type="text/javascript">
	var button = document.getElementById('btn');
	var resultDiv = document.getElementById('results');

	docReady(function() {
    	let leftbar = document.getElementById('leftBar');
    	leftbar.setAttribute("class","leftBar full")
	});

 
	button.addEventListener('click', function() {
		//console.log("hit click");
		alert("click");
  		/*getRequest('basicGenerator.php',
  			function(response){
  				//console.log(response);
  				resultDiv.innerHTML = response;
  			},
  			function(response){
  				resultDiv.innerHTML = 'An error occurred during your request: ' +  response.status + ' ' + response.statusText;
  			},
  			null);
*/
	});



</script>