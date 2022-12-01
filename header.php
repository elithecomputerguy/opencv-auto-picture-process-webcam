<h1>Open CV Detection App</h1>

<?php

$dir = "./data/haarcascades/";
$dir = scandir($dir);

echo "<form action='./process.php' method='post' enctype='multipart/form-data'>";
echo "<select name='filter'>";
echo "<option value=".$_SESSION['filter'].">".$_SESSION['filter']."</option>";

foreach($dir as $folder){
    $folder = trim($folder);
    if($folder != "." && $folder != ".."){    
        echo "<option value=$folder>$folder</option>";
    }    
}

       echo "</select>
        <a href='upload-cascade-form.php'>Upload New Cascade Filter</a>
        <br><br>
        Number of Pictures <input type='text' name='number' value=".$_SESSION['number']."><br>
        <input type='submit' value='Process Pictures'>
        </form>
        <br><br>";

?>