<?php
session_start();

$filter = $_POST['filter'];
$number = $_POST['number'];

$_SESSION['run_time'] = time();
$_SESSION['number'] = $number;
$_SESSION['filter'] = $filter;

$delete_pics = shell_exec("rm ./pics/*.png");
file_put_contents("./pic-data.txt","");

echo "$filter<br><br>";

file_put_contents("opencv-data.txt", $filter);

for($x=1; $x <= $number; $x++){
    $opencv_result = shell_exec("python3 take-pic.py");
}

if($opencv_result !=""){
    header("Location: ./index.php");
} else {
    echo "problem";
}
?>