<?php





echo "data: $data\n";

if($data != ""){

$ret = file_put_contents('/var/www/html/data/mydata.csv', $data, LOCK_EX);

if($ret === false) {
        die('There was an error writing this file');
} else {
        echo "$ret bytes written to file";
        }

}
else {
   die('No tasks entered');
}












/*


//Morning Tasks

if(isset($_POST['mtask1']) && $_POST['mtask1'] != ""){
        $data = $_POST['mtask1'] . ',';
} 

if (isset($_POST['mtask2']) && $_POST['mtask2'] != ""){
        $data = $data . $_POST['mtask2'] . ',';
}

if(isset($_POST['mtask3']) && $_POST['mtask3'] != ""){
        $data = $_POST['mtask3'] . ',';
} 

if (isset($_POST['mtask4']) && $_POST['mtask4'] != ""){
        $data = $data . $_POST['mtask4'] . ',';
}

//Afternoon Tasks


if(isset($_POST['atask1']) && $_POST['atask1'] != ""){
        $data = $_POST['atask1'] . ',';
} 

if (isset($_POST['atask2']) && $_POST['mtask2'] != ""){
        $data = $data . $_POST['mtask2'] . ',';
}

if(isset($_POST['atask3']) && $_POST['mtask3'] != ""){
        $data = $_POST['mtask3'] . ',';
} 

if (isset($_POST['mtask4']) && $_POST['mtask4'] != ""){
        $data = $data . $_POST['mtask4'] . ',';
}

//Evening Tasks


if(isset($_POST['mtask1']) && $_POST['mtask1'] != ""){
        $data = $_POST['mtask1'] . ',';
} 

if (isset($_POST['mtask2']) && $_POST['mtask2'] != ""){
        $data = $data . $_POST['mtask2'] . ',';
}

if(isset($_POST['mtask3']) && $_POST['mtask3'] != ""){
        $data = $_POST['mtask3'] . ',';
} 

if (isset($_POST['mtask4']) && $_POST['mtask4'] != ""){
        $data = $data . $_POST['mtask4'] . ',';
}

echo "data: $data\n";

if($data != ""){

$ret = file_put_contents('/var/www/html/data/mydata.csv', $data, LOCK_EX);

if($ret === false) {
        die('There was an error writing this file');
} else {
        echo "$ret bytes written to file";
        }

}
else {
   die('No tasks entered');
}




*/



?>