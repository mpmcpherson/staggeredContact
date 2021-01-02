
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

function loadPeople()
{ 
  let resultDiv = document.getElementById("array_of_people");
  let data = JSON.stringify({userId : 44});
 
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

//set up event listener on keyup: monitor modal fields to start with
//after the modal validates, toggleHidden(targetDiv)

docReady(function() {

  //loadPeople();
  //loadTodaysPeople
  //loadEvents
  //load events since last contact
  //add person
  //
  /*
    
  */
  
});