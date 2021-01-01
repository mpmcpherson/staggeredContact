<!DOCTYPE html>
<html>
<?php require 'resources/uiConfig.php';?>
<head>

<title><?php echo $title; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<link rel="stylesheet" href="css\style.css">

</head>

<body>
	

	<div class="oneTenth pageHead"><h2><?php echo $header; ?></h2></div>

	<div class="wrapper ninety" id="container">

		<div class="leftBar ninety" id="leftBar">
			<div style="font-weight: bold;"><?php echo $leftBar; ?></div>
			<br />
			<div id="array_of_people"></div>
		</div>

		<div class="mainBody ninety" id="body">
			<div class="header">
				<h3><?php echo $viewportTitle; ?></h3>
			</div> 
			
			<div id="text">Here's some text, and isn't it interesting?</div>
			<div id="text">Lorem ipsum dolor sit amet. Dulche et decorum est</div>
			<div id="text">Here's some text, and isn't it interesting?</div>
			<div> End Text </div>	
		</div>

	</div>
</body>	
</html>

<script type="text/javascript" src="js\helper.js"></script>
<script type="text/javascript">
	
	docReady(function() {
    
	});

 
	/*
	variable.addEventListener('click', function() {
	
	});
	*/


</script>