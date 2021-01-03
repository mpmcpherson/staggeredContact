// Get the modal
var personModal = document.getElementById("addPersonModal");
var eventModal = document.getElementById("addEventModal");
let addPersonSubmission = document.getElementById("add_person_submission");

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
  let newPerson = document.getElementById("newPerson");
  let email = document.getElementById("emailId");
  let freqAmt = document.getElementById("freqNum");
  let freqSelect = document.getElementById("freqSelect");

  newPerson.value="";
  email.value="";
  freqAmt.value="";
  freqSelect.value=0;

  personModal.style.display = "none";
};
eventSpan.onclick = function(){
  let textArea = document.getElementById("eventText");
  let eventSubject = document.getElementById("eventSubject");
  let charCount = document.getElementById("charCount");
  textArea.value = "";
  eventSubject.innerHTML = "";
  charCount.innerHTML = "0";

  eventModal.style.display = "none";
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target === personModal) {
    personAddHandler();
  }
  if (event.target === eventModal) {
   eventAddHandler();
  }
  if(event.target===addPersonSubmission){
    addPersonActual();
  }
};
function personAddHandler(){
    let newPerson = document.getElementById("newPerson");
    let email = document.getElementById("emailId");
    let freqAmt = document.getElementById("freqNum");
    let freqSelect = document.getElementById("freqSelect");

    newPerson.value="";
    email.value="";
    freqAmt.value="";
    freqSelect.value=0;

    personModal.style.display = "none";
}
function eventAddHandler(){
    let textArea = document.getElementById("eventText");
    let eventSubject = document.getElementById("eventSubject");
    let charCount = document.getElementById("charCount");
    textArea.value = "";
    eventSubject.innerHTML = "";
    charCount.innerHTML = "0";

    eventModal.style.display = "none";
}
function addPersonActual(){
    let ary = document.getElementById("newPerson").value.split(" ");
    let count = document.getElementById("newPerson").value.length;

    let firstName = ary[0];
    let lastName = document.getElementById("newPerson").value.substring(firstName.length+1,count);
    let userId = 44;
    let intervalAmount = document.getElementById("freqNum").value;
    let intervalType = document.getElementById("freqSelect").value;
    let channelName = "email"; 
    let channelValue = document.getElementById("emailId").value;


    addPerson(firstName,lastName,userId,intervalAmount,intervalType,channelName,channelValue);
}
function appendNnodes(target,data)
{

  for(let i = 0; i<data.length; i++)
  {
    let nameContainer = document.createElement("div");
    nameContainer.id = data[i][0];
    let nameTextNode = document.createTextNode(data[i][1]+" "+data[i][2]);
    nameContainer.appendChild(nameTextNode);
    target.appendChild(nameContainer);
  }

}

function loadPeople(userId, targetDiv)
{ 
  let resultDiv = document.getElementById(targetDiv);
  userId = {"userId" : userId};
  let data = JSON.stringify(userId);
 
  postRequest('resources/loadPeople.php', 
    function(response){
      console.log(response);
      let d = "";
      try{
        d = JSON.parse(response);
        appendNnodes(resultDiv, d);
      }catch(error){
        console.log(error);
      }
  },
    function(response){
      console.log(response);
      resultDiv.innerHTML = 'An error occurred during your request: ' +  response.status + ' ' + response.statusText;
  },
  data);

}

function loadTodaysPeople(userId, targetDiv){
  let resultDiv = document.getElementById(targetDiv);
  userId = {"userId" : userId};
  let data = JSON.stringify(userId);

  postRequest('resources/loadTodaysPeople.php', 
    function(response){
      console.log(response);
      let d = "";
      try{
        d = JSON.parse(response);
        appendNnodes(resultDiv, d);
      }catch(error){
        console.log(error);
      }
  },
    function(response){
      console.log(response);
      resultDiv.innerHTML = 'An error occurred during your request: ' +  response.status + ' ' + response.statusText;
  },
  data);

}
function loadAllEvents(userId, targetDiv){
  let resultDiv = document.getElementById(targetDiv);
  userId = {"userId" : userId};
  let data = JSON.stringify(userId);

  postRequest('resources/loadAllEvents.php', 
    function(response){
      console.log(response);
      let d = "";
      try{
        d = JSON.parse(response);
        appendNnodes(resultDiv, d);
      }catch(error){
        console.log(error);
      }
  },
    function(response){
      console.log(response);
      resultDiv.innerHTML = 'An error occurred during your request: ' +  response.status + ' ' + response.statusText;
  },
  data);

}
function loadEventsSinceLastContact(userId, personId, targetDiv){
  let resultDiv = document.getElementById(targetDiv);
  userId = {"userId" : userId};
  let data = JSON.stringify(userId);
 
  postRequest('resources/loadEventsSinceLastContact.php', 
    function(response){
      console.log(response);
      let d = "";
      try{
        d = JSON.parse(response);
        appendNnodes(resultDiv, d);
      }catch(error){
        console.log(error);
      }
  },
    function(response){
      console.log(response);
      resultDiv.innerHTML = 'An error occurred during your request: ' +  response.status + ' ' + response.statusText;
  },
  data);

}
function addPerson(first_name, last_name, userId, intervalAmount, intervalType, channelName, channelValue){
  let values = {
    "first_name" : first_name, 
    "last_name": last_name, 
    "userId" : userId, 
    "intervalAmount" : intervalAmount,
    "intervalType" : intervalType, 
    "channelName" : channelName, 
    "channelValue" : channelValue
  };
  let data = JSON.stringify(values);
 
  postRequest('resources/addPerson.php', 
    function(response){
      console.log(response);
      let d = "";
      try{
        d = JSON.parse(response);
        alert(d);
      }catch(error){
        console.log(error);
      }
  },
    function(response){
      console.log(response);
      //resultDiv.innerHTML = 'An error occurred during your request: ' +  response.status + ' ' + response.statusText;
  },
  data);
}

function keypressListener(){
  let textArea = document.getElementById("eventText");
  let eventCount = document.getElementById("charCount");
  
  textArea.addEventListener("keypress",function(){
    if(textArea.value.length+1>400){
      textArea.value = textArea.value.substring(0, 400);
    }
    eventCount.innerHTML = textArea.value.length+1;
  });

}

function clickListener(){
  let addPersonSubmission = document.getElementById("add_person_submission");
  
  window.onclick = function(event){
    if(event.target===addPersonSubmission){
      
      let ary = document.getElementById("newPerson").value.split(" ");
      let count = document.getElementById("newPerson").value.length;

      let firstName = ary[0];
      let lastName = document.getElementById("newPerson").value.substring(firstName.length+1,count);
      let userId = 44;
      let intervalAmount = document.getElementById("freqNum").value;
      let intervalType = document.getElementById("freqSelect").value;
      let channelName = "email"; 
      let channelValue = document.getElementById("emailId").value;
      

      addPerson(firstName,lastName,userId,intervalAmount,intervalType,channelName,channelValue);
    }
  };
  
}

docReady(function() {
  let uid = 44;

  //clickListener();
  keypressListener();

  loadPeople(uid, "array_of_people");

  let peopleList = document.getElementById("array_of_people").children;

  for(let listIndex = 0; listIndex < peopleList.length; listIndex++){
    peopleList[listIndex].addEventListener("click", function(pId){
      loadEventsSinceLastContact(uid, peopleList[pId].id, "array_of_events");
    })(listIndex);
  
  }
  

  
});