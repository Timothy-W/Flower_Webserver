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
<p>Select time of day: 
<select id="timeOfDay" name="time">
  <option value="Morning">Morning</option>
  <option value="Afternoon">Afternoon</option>
  <option value="Evening">Evening</option>
</select>   
</p>

<!-- Enter Tasks -->
<form>
  Enter task: <input id="task_input" name="input_task" type="text"/>
</form><br>

<!-- Buttons -->
<button onclick="myCreateFunction()">Add Task</button>


<!--
<button onclick="myDeleteFunction()">Delete Last Task</button><br>
-->
  
  
  
<!-- Table on display 
<table id="Morning2">
 <th>Morning Tasks</th>
</table>
<br>
  
<table id="Afternoon2">
 <th>Afternoon Tasks</th>
</table>
<br>
  
<table id="Evening2">
 <th>Evening Tasks</th>
</table>
<br>
-->


<!-- Save all added tasks to file using php script -->
<br><form action="savetofile.php" method="POST">
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
<th>Morning Tasks</th>
</table>
<br> 
  <input type="submit" name="taskTable" value="Save Tasks to Flower">
</form><br>  

<!--
<button onclick="makeTableEditable()">Edit Tasks</button>
-->

<script type="text/javascript">
function myCreateFunction() {
  var task = document.getElementById("task_input").value;
  var time = document.getElementById("timeOfDay").value;
  var stringOfName = time + "[]'"
  var labelString = "<label for='" + stringOfName + "'>" + task + "</label>"
  var deleteMeStr = "<input type='button' value='Delete Task' onclick='deleteRow(this)'>";
  var cellString = "<input type='text' name='" + stringOfName + " value='" + task + "'/>";
  
  if (task != ""){
    var table = document.getElementById(time);
    var row = table.insertRow(-1);
    var cell1 = row.insertCell(0);
    cell1.innerHTML = cellString;	

    var cell2 = row.insertCell(1);
    cell2.innerHTML = deleteMeStr;

    /*
    var table = document.getElementById(time + '2');
    var row = table.insertRow(-1);
    var cell = row.insertCell(0);
    cell.innerHTML = task;
    */

  }
}

function deleteRow(o) {
     //no clue what to put here?
  var p=o.parentNode.parentNode;
  console.log("Removing row: " + p.cells.item(0).innerHTML);
  p.parentNode.removeChild(p);

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
  
  var time = document.getElementById("timeOfDay").value;
   
  var numCells = document.getElementById(time).rows.length;
  
  if (numCells > 1){
  document.getElementById(time).deleteRow(-1);
  document.getElementById(time + '2').deleteRow(-1);

  }
}
  
  
  
</script>

</body>
</html>
