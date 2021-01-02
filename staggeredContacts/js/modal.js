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
};
eventSpan.onclick = function(){
	eventModal.style.display = "none";
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	if (event.target === personModal) {
		personModal.style.display = "none";
	}
	if (event.target === eventModal) {
		eventModal.style.display = "none";
	}
};