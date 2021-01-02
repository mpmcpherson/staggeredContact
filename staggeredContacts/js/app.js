
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

function loadPeople(userId)
{ 
  let resultDiv = document.getElementById("array_of_people");
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

  function loadTodaysPeople(userId){

  }
  function loadAllEvents(){

  }
  function loadEventsSinceLastContact(){

  }
  function addPerson(first_name, last_name, userId, intervalAmount, intervalTime, intervalType, personId, channelName, channelValue){

  }

//set up event listener on keyup: monitor modal fields to start with
//after the modal validates, toggleHidden(targetDiv)

docReady(function() {

  //loadPeople();
  //loadTodaysPeople(){}
  //loadAllEvents(){}
  //loadEventsSinceLastContact(){}
  //addPerson(){}
  //
  /*
    
  */
  
});