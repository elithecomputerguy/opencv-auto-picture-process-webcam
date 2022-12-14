<?php
session_start();
include './header.php';

$pic_size = 300;

$key_array = array();

$file = file("./pic-data.txt");

$filter = file_get_contents("opencv-data.txt");

echo "<h3>Filter: $filter</h3>";

foreach($file as $picture){
    if(strpos($picture, "[")){
        $result = explode("[", $picture);
        $coordinates = $result[1];
        $coordinates = trim($coordinates);
        $coordinates = rtrim($coordinates,"]");
        $key_array[$result[0]] = $coordinates;
    } else {
        $picture = trim($picture);
        $key_array[$picture] = "0,0,0,0";
    }
}

krsort($key_array);

foreach($key_array as $pic =>$xy){
    if($xy == "0,0,0,0"){
        $color = "grey";
    } else {
        $color = "green";
    }
    echo "<div style='display:inline-block; width:$pic_size; border: 5px solid $color; background-color: $color'>";
    $size = getimagesize($pic);
    $width = $size[0];
    $height = $size[1];
    echo "Picture: $pic<br>";
    echo "Width: $width Height: $height<br>";

    $box = explode("', '",$xy);
    foreach($box as $coordinates){
        $coordinates = trim($coordinates);
        $coordinates = ltrim($coordinates, "'");
        $coordinates = rtrim($coordinates, "'");
        echo "$coordinates<br>";
    }
    echo "<div style='position:relative;'>";
    echo "<img src='$pic' style='width:$pic_size; height:auto;'>";

    foreach($box as $coordinates){
            $coordinates = trim($coordinates);
            $coordinates = ltrim($coordinates, "'");
            $coordinates = rtrim($coordinates, "'");

            $resize_percent = $pic_size / $width;
            $resize_height = $height * $resize_percent;
    
            $val = explode(",", $coordinates);
            $x_axis = $val[0] * $resize_percent;
            $y_axis = $val[1] * $resize_percent;
            $box_height = $val[3] * $resize_percent;
            $box_width = $val[2] * $resize_percent;

            echo "<div style='position:absolute; top:$y_axis; left:$x_axis;border: 5px solid red;width:$box_width;height:$box_height;'></div>";     
    }
    echo "</div>";
    echo "</div>";
}

$run_time = time() - $_SESSION['run_time'];
echo "<h3>Run Time: $run_time seconds</h3>";
echo "<h3>Pictures Taken: ".$_SESSION['number']."</h3>";
$per_pic = $run_time / $_SESSION['number'];
echo "<h3>Per Picture Time: $per_pic seconds</h3>";
?>