// Get the modal
var personModal = document.getElementById("addPersonModal");
var eventModal = document.getElementById("addEventModal");

// Get the button that opens the modal
var btn = document.getElementById("addPerson");
var eventBtn = document.getElementById("addEvent");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
var eventSpan = document.getElementsByClassName("close")[1];

// When the user clicks on the button, open the modal
btn.onclick = function() {
	personModal.style.display = "block";
};
eventBtn.onclick = function(){
	eventModal.style.display = "block";
};
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
	personModal.style.display = "none";
	let newPerson = document.getElementById("newPerson");
	let email = document.getElementById("emailId");
	let freqAmt = document.getElementById("freqNum");
	let freqSelect = document.getElementById("freqSelect");

	newPerson.value="";
	email.value="";
	freqAmt.value="";
	freqSelect.value=0;
};
eventSpan.onclick = function(){
	eventModal.style.display = "none";
	let textArea = document.getElementById("eventText");
	let eventSubject = document.getElementById("eventSubject");
	let charCount = document.getElementById("charCount");
	textArea.value = "";
	eventSubject.value = "";
	charCount.value = 0;
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	if (event.target === personModal) {
		personModal.style.display = "none";
		let newPerson = document.getElementById("newPerson");
		let email = document.getElementById("emailId");
		let freqAmt = document.getElementById("freqNum");
		let freqSelect = document.getElementById("freqSelect");

		newPerson.value="";
		email.value="";
		freqAmt.value="";
		freqSelect.value=0;
	}
	if (event.target === eventModal) {
		eventModal.style.display = "none";
		let textArea = document.getElementById("eventText");
		let eventSubject = document.getElementById("eventSubject");
		textArea.value = "0";
		eventSubject.value = "";
	}
};