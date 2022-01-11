<?php
/**
 * Plugin Name: AddFlash
 * Description: Gør det nemt at generere en Flashkode til indsættelse i blogindlæg.
 * Version: 1.0.0
 * Author: Jens Brobak
 */
 
add_action('admin_menu', 'AddFlash_admin_actions');
function AddFlash_admin_actions() {
    add_posts_page('AddFlash', 'AddFlash','manage_options',__FILE__, 'AddFlash_admin');
}

function AddFlash_admin()
{
?>
    <h1>AddFlash</h1>
    
    <h3>1) Upload Flash fil:</h3>
    
<form action="" method="post" enctype="multipart/form-data">
    
    Vælg en Flash (<b>.swf</b>) fil som skal uploades til serveren:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Flash" name="submit">
    
</form><br>
<?php

$target_dir = "../wp-content/uploads/flash/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$target_name = $target_post . basename($_FILES["fileToUpload"]["name"]);

if(isset($_POST["submit"])) {

  if (file_exists($target_file)) {
    echo "<b>- Fejl:</b> Flash filen: <i>$target_name</i> kunne ikke uploades idet at Flash filen allerede eksisterer på serveren!";
   
} elseif ($_FILES["fileToUpload"]["type"] == "application/x-shockwave-flash"){
   (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file));
   echo "<b>Flash filen:</b> <i>$target_name</i> er successfuldt blevet uploadet til serveren!";
   
} else
    echo "<b>- Fejl:</b> Filen: <i>$target_name</i> som du forsøger at uploade er ikke en Flash (.swf) fil!";
}
?>
<br></br>
<?
if(isset($_POST["submit"])) {
    
    print "<h3>2) Genereret HTML-kode for: <i>"; echo "$target_name"; echo"</i></h3>";
    echo '<textarea rows="4" cols="50" autofocus="autofocus" onfocus="this.select()"><object width="100%" height="100%" data="'; echo "$target_file"; echo '"></object></textarea><br>(Tryk på genvejstasten <b>Ctrl + C/CMD + C</b> - For at kopiere HTML-koden.)<br></br>';
    print "<b>Output af</b>: <i>"; echo "$target_file</i><br></br>";
    echo '<object width="100%" height="$100%" data="'; echo "$target_file"; echo '"></object><br></br>';
}
}
?>