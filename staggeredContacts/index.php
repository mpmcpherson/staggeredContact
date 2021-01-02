<!DOCTYPE html>
<html>
	<?php require 'resources/uiConfig.php';?>
	<head>
		<title><?php echo $title; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no" />
		<link rel="stylesheet" href="css\style.css">
		<link rel="stylesheet" href="css\modal.css">
	</head>
	<body onresize="fixHeight()">
		
		<div class="oneTenth pageHead titleBorder"><h2><?php echo $header; ?></h2></div>
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
				<div id="array_of_events"></div>
			</div>
		</div>
		<div id="myModal" class="modal">
			<!-- Modal content -->
			<div class="modal-content">
				<span class="close">&times;</span>
				<div>
					<h3 style="text-align: center;" class="topAndBottomBorder">Add person...</h3>
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
								<label for="frequency" style="display: inline;"> how often? Every:</label>
							</td><td>
							<input type="number" name="frequency" style="display: inline;">
							<select>
								<option>Select...</option>
								<option value="1">days</option>
								<option value="2">weeks</option>
								<option value="3">months</option>
								<option value="4">years</option>
							</select>
						</td>
					</tr>
				</table>
				<br/>
				<div style="text-align: center;" class="topAndBottomBorder"><label>let's put down their email. You can add other channels later if you want</label></div>
				<br/>
				<input type="email" name="personEmail" placeholder="email...">
				<button id="add_person_submission" type="submit" style="float: right;" disabled="true">add...</button><br />
			</form>
		</div>
	</div>
</div>
</body>
</html>
<script type="text/javascript">
	function fixHeight(){

	}
</script>
<script type="text/javascript" src="js\helper.js"></script>
<script type="text/javascript" src="js\modal.js"></script>
<script type="text/javascript" src="js\app.js"></script>