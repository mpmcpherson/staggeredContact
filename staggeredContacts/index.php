
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
		
		<div class="oneTenth pageHead">
			
			<h2 class="headerText"><?php echo $header; ?></h2>


			<div id = "headerRightFloat" class="logOutButton">
			
			<div id="logOut" class="button" >logout</div>
			
			
			</div>
		
		</div>

		<div class="wrapper ninety" id="container">

			<div class="leftBar full" id="leftBar">
				<div class="titleBorder">
					<button id="addPerson" class="staggeredButtons">Add person</button>
					<br />
				<?php echo $leftBar; ?></div>
				<br />
				<div id="array_of_people"></div>
				<div id="array_of_people_today"></div>
			</div>
			
			<div id="body" class="mainBody full">
				<div id="headerHolder"> 
					<table class="mainBodyHeaderTable"> <tr>
						<td><div id="showHidePeople" class="button">show/hide people</div></td>
						<td><h3 class=""><?php echo $viewportTitle; ?></h3></td>
						<td><div id="showHideEvents" class="button">show/hide events</div></td>
					</tr>
					<tr>
						<td class="loadEventsTD"><div id="loadEventsHere" class="button">Load All Events</div></td>
					</tr>
				</table>
				</div>
				<div id="dueToday"></div>
				<textarea id="mainTextArea"></textarea>
				<a href="mailto:" id="sendIt"><button id="sendButton" class="staggeredButtons">>send it!<</button></a>
				<div id="settings" class="button logOutButton">settings</div>
			</div>
			
			<div class="rightBar full" id="rightBar">
				<button id="addEvent" class="staggeredButtons">Add Event</button>
				<button id="addChecked" class="staggeredButtons blueButtons">Add Checked Events</button>
				<div class="titleBorder" ><?php echo $rightBar; ?></div>
				<br />
				<div id="array_of_events"></div>
			</div>
		</div>

		<div id="addPersonModal" class="modal">
			<!-- Modal content -->
			<div class="modal-content">
				<span class="close">&times;</span>
				<div>
					<h3 class="topAndBottomBorder">Add person...</h3>
					<div> <br />
						<table>
							<tr>
								<td>
									<label for="newPerson">Keep in touch with: </label>
								</td><td>
								<input id="newPerson" type="text" name="newPerson">
							</td>
						</tr>
						<tr>
							<td>
								<label for="frequency" class="addPersonModalFreq"> how often? Every:</label>
							</td><td>
							<input id="freqNum" type="number" name="frequency" class="addPersonModalFreq">
							<select id="freqSelect">
								<option value="0">Select...</option>
								<option value="1">days</option>
								<option value="2">weeks</option>
								<option value="3">months</option>
								<option value="4">years</option>
							</select>
						</td>
					</tr>
				</table>
				<br/>
				<div class="topAndBottomBorder"><label>let's put down their email. You can add other channels later if you want</label></div>
				<br/>
				<input id="emailId" type="email" name="personEmail" placeholder="email...">
				<button id="add_person_submission" type="submit" >add...</button><br />
			</div>
				</div>
			</div>
		</div>
		<div id="addEventModal" class="modal">
			<!-- Modal content -->
			<div class="modal-content">
				<span class="close">&times;</span>
				<div id="addEventElementsContainer">
					<h3 class="topAndBottomBorder">Add event...</h3>
					<div>
						<div class="addEventSubContainer1">
							<input id="eventSubject" placeholder="short version: five words or less that you'll remember" />

							<textarea id="eventText" placeholder="a slightly longer version of the event ~400 characters or less"></textarea>
							
							<div id="charCountHolder">
								<div id="charCount">0</div>
								<div>/400</div>
							</div>

							<button id="add_event_submission" type="submit">add...</button>

							<button style="visibility: hidden;" disabled="true">add...</button>

							<br />

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="wrapper ninety modal" id="login_signup" style="display: none;">
			<div class="modal-content">
				<div class="addElementsContainer">
					<h3 class="topAndBottomBorder">Log In or Sign Up...</h3>
					<div>
						<div class="loginBoxHolder">
							<input id="username" class="login_uname" type="text" placeholder="email address"/>

							<input id="userPass" class="login_pw" type="password" placeholder="password..."/>
							
							<button id="login_btn" class="loginBtnClass" type="submit">log in...</button>

							<button id="signup_btn" class="signUpBtnClass" style=>sign up...</button>

							<br />

							<!--
								<form action="?" method="POST">
								      <div class="g-recaptcha" data-sitekey="your_site_key"></div>
								      <br/>
								      <input type="submit" value="Submit">
							    </form>
							-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<script type="text/javascript">
	function fixHeight(){
	}
</script>
<!--<script type="text/javascript" src="js\helper.js"></script>-->

<script src="js\app.js" type="module"></script>
