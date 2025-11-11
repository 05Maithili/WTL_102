<?php
include "db.php";
$sql="select * from students";
$result=$conn->query($sql);
if($result->num_rows>0)
{
    $arr=[];
    while($row=$result->fetch_assoc())
    {
        $arr[]=$row;
    }
    header("content-type:application/json");
    echo(json_encode($arr));
}else{
  $arr=["message"=>"No records Found"];
   header("content-type:application/json");
    echo(json_encode($arr));
}
?>