<!DOCTYPE html>
<html>
	<?php require 'resources/uiConfig.php';?>
	<head>
		<title><?php echo $title; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no" />
		<link rel="stylesheet" href="css\style.css">
		<link rel="stylesheet" href="css\modal.css">
	</head>
	<body>
		
		<div class="oneTenth pageHead"><h2><?php echo $header; ?></h2></div>
		<div class="wrapper ninety" id="container">
			<div class="leftBar full" id="leftBar">
				<div class="titleBorder"style="font-weight: bold;">
					<button id="myBtn">Add person</button>
					<br />
				<?php echo $leftBar; ?></div>
				<br />
				<div id="array_of_people"></div>
			</div>
			<div class="mainBody full" id="body">
				<div class="header">
					<h3 class="titleBorder"><?php echo $viewportTitle; ?></h3>
				</div>
				
				<div id="text">Here's some text, and isn't it interesting?</div>
				<div id="text">Lorem ipsum dolor sit amet. Dulche et decorum est</div>
				<div id="text">Here's some text, and isn't it interesting?</div>
				<div> End Text </div>
			</div>
			<div class="rightBar full" id="leftBar">
				<div class="titleBorder" style="font-weight: bold;"><?php echo $rightBar; ?></div>
				<br />
				<div id="array_of_people"></div>
			</div>
		</div>
		<div id="myModal" class="modal">
			<!-- Modal content -->
			<div class="modal-content">
				<span class="close">&times;</span>
				<div>
					<form onsubmit="resources/submit.php"> <br />
						<table>
							<tr>
								<td>
									<label for="newPerson">Keep in touch with: </label>
								</td><td>
								<input type="text" name="newPerson">
							</td>
						</tr>
						<tr>
							<td>
								<label for="frequency"> how often? Every:</label>
							</td><td>
							<input type="numeric" name="frequency">
							
						</td><td>
						<select>
							<option>Select...</option>
							<option>day</option>
							<option>week</option>
							<option>month</option>
							<option>year</option>
						</select>
					</td>
				</tr>
			</table>
			<br />
			<span>a datepicker, I guess?</span><br />
			<button>submit</button><br />
		</form>
	</div>
</div>
</div>
</body>
</html>
<script type="text/javascript" src="js\helper.js"></script>
<script type="text/javascript" src="js\modal.js"></script>
<script type="text/javascript" src="js\app.js"></script>