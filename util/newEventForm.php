<?php
function getNewEventForm($btn="Create Event", $data=array()){
  echo"
<div id='addEventForm'>
                <div class='form-group'>
                  <label for='title'>Title</label>
                  <input type='text' class='form-control' id='title'";

                  if(array_key_exists('title',$data))
                    echo "value='".$data['title']."'";
                  else
                    echo "placeholder='Enter Event Title'";
                  echo"
                  >
                </div>
                <div class='form-group'>
                  <label for='type'>Type</label>
                  <input type='datalist' class='form-control' id='type' ";
                  if (array_key_exists('type',$data))
                    echo "value='".$data['type']."'";
                  else 
                    echo"placeholder='Enter Event Type'";
                  echo" list='typelist'>
                  <datalist id='typelist'>
                        <option value='Type'>Type</option>
                        <option value='Appearance or Signing'>Appearance or Signing</option>
                        <option value='Attraction'>Attraction</option>
                        <option value='Camp, Trip, or Retreat'>Camp, Trip, or Retreat</option>
                        <option value='Class, Training, or Workshop'>Class, Training, or Workshop</option>
                        <option value='Concert or Performance'>Concert or Performance</option>
                        <option value='Conference'>Conference</option>
                        <option value='Convention'>Convention</option>
                        <option value='Dinner or Gala'>Dinner or Gala</option>
                        <option value='Festival or Fair'>Festival or Fair</option>
                        <option value='Game or Competition'>Game or Competition</option>
                        <option value='Meeting or Networking Event'>Meeting or Networking Event</option>
                        <option value='Other'>Other</option>
                        <option value='Party or Social Gathering'>Party or Social Gathering</option>
                        <option value='Race or Endurance Event'>Race or Endurance Event</option>
                        <option value='Rally'>Rally</option><option value='7'>Screening</option>
                        <option value='Seminar or Talk'>Seminar or Talk</option>
                        <option value='Tour'>Tour</option>
                        <option value='Tournament'>Tournament</option>
                        <option value='Tradeshow, Consumer Show, or Expo'>Tradeshow, Consumer Show, or Expo</option>
                  </datalist>
                </div>
                <div class='form-group'>
                  <label for='category'>Category</label>
                  <input class='form-control' id='category' ";
                  if (array_key_exists('category',$data))
                    echo "value='".$data['category']."'";
                  else 
                    echo"placeholder='Enter Event Category'";
                  echo" list='catlist'>
                  <datalist id='catlist'>
                        <option >Category</option>
                        <option >Auto, Boat &amp; Air</option>
                        <option >Business &amp; Professional</option>
                        <option >Charity &amp; Causes</option>
                        <option >Community &amp; Culture</option>
                        <option >Family &amp; Education</option>
                        <option >Fashion &amp; Beauty</option>
                        <option >Film, Media &amp; Entertainment</option>
                        <option >Food &amp; Drink</option>
                        <option >Government &amp; Politics</option>
                        <option >Health &amp; Wellness</option>
                        <option >Hobbies &amp; Special Interest</option>
                        <option >Home &amp; Lifestyle</option>
                        <option >Music</option>
                        <option >Other</option>
                        <option >Performing &amp; Visual Arts</option>
                        <option >Religion &amp; Spirituality</option>
                        <option >School Activities</option>
                        <option >Science &amp; Technology</option>
                        <option >Seasonal &amp; Holiday</option>
                        <option >Sports &amp; Fitness</option>
                        <option >Travel &amp; Outdoor</option>
                  </datalist>
                </div>
                <div class='form-group'>
                  <label for='venue'>Venue</label>
                  <textarea class='form-control' id='venue' placeholder='Enter Venue'>";
                    if(array_key_exists('venue',$data))
                      echo $data['venue'];
                  echo" </textarea>
                </div>
                <div class='form-group'>

                  <input type='checkbox' class='checkbox' id='mode'> Online
                  
                </div>
                ";echo"
                <script>
                  document.getElementById('mode').checked = ".(array_key_exists('online',$data)?$data['online']:0)."
                </script>
                
                <div class='form-group'>
                  <label for='starttime'>Start Time</label>
                  <input type='datetime-local' class='form-control' id='starttime' ";
                  if(array_key_exists('startT', $data))
                    echo"value='".date('Y-m-d\TH:i',strtotime($data['startT']))."'";
                  echo">
                </div>
                <div class='form-group'>
                  <label for='endtime' >End Time</label>
                  <input type='datetime-local' class='form-control' id='endtime' ";
                  if(array_key_exists('endT', $data))
                    echo"value='".date('Y-m-d\TH:i',strtotime($data['endT']))."'";
                  echo">
                </div>
                <div class='form-group'>
                  <input type='submit' id='addEventBtn' class='form-control btn btn-success' value='".$btn."'>
                </div>
            </div>";
}
?>