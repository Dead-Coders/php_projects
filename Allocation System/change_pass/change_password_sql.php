
<?php

/*
 * ****************************************************************************
 * ****************************************************************************

  HEllo, THis projecT of PHP
  subject - Project Allocation

  c3 Batch sem-4

  CE046	HireN ItaliyA
  CE047	JaganI VatsaL   #
  CE048	MohiT JaiN
  CE049	AkshiT JariwalA

 * ****************************************************************************
 * ****************************************************************************
 */
?>


<?php

session_start();
if (!isset($_SESSION['student_id']) && !isset($_SESSION['faculty'])) {
    header("location:../index.php?msg=AUTHENTICATION REQUIRED");
}
?>

<?php

if (!isset($_SESSION['faculty'])) {
    try {
        $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=project_db', 'root', '');
        $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'select * from allocation_process where id=1';
        $query = $dbhandler->query($sql);
        $r = $query->fetch();
        if ($r['process'] == 8) {
            header('location:../index.php?msg=System closed !!!');
        }
    } catch (Exception $ex) {
        echo 'problem occur try again ';
    }
}

if (isset($_POST['old_pass'])) {

    try {
        $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=project_db', 'root', '');
        $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if (isset($_SESSION['student_id'])) {
            $sql = "select password from students where student_id=" . $_SESSION['student_id'] . "";
        } else {
            $sql = "select password from faculty where faculty_id=" . $_SESSION['faculty'] . "";
        }
        $query = $dbhandler->query($sql);
        $r = $query->fetch();
        if ($r['password'] != $_POST['old_pass']) {
            header("location:change_password.php?msg=Wrong password validation");
        }
        else if (isset($_POST['new_pass']) && isset($_POST['re_pass'])) {     // check proper condition
            // if check condition for proper value
            $msg = '';

            if ($_POST['new_pass'] == $_POST['re_pass']) {
                if (!preg_match('/^(.{8,20})$/', $_POST['new_pass'])) {
                    $msg = 'password must between 8 to 20 character';                                         //      password between 8 to 20 charactor
                    header("location:change_password.php?msg=" . $msg);
                } else {
                    $sql = '';

                    if (isset($_SESSION['student_id'])) {
                        $sql = "update students SET password=? where student_id=" . $_SESSION['student_id'] . "";
                    } else {
                        $sql = "update faculty SET password=? where faculty_id=" . $_SESSION['faculty'] . "";
                    }


                    $query = $dbhandler->prepare($sql);
                    $query->execute(array($_POST['new_pass']));

                    if (isset($_SESSION['student_id'])) {
                        header("location:../student/index.php?msg=Your Password changed");
                    } else {
                        header("location:../admin/index.php?msg=Your Password changed");
                    }
                }
            } else {
                if (isset($_SESSION['student_id'])) {
                    header("location:../student/index.php?msg=Password confirmation failed");
                } else {
                    header("location:../admin/index.php?msg=Password confirmation failed");
                }
            }
        }
    } catch (PDOException $e) {
        $msg = 'password can\'t change';
        if (isset($_SESSION['student_id'])) {
            header("location:../index.php?msg='.$msg");
        } else {
            header("location:../admin/index.php?msg='.$msg");
        }
    }
} else {
    if (isset($_SESSION['student_id'])) {
        header("location:../student/index.php?msg=Fill required details");
    } else {
        header("location:../admin/index.php?msg=Fill required details");
    }
}
?>
