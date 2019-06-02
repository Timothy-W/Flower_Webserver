<?php

$data = "Morning,";

foreach ($_POST['Morning'] as $key => $value) {
        $data = $data . $value . ',';
 }

$data = $data . "Afternoon,";

foreach ($_POST['Afternoon'] as $key => $value) {
        $data = $data . $value . ',';
 }

$data = $data . "Evening,";

foreach ($_POST['Evening'] as $key => $value) {
        $data = $data . $value . ',';
 }










echo "data: $data\n";

if($data != ""){

$ret = file_put_contents('/tmp/mydata.csv', $data, LOCK_EX);

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
