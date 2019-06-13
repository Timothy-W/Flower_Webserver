<!--

Author: Timothy Walker
Date: 13 June 2019
Class: UCSD CSE 176A, Healthcare Robotics

Description: This is a very basic wab page that takes as input tasks and media 
files, displays them in an HTML table and then saves them to specified folders. 
This code is part of a larger project for "The Don't Forget Flower".

The pages uses HTML, Javascript, PHP and CSS. The functionality is very basic.
All elements are within a single index.php file. There is no loading of previous
tasks or any use of a database. Those need to be added to make this a full 
CRUD web page.

Towards future work, the code needs to be refactored and made to be modular 
as the current implementation is not friendly when it comes to scalability 
or addiition of new features.

Additionally, NodeJS with Express and ReactJS would serve as better 
technologies to build this type of web interface.


-->

<!DOCTYPE html>
<html>
<head>

<style type="text/css">

body {
  background-color: #c3dc72;
}

/* Force a style change at a certain min width*/
@media(min-width:375px){
  
  .container {
    display: flex;
    margin: 0 auto;

  }

  .instructions {
    border: 5px #000000 solid;
    flex:1;
    max-width: 800px;
    
  }
  
  .main {
    flex:1;
    font-family: 'Oswald';
    font-size: 25px;
  }

}

.main div, .instructions div {
  border: 0px #ccc solid;
  padding: 10px;
}

/* Add styleing for buttons*/
#timeOfDay, #button {
  background-color: #8b72dc;
  padding: .5em;
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  border-radius: 6px;
  color: #fff;
  font-family: 'Oswald';
  font-size: 25px;
  text-decoration: none;
  border: none;
}

/* Next three elements, together, hide the original 
"Choose File button and then style a label to be placed 
over the originals location. This needs to be done because, 
the style of the default "Choose File" button is 
determined by the system and is not modifiable.*/
.upload-btn-wrapper {
  position: relative;
  overflow: hidden;
  display: inline-block;
}

.btn {
  color: white;
  background-color: #8b72dc;
  padding: 11px;
  border-radius: 8px;
  font-size: 25px;
  font-family: 'Oswald';
  
}

.upload-btn-wrapper input[type=file] {
  font-size: 100px;
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
}

/* Remaining CSS used to style the inport forms in the HTML*/
input[type=text] {
  margin: 0px 0;
  box-sizing: border-box;
  border-radius: 4px;
  font-size: 22px;
}

input[type=text]:focus {
  border: 3px solid #555;
}

</style>
</head>
<body>

<div class="container">

    <!-- Instructions displayed on the left hand side of page -->
    <div class="instructions">
          <img src="Ins.png" width="800" height="1200" alt="Instructions">     
        <figure></figure>
    </div>

    <!--  Main code for the task entry form, representing all elements 
          on the right hand side of the page-->
    <div class="main">

        <!-- Time of Day selector --> 
        <div class="time-selector" > 
          <p>Select time of day: 
            <select id="timeOfDay" name="timeSectionOfDay">
              <option value="Morning">Morning</option>
              <option value="Afternoon">Afternoon</option>
              <option value="Evening">Evening</option>
            </select>   
          </p>
        </div>

        <!-- Enter Tasks with pictures-->
        <div class="add-task">
          <form> Enter task: <input id="task_input" name="input_task" type="text"/> </form><br>
          <button id="button" onclick="myCreateFunction()">Add Task</button><br>
        </div>



        <!-- Tables that hold all the added task, their choose file option and the delete button.
        There are three seperate tables, one for each portion of the day. --> 
        <div class="table">
          <br><form enctype="multipart/form-data" action="index.php" method="POST">
          <table id="Morning">
            <th>Morning Tasks</th>
          </table>
          <br>

          <table id="Afternoon">
            <th>Afternoon Tasks</th>
          </table>
          <br>

          <table id="Evening">   
            <th>Evening Tasks</th>
          </table>

          <br> 
          <input type="submit" name="taskTable" id="button" value="Save Tasks to Flower">
          </form><br><br>
        </div>




<!---------------------------------------------------------------------------------
                          Save tasks to file.
-----------------------------------------------------------------------------------

 The php script that processes and saves all the data is kept inline. This was only 
 because I could not figure out how to make the output of the php script show up in 
 the correct place without placeing the entire php code in the html body. ----->

              <?php


                  /*-------------------------------------------------------------------------------
                          Save tasks to file.
                  -------------------------------------------------------------------------------*/

                  // If there are any tasks sent in the POST request
                  if(!empty($_POST['Morning']) or !empty($_POST['Afternoon']) or !empty($_POST['Evening']) ){

                      //save file path
                      $savedFile = '/home/pi/FlowerApp/Tasks/taskList.csv';
                  
                      $count = 0;

                      // $data will be the single string of all the tasks that have been added.
                      // Loop through Morning, Afternoon and Evening arrays and build data string.
                      $data = "Morning,";
                  
                      
                      foreach ($_POST['Morning'] as $key => $value) {
                          $data = $data . $value . ',';
                          $count++;
                      }
                    
                      $data = $data . "Afternoon,";
                    
                      foreach ($_POST['Afternoon'] as $key => $value) {
                          $data = $data . $value . ',';
                          $count++;
                      }
                    
                      $data = $data . "Evening,";
                    
                      foreach ($_POST['Evening'] as $key => $value) {
                          $data = $data . $value . ',';
                          $count++;
                      }

                      $data = rtrim($data,',');

                      //echo "data: <br>$data";
                      //echo "<br><br>";
                    
                      // Save data string to file
                      $ret = file_put_contents($savedFile, $data, LOCK_EX);
                    
                      //Out put depending on wether saving to file was successful or not.
                      if($ret === false) {
                          die('There was an error writing this file<br>');
                      } else {
                          echo "$count tasks saved.<br>"; //$ret bytes written to file.
                      }
                    
                  } elseif ($count != 0) {
                      die('No tasks entered<br>');
                  }


                  /*-------------------------------------------------------------------------------
                          Code for uploading files
                  -------------------------------------------------------------------------------*/

                  // Array of strings to be used for sections of day
                  $timeOfDayArr = array('Morning', 'Afternoon', 'Evening');

                  // Loop through timeofDayArr which represents the processing of 
                  // uploaded files for each time of day
                  for ($i = 0; $i < count($timeOfDayArr); $i++) {

                      // Get the current time of day labale and add prefix "MM_",
                      // The arrays that hold the files are "MM_Morning, MM_Afternoon
                      // and MM_Evening"
                      $timeLabel = $timeOfDayArr[$i];
                      $currTimeLabel = "MM_" . $timeLabel;
                  
                      // We always perform this process for all three times of day so 
                      // we check to make sure there are actually files uploaded.
                      if(!empty($_FILES[$currTimeLabel])) {
                      
                          // Grab current aray from $_FILES and determine number 
                          // of uploaded media files.
                          $currArray = $_FILES[$currTimeLabel];
                          $count = count($currArray['name']);
                      
                          // Loop over each uploaded file for time of day
                          for ($fileNum = 0; $fileNum < $count; $fileNum++) {
                          
                              $fileName = $currArray['name'][$fileNum];
                              
                              if ($fileName != ""){
                              
                              // Get file type of uploaded file.
                              $fileType = array_reverse( explode(".", $fileName))[0];   

                              // Set path and get base file name 
                              $path = "/home/pi/FlowerApp/Videos/";

                              //Build file name.
                              //$path = $path . basename( $_FILES[$time]['name'][$fileNum]); //Use this line to keep original file names
                              $path = $path . $fileNum . "_" . $timeLabel . "." . $fileType; 
                          
                              
                              // Move file to from tmp location to desired location where the files was initially
                              // stored and save it to the desired directory using the preferred name.
                              if(move_uploaded_file($_FILES[$currTimeLabel]['tmp_name'][$fileNum], $path)) {
                              echo "<br>The file ".  basename( $_FILES[$currTimeLabel]['name'][$fileNum]). 
                              " has been uploaded";
                              } else{
                                  echo "<br>There was an error uploading the file, please try again!";
                              }
                            }
                            
                          }
                        
                      }
                    
                  }

              ?>


    </div>

</div>

<!-------------------------------------------------------------------------
                                Javascript
-------------------------------------------------------------------------->

<script type="text/javascript">

/* 

  Funciton is invoked when the "Add task" button is pressed.
  Function grabs task from input form and builds the html code
  that is entered as the value of cells in the HTML table.

 */

function myCreateFunction() {

  // Grab task
  var task = document.getElementById("task_input").value; 
  console.log("Task '" + task + "' entered.");

  // Make sure its not an empty string
  if (task != ""){
    

    var timeSectionOfDay = document.getElementById("timeOfDay").value;
    var postProcessTaskName = timeSectionOfDay + "[]'"

    //Build label tag for task
    var labelString = "<label for='" + postProcessTaskName + "'>" + task + "</label>"
    console.log("labelSring: " + labelString);
    
    // build "Delete Task" button for cell
    var deleteMeCellStr = "<input type='button' id='button' value='Delete Task' onclick='deleteRow(this)'>";

    //Build editable task for cell
    var taskCellStr = "<input type='text' name='" + postProcessTaskName + " value='" + task + "'/>";
    
    // Build "Choose File" input for cell
    var multiMedia = document.getElementById("uploaded_file");
    var postProcessMultiMediaName = "MM_" + postProcessTaskName;    
    var picOrVidCellString = "<div class='upload-btn-wrapper'><button class='btn'>Upload Video</button><input id='uploaded_file' type='file' name='" + postProcessMultiMediaName + "></div>";


    // Grab table, add cells with their corresponding HTML code. 
    // Result are process as HTML and displayed as buttons in the page
    var table = document.getElementById(timeSectionOfDay);
    var row = table.insertRow(-1);
    var cell0 = row.insertCell(0);
    cell0.innerHTML = taskCellStr;

    var cell1 = row.insertCell(1)
    cell1.innerHTML = picOrVidCellString;

    var cell2 = row.insertCell(2);
    cell2.innerHTML = deleteMeCellStr;

  }
}

/*   
  Function is invoked by the "Delete Task" button. Function determines the 
  parent of the row and then deletes the child. Essentially removing the row 
  in which the function was invoked
*/
function deleteRow(o) {
    var p=o.parentNode.parentNode;
    console.log("Removing row: " + p.cells.item(0).innerHTML);
    p.parentNode.removeChild(p);
}

// Function to determine the base file in a path.
// Example: /home/bob/file.txt -> file.txt
function basename(path) {
    //console.log(path);
    return path.split('\\').reverse()[0];
}

  
</script>

</body>
</html>

