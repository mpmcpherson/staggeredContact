
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
function addPerson(first_name, last_name, userId, intervalAmount, intervalType, personId, channelName, channelValue){
  let values = {
    "first_name" : first_name, 
    "last_name": last_name, 
    "userId" : userId, 
    "intervalAmount" : intervalAmount,
    "intervalType" : intervalType, 
    "personId" : personId, 
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
//set up event listener on keyup: monitor modal fields to start with
//after the modal validates, toggleHidden(targetDiv)

//listener for the add button

docReady(function() {
  let uid = 44;

  keypressListener();

  loadPeople(uid, "array_of_people");

  let peopleList = document.getElementById("array_of_people").children;

  for(let listIndex = 0; listIndex < peopleList.length; listIndex++){
    peopleList[listIndex].addEventListener("click", function(pId){
      loadEventsSinceLastContact(uid, peopleList[pId].id, "array_of_events");
    })(listIndex);
  
  }
  

  
});