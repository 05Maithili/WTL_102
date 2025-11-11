<?php
include 'db.php';

$rawdata=file_get_contents("php://input");

$data=json_decode($rawdata,true);

$name=$data["name"];
$roll=$data["roll"];
$age=$data["age"];
$email=$data["email"];
$dob=$data["dob"];
$gender=$data["gender"];

$sql="insert into students (Name,Roll_no,Age,Email,DOB,Gender) values('$name',$roll,$age,'$email','$dob','$gender')";
$res=$conn->query($sql);

if($res)
{
    echo("data added successfully");
}else{
    echo("Failed to add data !");
}


?>