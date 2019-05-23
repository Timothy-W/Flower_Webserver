<?php

$data = "MRNG,";

//Morning Tasks




if(isset($_POST['mtask1']) && $_POST['mtask1'] != ""){
        $data = $data . $_POST['mtask1'] . ',';
} 

if (isset($_POST['mtask2']) && $_POST['mtask2'] != ""){
        $data = $data . $_POST['mtask2'] . ',';
}

if(isset($_POST['mtask3']) && $_POST['mtask3'] != ""){
        $data = $data . $_POST['mtask3'] . ',';
} 

if (isset($_POST['mtask4']) && $_POST['mtask4'] != ""){
        $data = $data . $_POST['mtask4'] . ',';
}

//Afternoon Tasks
$data = $data . "AFTN,";


if(isset($_POST['atask1']) && $_POST['atask1'] != ""){
        $data = $data . $_POST['atask1'] . ',';
} 

if (isset($_POST['atask2']) && $_POST['atask2'] != ""){
        $data = $data . $_POST['atask2'] . ',';
}

if(isset($_POST['atask3']) && $_POST['atask3'] != ""){
        $data = $data . $_POST['atask3'] . ',';
} 

if (isset($_POST['atask4']) && $_POST['atask4'] != ""){
        $data = $data . $_POST['atask4'] . ',';
}

//Evening Tasks
$data = $data . "EVN,";

if(isset($_POST['etask1']) && $_POST['etask1'] != ""){
        $data = $data . $_POST['etask1'] . ',';
} 

if (isset($_POST['etask2']) && $_POST['etask2'] != ""){
        $data = $data . $_POST['etask2'] . ',';
}

if(isset($_POST['etask3']) && $_POST['etask3'] != ""){
        $data = $data . $_POST['etask3'] . ',';
} 

if (isset($_POST['etask4']) && $_POST['etask4'] != ""){
        $data = $data . $_POST['etask4'] . ',';
}

$data = rtrim($data,',');
echo "data: $data\r\n";

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


?>
