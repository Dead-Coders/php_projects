


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
    if ($r['process'] != 1) {
        header('location:../index.php?msg=Now you can\'t do anything with group');
    }
} catch (Exception $ex) {
    echo 'problem occur try again ';
}
?>


<?php

try {
    $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=project_db', 'root', '');
    $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    //  check all students id is proper 
    //  all student must not group with any other
    //  change leader for all
    //  make entry in groups    
    //  if $_POST['insert'] is set then insert other wise update

    $temp = 0;
    $msg1 = '';
    $msg2 = '';
    $msg3 = '';

    $count = 1;
    $sum = 0;
    $sql = 'select cpi from students where student_id=' . $_SESSION['student_id'].' && participate=1';
    $query = $dbhandler->query($sql);
    $r = $query->fetch();
//    print_r($r);
    $sum+=$r['cpi'];


    if (isset($_POST['insert'])) {
        $sql = 'update students SET leader=' . $_SESSION['student_id'] . ' where student_id=' . $_SESSION['student_id'];
        $dbhandler->query($sql);


        $member1 = 0;
        $member2 = 0;
        $member3 = 0;


        if (!isset($_POST['mem1']) || $_POST['mem1'] == '' || $_POST['mem1'] == '0') {
            
        } else {

            try {

                $sql = 'select * from students where student_id=' . $_POST['mem1'].' && participate=1';
                $query = $dbhandler->query($sql);
                $r = $query->fetch();
                if ($r != NULL) {
                    $sql = 'update students SET leader=' . $_SESSION['student_id'] . ' where student_id=' . $_POST['mem1'];
                    $dbhandler->query($sql);
                    $member1 = $_POST['mem1'];
                    $sum+=$r['cpi'];
                    $count++;
                } else {
                    $msg1 = 'Previously entered student id in member1 can\'t  grouped';
                }
            } catch (Exception $ex) {
                $msg1 = 'Previously entered student id in member1 can\'t  grouped';
            }
        }

        if (!isset($_POST['mem2']) || $_POST['mem2'] == '' || $_POST['mem2'] == '0') {
            
        } else {
            try {

                $sql = 'select * from students where student_id=' . $_POST['mem2'].' && participate=1';
                $query = $dbhandler->query($sql);
                $r = $query->fetch();
                if ($r != NULL) {
                    $sql = 'update students SET leader=' . $_SESSION['student_id'] . ' where student_id=' . $_POST['mem2'];
                    $dbhandler->query($sql);
                    $member2 = $_POST['mem2'];
                    $sum+=$r['cpi'];
                    $count++;
                } else {
                    $msg2 = 'Previously entered student id in member2 can\'t  grouped';
                }
            } catch (Exception $ex) {
                $msg2 = 'Previously entered student id in member2 can\'t  grouped';
            }
        }

        if (!isset($_POST['mem3']) || $_POST['mem3'] == '' || $_POST['mem3'] == '0') {
            
        } else {
            try {

                $sql = 'select * from students where student_id=' . $_POST['mem3'].' && participate=1';
                $query = $dbhandler->query($sql);
                $r = $query->fetch();
                if ($r != NULL) {
                    $sql = 'update students SET leader=' . $_SESSION['student_id'] . ' where student_id=' . $_POST['mem3'];
                    $dbhandler->query($sql);
                    $member3 = $_POST['mem3'];
                    $sum+=$r['cpi'];
                    $count++;
                } else {
                    $msg3 = 'Previously entered student id in member3 can\'t  grouped';
                }
            } catch (Exception $ex) {
                $msg3 = 'Previously entered student id in member3 can\'t  grouped';
            }
        }

        $avg = $sum / $count;
        $sql = 'insert into groups (leader,mem1,mem2,mem3,average,project) values (' . $_SESSION['student_id'] . ',' . $member1 . ',' . $member2 . ',' . $member3 . ',' . $avg . ',0)';
        $dbhandler->query($sql);
        $sql = 'create table p_' . $_SESSION['student_id'] . '(no INT(5) UNSIGNED UNIQUE AUTO_INCREMENT, project_id INT(6) UNSIGNED UNIQUE)';
        $dbhandler->query($sql);

        $msg = 'Group Created';
        header('location:make_group.php?msg=' . $msg . '&msg1=' . $msg1 . '&msg2=' . $msg2 . '&msg3=' . $msg3);
    } else {

        $member1 = 0;
        $member2 = 0;
        $member3 = 0;

        $sql = 'select * from groups where leader=' . $_SESSION['student_id'];
        $query = $dbhandler->query($sql);
        $r_g = $query->fetch();


        if (!(!isset($_POST['mem1']) || $_POST['mem1'] == '' || $_POST['mem1'] == '0')) {
            try {
                $sql = 'update students SET leader=0 where student_id=' . $r_g['mem1'];
                $dbhandler->query($sql);
                $sql = 'select * from students where student_id=' . $_POST['mem1'].' && participate=1';
                $query = $dbhandler->query($sql);
                $r = $query->fetch();
                if ($r != NULL) {
                    $sql = 'update students SET leader=' . $_SESSION['student_id'] . ' where student_id=' . $_POST['mem1'];
                    $dbhandler->query($sql);
                    $member1 = $_POST['mem1'];
                    $sum+=$r['cpi'];
                    $count++;
                } else {
                    $msg1 = 'Previously entered student id in member1 can\'t  grouped';
                }
            } catch (Exception $ex) {
                $msg1 = 'Previously entered student id in member1 can\'t  grouped';
            }
        } else {
            $sql = 'update students SET leader=0 where student_id=' . $r_g['mem1'];
            $dbhandler->query($sql);
        }

        if (!(!isset($_POST['mem2']) || $_POST['mem2'] == '' || $_POST['mem2'] == '0')) {
            try {
                $sql = 'update students SET leader=0 where student_id=' . $r_g['mem2'];
                $dbhandler->query($sql);
                $sql = 'select * from students where student_id=' . $_POST['mem2'].' && participate=1';
                $query = $dbhandler->query($sql);
                $r = $query->fetch();
                if ($r != NULL) {
                    $sql = 'update students SET leader=' . $_SESSION['student_id'] . ' where student_id=' . $_POST['mem2'];
                    $dbhandler->query($sql);
                    $member2 = $_POST['mem2'];
                    $sum+=$r['cpi'];
                    $count++;
                } else {
                    $msg2 = 'Previously entered student id in member2 can\'t  grouped';
                }
            } catch (Exception $ex) {
                $msg2 = 'Previously entered student id in member2 can\'t  grouped';
            }
        } else {
            $sql = 'update students SET leader=0 where student_id=' . $r_g['mem2'];
            $dbhandler->query($sql);
        }

        if (!(!isset($_POST['mem3']) || $_POST['mem3'] == '' || $_POST['mem3'] == '0')) {
            try {
                $sql = 'update students SET leader=0 where student_id=' . $r_g['mem3'];
                $dbhandler->query($sql);
                $sql = 'select * from students where student_id=' . $_POST['mem3'].' && participate=1';
                $query = $dbhandler->query($sql);
                $r = $query->fetch();
                if ($r != NULL) {
                    $sql = 'update students SET leader=' . $_SESSION['student_id'] . ' where student_id=' . $_POST['mem3'];
                    $dbhandler->query($sql);
                    $member3 = $_POST['mem3'];
                    $sum+=$r['cpi'];
                    $count++;
                } else {
                    $msg3 = 'Previously entered student id in member3 can\'t  grouped';
                }
            } catch (Exception $ex) {
                $msg3 = 'Previously entered student id in member3 can\'t  grouped';
            }
        } else {
            $sql = 'update students SET leader=0 where student_id=' . $r_g['mem3'];
            $dbhandler->query($sql);
        }

        $avg = $sum / $count;

        $sql = 'update groups SET mem1=' . $member1 . ',mem2=' . $member2 . ',mem3=' . $member3 . ',average=' . $avg . ' where leader=' . $_SESSION['student_id'];
        $dbhandler->query($sql);

        $msg = 'Group Updated';
        header('location:make_group.php?msg=' . $msg . '&msg1=' . $msg1 . '&msg2=' . $msg2 . '&msg3=' . $msg3);
    }
} catch (Exception $ex) {
    echo 'problem occured try later';
}
?>
