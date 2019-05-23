<?php

$data = "";

if(isset($_POST['mtask1'])){

        $data = $_POST['mtask1'] . ',';

} else if (isset($_POST['mtask2'])){

        $data = $data . $_POST['mtask2'] . ',';

}

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