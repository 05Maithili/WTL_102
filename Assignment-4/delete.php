<?php
include 'db.php';
$rawdata=file_get_contents("php://input");

$data=json_decode($rawdata,true);

$roll=$data["roll"];

$sql = "DELETE FROM students WHERE Roll_no=$roll";

$res=$conn->query($sql);
   
if($res)
{
    echo("Entry deleted successfully");
}else{
    echo("Failed to delete entry !");
}
?>
