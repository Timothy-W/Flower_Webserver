<!DOCTYPE html>
<html>
<head>

<style>
table, td {
  border: 0px solid black;
}
  
  
</style>
</head>
<body>

<!-- Time of Day selector -->  
<p>Select timeSectionOfDay of day: 
<select id="timeOfDay" name="timeSectionOfDay">
  <option value="Morning">Morning</option>
  <option value="Afternoon">Afternoon</option>
  <option value="Evening">Evening</option>
</select>   
</p>

<!-- Enter Tasks with pictures-->
<form>
  Enter task: <input id="task_input" name="input_task" type="text"/> 
  <!--<br>Add picture or video to task:<input id="uploaded_file" type="file" name="multimedia_files" value="Add Pic or Vid"><br>-->
</form><br>

<!-- Buttons -->
<button onclick="myCreateFunction()">Add Task</button><br>

<!-- Save all added tasks to file using php script 

How do I get the form data to stay?
    adding onsubmit="return false" kept data but broke submit




-->
<br><form enctype="multipart/form-data" action="index.php" method="POST">
 <!-- Tables --> 
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
  <input type="submit" name="taskTable" value="Save Tasks to Flower">
</form><br><br>





<!-------------------------------------------------------------------------
                                Javascript
-------------------------------------------------------------------------->

<script type="text/javascript">
function myCreateFunction() {
  var task = document.getElementById("task_input").value; //getting task correctly
  console.log("Task '" + task + "' entered.");

  if (task != ""){
    
    var timeSectionOfDay = document.getElementById("timeOfDay").value;
    var postProcessTaskName = timeSectionOfDay + "[]'"

    var labelString = "<label for='" + postProcessTaskName + "'>" + task + "</label>"
    console.log("labelSring: " + labelString);
    
    var deleteMeCellStr = "<input type='button' value='Delete Task' onclick='deleteRow(this)'>";
    var taskCellStr = "<input type='text' name='" + postProcessTaskName + " value='" + task + "'/>";
    

    var multiMedia = document.getElementById("uploaded_file");
    var postProcessMultiMediaName = "MM_" + postProcessTaskName;

    console.log(multiMedia);
    
    var picOrVidCellString = "<input id='uploaded_file' type='file' name='" + postProcessMultiMediaName + " value=''>";
    
    
    // Uncomment if we just just name of added file to be displayed
    //var picOrVidCellString = basename(multiMedia.value); 
    console.log(picOrVidCellString);
    


    /*
    // Make the text a upload file button instead
    




    
    */


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

function deleteRow(o) {
    //no clue what to put here?
    var p=o.parentNode.parentNode;
    console.log("Removing row: " + p.cells.item(0).innerHTML);
    p.parentNode.removeChild(p);
}

function basename(path) {
    //console.log(path);
    return path.split('\\').reverse()[0];
}


// Not used
function makeTableEditable() {

  console.log("In makeTableEditable")
  
  var mornTable = document.getElementById("Morning")
  var rows = mornTable.rows;
  var rowCount = rows.length;

  console.log("mornTable: " + mornTable)

  //Loop through cell
  for (var i = 0; i < rowCount; i++){
    
    cells = rows[i].cells;
    cellcount = cells.length;
    for( c=0; c<cellcount; c++) {
        cell = cells[c];
        console.log(cell);  
    }

  }

}

//No longer used
function myDeleteFunction() {
  
  var timeSectionOfDay = document.getElementById("timeOfDay").value;
   
  var numCells = document.getElementById(timeSectionOfDay).rows.length;
  
  if (numCells > 1){
  document.getElementById(timeSectionOfDay).deleteRow(-1);
  document.getElementById(timeSectionOfDay + '2').deleteRow(-1);

  }
}
  


  
</script>

</body>
</html>

<?php


/*-------------------------------------------------------------------------------
        Save tasks to file.
-------------------------------------------------------------------------------*/


if(!empty($_POST['Morning']) or !empty($_POST['Afternoon']) or !empty($_POST['Evening']) ){
    
    $savedFile = '/home/pi/FlowerApp/Tasks/taskList.csv';

    $count = 0;
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
    
    echo "data: <br>$data";
    echo "<br><br>";

    $ret = file_put_contents($savedFile, $data, LOCK_EX);

    if($ret === false) {
        die('There was an error writing this file<br>');
    } else {
        echo "$count tasks saved. \n $ret bytes written to file.<br>";
    }

} elseif ($count != 0) {
    die('No tasks entered<br>'); // TODO this always gets executed, need to change that
}


/*-------------------------------------------------------------------------------
        Code for uploading files
-------------------------------------------------------------------------------*/

$timeOfDayArr = array('Morning', 'Afternoon', 'Evening');

for ($i = 0; $i < count($timeOfDayArr); $i++) {

    $timeLabel = $timeOfDayArr[$i];
    $currTimeLabel = "MM_" . $timeLabel;

    //TODO: Figure out how to map uploaded files to their tasks
    
    if(!empty($_FILES[$currTimeLabel])) {

        $currArray = $_FILES[$currTimeLabel];
        $count = count($currArray['name']);

        for ($fileNum = 0; $fileNum < $count; $fileNum++) {
        
            $fileName = $currArray['name'][$fileNum];
            $fileType = array_reverse( explode(".", $fileName))[0];     
            // Set path and get base file name 
            $path = "/home/pi/FlowerApp/Videos/";
                        
            //$path = $path . basename( $_FILES[$time]['name'][$fileNum]); //Use this line to keep original file names
            $path = $path . $fileNum . "_" . $timeLabel . "." . $fileType; 

            // Move file to from tmp location to desired location
            if(move_uploaded_file($_FILES[$currTimeLabel]['tmp_name'][$fileNum], $path)) {
            echo "<br>The file ".  basename( $_FILES[$currTimeLabel]['name'][$fileNum]). 
            " has been uploaded";
            } else{
                echo "<br>There was an error uploading the file, please try again!";
            }

        }

    }

}




/* $_FILES array structure
array(5) { 
    ["name"]=> array(2) {
        [0]=> string(14) "Cat_actual.jpg" 
        [1]=> string(13) "Cat_large.jpg" 
    } 
    ["type"]=> array(2) { 
        [0]=> string(10) "image/jpeg" 
        [1]=> string(10) "image/jpeg" 
    } 
    ["tmp_name"]=> array(2) { 
        [0]=> string(14) "/tmp/phpNV3IU2" 
        [1]=> string(14) "/tmp/php3b5Ce3" 
    } 
    ["error"]=> array(2) { 
        [0]=> int(0) 
        [1]=> int(0) 
    } 
    ["size"]=> array(2) { 
        [0]=> int(2900794) 
        [1]=> int(544582) 
    } 
} 
*/






















/* original example

if(!empty($_FILES['uploaded_file']))
  {
    $path = "uploads/";
    $path = $path . basename( $_FILES['uploaded_file']['name']);
    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
      echo "The file ".  basename( $_FILES['uploaded_file']['name']). 
      " has been uploaded";
    } else{
        echo "There was an error uploading the file, please try again!";
    }
  }
*/




?>