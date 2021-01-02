
function appendNnodes(target,data)
{

  for(let i = 0; i<data.length; i++)
  {
    let nameContainer = document.createElement("div");
    nameContainer.id = data[i][3];
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
  function addPerson(first_name, last_name, userId, intervalAmount, intervalTime, intervalType, personId, channelName, channelValue, targetDiv){
    let resultDiv = document.getElementById(targetDiv);
    let values = {
      "first_name" : first_name, 
      "last_name": last_name, 
      "userId" : userId, 
      "intervalAmount" : intervalAmount, 
      "intervalTime" : intervalTime, 
      "intervalType" : intervalType, 
      "personId" : personId, 
      "channelName" : channelName, 
      "channelValue" : channelValue, 
      "targetDiv" : targetDiv
    };
    let data = JSON.stringify(values);
   
    postRequest('resources/addPerson.php', 
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

//set up event listener on keyup: monitor modal fields to start with
//after the modal validates, toggleHidden(targetDiv)

//listener for the add button

docReady(function() {

  loadPeople(44, "array_of_people");
  loadEventsSinceLastContact(44, personId, "array_of_events");

  
});

