

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


<html>
    <body>
        <table border="1">
            <tr>
                <th>no</th>
                <th>Project Id</th>
                <th>Definition</th>
                <th>Remove Project</th>
                <th colspan="2">Move project</th>
            </tr>
<?php
try {
    $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=project_db', 'root', '');
    $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'select leader from students where student_id=' . $_SESSION['student_id'];
    $query = $dbhandler->query($sql);
    $r = $query->fetch();
    $leader = $r['leader'];

    $sql = 'select * from p_' . $leader . ' ORDER BY no ASC';
    $query = $dbhandler->query($sql);

    while ($r = $query->fetch()) {

        $s = 'select definition from projects where project_id=' . $r['project_id'];
        $q = $dbhandler->query($s);
        $rr = $q->fetch();

        echo '<tr>'
        . '<td>'
        . $r['no']
        . '</td>'
        . '<td>'
        . $r['project_id']
        . '</td>'
        . '<td>'
        . $rr['definition']
        . ''
        . '</td>'
        . '<td>'
        . '<a href="remove_project.php?no=' . $r['no'] . '">Remove</a>'
        . '</td>'
        . '<td>'
        . '<a href="move_up_project.php?up=' . $r['no'] . '">Move Up</a>'
        . '</td>'
        . '<td>'
        . '<a href="move_down_project.php?down=' . $r['no'] . '">Move Down</a>'
        . '</td>'
        ;
    }
} catch (Exception $ex) {
    
}
?>
        </table>
        <h3 colspan="2"  align="center" style="color:#00b200">
            <?php
            if (isset($_GET['msg']))
                echo $_GET['msg'];
            ?>
        </h3>
    </body>
</html>