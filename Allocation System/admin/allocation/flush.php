


<?php
session_start();
if(!isset($_SESSION['admin']))
{
    header("location:../admin_login.php?msg=AUTHENTICATION REQUIRED");
}
?>


<?php   
try{

$dbhandler = new PDO('mysql:host=127.0.0.1;dbname=project_db','root','');
$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='select leader from groups';
$query=$dbhandler->query($sql);
while($r=$query->fetch()){
    $dbhandler->query('drop table p_'.$r['leader']);
    $dbhandler->query('delete from groups where leader='.$r['leader']);
}

$sql='select project_id from projects where selected=1';
$query=$dbhandler->query($sql);
while($r=$query->fetch()){
    $dbhandler->query('update projects SET selected=0 where project_id='.$r['project_id']);
}

$sql='select student_id from students where participate=1';
$query=$dbhandler->query($sql);
while($r=$query->fetch()){
    $dbhandler->query('update students SET participate=0 where student_id='.$r['student_id']);
}

header('location:../index.php?msg=Flushed all previuos data');
}
catch(Exception $ex){
    echo $ex->getMessage();
}

?>
