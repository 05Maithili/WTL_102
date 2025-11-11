<?php
include "db.php";

$rawdata=file_get_contents("php://input");

$data=json_decode($rawdata,true);

$name=$data["name"];
$roll=$data["roll"];
$age=$data["age"];
$email=$data["email"];
$dob=$data["dob"];
$gender=$data["gender"];

$sql="UPDATE students SET Name='$name', Age=$age,Email='$email',DOB='$dob',Gender='$gender' WHERE Roll_no=$roll";
$res=$conn->query($sql);

if($res)
{
    echo("data updated successfully");
}else{
    echo("Failed to update data !");
}



?>