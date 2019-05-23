<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>Enter Tasks</title> 
    </head>
<body>
 
<p id="task_list"></p>
 
        <form action="savetofile.php" method="POST">
           Morning Task 1: <input name="mtask1" type="text" value=""/><br/>
           Morning Task 2: <input name="mtask2" type="text" value=""/><br/>
           Morning Task 3: <input name="mtask3" type="text" value=""/><br/>
           Morning Task 4: <input name="mtask4" type="text" value=""/><br/>
           <br>
           Afternoon Task 1: <input name="atask1" type="text" value=""/><br/>
           Afternoon Task 2: <input name="atask2" type="text" value=""/><br/>
           Afternoon Task 3: <input name="atask3" type="text" value=""/><br/>
           Afternoon Task 4: <input name="atask4" type="text" value=""/><br/> 
           <br>
           Evening Task 1: <input name="etask1" type="text" value=""/><br/>
           Evening Task 2: <input name="etask2" type="text" value=""/><br/>
           Evening Task 3: <input name="etask3" type="text" value=""/><br/>
           Evening Task 4: <input name="etask4" type="text" value=""/><br/> 
           <input type="submit" name="submit" value="Save Tasks">
        </form>

</body>
</html>




