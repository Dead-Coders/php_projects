



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
    
    if(isset($_GET['no']))
    {
        $sql1='select leader from students where student_id='.$_SESSION['student_id'];
        $query1=$dbhandler->query($sql1);
        $r1=$query1->fetch();
        $leader=$r1['leader'];
        
        $sql2='delete from p_'.$leader.' where no='.$_GET['no'];
        $query2=$dbhandler->query($sql2);
        
        $sql='select * from p_'.$leader.' ORDER BY no ASC';
        $query=$dbhandler->query($sql);
        
        if($_GET['no']!=1){
            while($r=$query->fetch()){
                if(($_GET['no']-1)==$r['no']){
                    break;
                }
            }
        }
        $n=$_GET['no'];
        while($r=$query->fetch()){
            $s='update p_'.$leader.' SET no='.$n.' where no='.$r['no'];
            $dbhandler->query($s);
            $n++;
        }
        
        header('location:selected.php?msg=Project Removed');
    }
    else{
        header('location:selected.php?msg=Please provide id');
    }
} catch (Exception $ex) {
    echo 'hello';
}
?>