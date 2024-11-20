


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

$sql='select * from groups ORDER BY average DESC';
$query=$dbhandler->query($sql);

while($r=$query->fetch()){
    if($r['project']==0){
        $s='select * from p_'.$r['leader'].' ORDER BY no ASC';
        $q=$dbhandler->query($s);
        while($rr=$q->fetch()){
            $ss='select selected from projects where project_id='.$rr['project_id'];
            $qq=$dbhandler->query($ss);
            $rrr=$qq->fetch();
            
            if($rrr['selected']==0){
                $s4='update students SET allocated=1 where student_id='.$r['mem1'];
                $dbhandler->query($s4);
                $s5='update students SET allocated=1 where student_id='.$r['mem2'];
                $dbhandler->query($s5);
                $s6='update students SET allocated=1 where student_id='.$r['mem3'];
                $dbhandler->query($s6);
                $s1='update projects SET selected=1 where project_id='.$rr['project_id'];
                $dbhandler->query($s1);
                $s2='update groups SET project='.$rr['project_id'].' where leader='.$r['leader'];
                $dbhandler->query($s2);
                $s3='update students SET allocated=1 where student_id='.$r['leader'];
                $dbhandler->query($s3);
                break;
            }
        }
    }
}

$sql='select * from groups ORDER BY average ASC';
$query=$dbhandler->query($sql);

while($r=$query->fetch()){
    if($r['project']==0){
        $s='select * from p_'.$r['leader'].' ORDER BY no ASC';
        $q=$dbhandler->query($s);
        while($rr=$q->fetch()){
            $ss='select selected from projects where project_id='.$rr['project_id'];
            $qq=$dbhandler->query($ss);
            $rrr=$qq->fetch();
            if($rrr['selected']==1){
                //      delete selected projects from all left group and arrange 'no' properly
                $sd='delete from p_'.$r['leader'].' where project_id='.$rr['project_id'];
                $dbhandler->query($sd);
            }
        }
        $s='select * from p_'.$r['leader'].' ORDER BY no ASC';
        $q=$dbhandler->query($s);
        $count=1;
        while($r=$q->fetch()){
            $change='update p_'.$r['leader'].' SET no='.$count.' where no='.$r['no'];
            $dbhandler->query($change);
            $count++;
        }
    }
}

header('location:../index.php?msg=Allocation Complete');
}
catch(Exception $ex){
    echo 'hello';
}

?>
