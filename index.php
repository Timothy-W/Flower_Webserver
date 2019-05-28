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

<p>Select time of day: 
<select id="timeOfDay" name="time">
  <option value="Morning">Morning</option>
  <option value="Afternoon">Afternoon</option>
  <option value="Evening">Evening</option>
</select>   
</p>

<form>
  Enter task: <input id="task_input" name="task" type="text"/><br/>
</form>

<!-- <input type="submit" name="submit" value="Save Tasks"> -->
<button onclick="myCreateFunction()">Add Task</button>
<button onclick="myDeleteFunction()">Delete Last Task</button><br>  

<!--
<form action="javascript:myCreateFunction()" method="POST">
  Enter task: <input id="task_input" name="task" type="text"/><br/>
  <input type="submit" name="submit" value="Save Tasks">
</form>  
-->

  
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


<script type="text/javascript">
function myCreateFunction() {
  var task = document.getElementById("task_input").value;
  var time = document.getElementById("timeOfDay").value;
    
  if (task != ""){
    var table = document.getElementById(time);
    var row = table.insertRow(-1);
    var cell = row.insertCell(0);
    cell.innerHTML = task;
  }
}

function myDeleteFunction() {
  
  var time = document.getElementById("timeOfDay").value;
   
  var numCells = document.getElementById(time).rows.length;
  
  if (numCells > 1){
  document.getElementById(time).deleteRow(-1);

  }
}
  
  
  
</script>

</body>
</html>