

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
                <th>Add Project</th>

            </tr>
<?php
try {
    $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=project_db', 'root', '');
    $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql1 = 'select leader from students where student_id=' . $_SESSION['student_id'];
    $query1 = $dbhandler->query($sql1);
    $r1 = $query1->fetch();
    $leader = $r1['leader'];

    $sql = 'select project_id,definition from projects where enable=1 && selected=0';
    $query = $dbhandler->query($sql);

    $no = 1;
    while ($r = $query->fetch()) {

        $s = 'select no from p_' . $leader . ' where project_id=' . $r['project_id'];
        $q = $dbhandler->query($s);
        $rr = $q->fetch();

        if ($rr == null) {
            echo '<tr>'
            . '<td>'
            . $no
            . '</td>'
            . '<td>'
            . $r['project_id']
            . '</td>'
            . '<td>'
            . $r['definition']
            . ''
            . '</td>'
            . '<td>'
            . '<a href="add_project.php?project_id=' . $r['project_id'] . '">Add</a>'
            . '</td>';

            $no++;
        }
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