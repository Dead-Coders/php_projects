


<?php

session_start();
if (!isset($_SESSION['student_id'])) {
    header("location:../../index.php?msg=AUTHENTICATION REQUIRED");
}
?>

<?php

try {
    $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=project_db', 'root', '');
    $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'select * from allocation_process where id=1';
    $query = $dbhandler->query($sql);
    $r = $query->fetch();
    if ($r['process'] == 8) {
        header('location:../../index.php?msg=System closed !!!');
    }
    if ($r['process'] != 2 && $r['process'] != 4 && $r['process'] != 6) {
        header('location:../index.php?msg=Now you can\'t enter into project selection');
    }
    $s='select allocated from students where student_id='.$_SESSION['student_id'];
    $q=$dbhandler->query($s);
    $rr=$q->fetch();
    if($rr['allocated']==1){
        header('location:../index.php?msg=Projected alredy allocated to your group');
    }
} catch (Exception $ex) {
    echo 'problem occur try again ';
}
?>


<?php

try {
    $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=project_db', 'root', '');
    $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if(isset($_GET['down']))
    {
        $temp=0;
        $sql1='select leader from students where student_id='.$_SESSION['student_id'];
        $query1=$dbhandler->query($sql1);
        $r1=$query1->fetch();
        $leader=$r1['leader'];
       
        $n=$_GET['down']+1;
        $s='select * from p_'.$leader.' where no='.$n;
        $q=$dbhandler->query($s);
        $r=$q->fetch();
        if($r!=null){
            $s1='update p_'.$leader.' SET no=0 where no='.$_GET['down'];
            $dbhandler->query($s1);
            $s2='update p_'.$leader.' SET no='.$_GET['down'].' where no='.$n;
            $dbhandler->query($s2);
            $s2='update p_'.$leader.' SET no='.$n.' where no=0';
            $dbhandler->query($s2);
        }
        else{
            $temp=1;
            header('location:selected.php?msg=Project can\'t move down');
        }

        if($temp==0){
        header('location:selected.php?msg=Project Moved');
        }
    }
    else{
        header('location:selected.php?msg=Please provide id');
    }
} catch (Exception $ex) {
    header('location:selected.php?msg=Project can\'t move down');
}
?>