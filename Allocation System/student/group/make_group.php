


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
        header('location:../index.php?msg=Now you can\'t do any thing with group');
    }

    $sql = 'select leader from students where student_id=' . $_SESSION['student_id'].' && participate=1';
    $query = $dbhandler->query($sql);
    $r = $query->fetch();
    if ($r['leader'] != 0 && $r['leader'] != $_SESSION['student_id']) {
        header('location:../index.php?msg=You alredy grouped can\'t create group now');
    }
} catch (Exception $ex) {
    echo 'problem occur try again ';
}
?>




<html>
    <head>
        <title>Project Allocation</title>
        <link rel='icon' href="../../favicon.ico">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="Robot" content="index,follow,project,allocation,distribution,subject"/>
        <meta name="Description" content="Online Project Allocation is available over here"/>
        <link rel="stylesheet" type="text/css" href="../../main.css"> 
    </head>
    <body>
        <h1 align="center">Student Project Allocation System</h1>
        <h3 align="center"><a href="../index.php" class="back shadow"><= Back</a></h3>
        <h3 align="center">Id: <?php echo $_SESSION['student_id']; ?>  &emsp;       Name : <?php echo $_SESSION['student_name']; ?>&emsp;<a href="../student_logout.php" class="log_out shadow">Logout</a>&emsp;</h3>
        <form action="make_group_sql.php" method="post">
            <table border="1" align="center">
                <tr><th colspan="2" align="center">Make Group</th></tr>
                <tr><th></th><th>Member Id</th></tr>

<?php
try {
    $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=project_db', 'root', '');
    $dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'select * from groups where leader=' . $_SESSION['student_id'];
    $query = $dbhandler->query($sql);
    $r = $query->fetch();
    if ($r == NULL) {
        echo '<input type="hidden" name="insert" value="1">
                            
                            <tr>
                                <td>First Member</td>
                                <td><input type="text" class="textbox" name="mem1"></td>
                            </tr>
                            <tr>
                                <td>Second Member</td>
                                <td><input type="text" class="textbox" name="mem2"></td>
                            </tr>
                            <tr>
                                <td>Third Member</td>
                                <td><input type="text" class="textbox" name="mem3"></td>
                            </tr>';
    } else {
        if ($r['mem1'] == 0) {
            echo '<tr>
                                        <td>First Member</td>
                                        <td><input type="text" class="textbox" name="mem1"></td>
                                    </tr>';
        } else {
            echo '<tr>
                                        <td>First Member</td>
                                        <td><input type="text" class="textbox" name="mem1" value=' . $r['mem1'] . '></td>
                                    </tr>';
        }
        if ($r['mem2'] == 0) {
            echo '<tr>
                                        <td>Second Member</td>
                                        <td><input type="text" class="textbox" name="mem2"></td>
                                    </tr>';
        } else {
            echo '<tr>
                                        <td>Second Member</td>
                                        <td><input type="text" class="textbox" name="mem2" value=' . $r['mem2'] . '></td>
                                    </tr>';
        }
        if ($r['mem3'] == 0) {
            echo '<tr>
                                        <td>Third Member</td>
                                        <td><input type="text" class="textbox" name="mem3"></td>
                                    </tr>';
        } else {
            echo '<tr>
                                        <td>Third Member</td>
                                        <td><input type="text" class="textbox" name="mem3" value=' . $r['mem3'] . '></td>
                                    </tr>';
        }
    }
} catch (Exception $ex) {
    echo 'problem occur try again ';
}
?>

                <tr>
                    <td colspan="2" align="center"><input type="submit" class="button shadow" value="Make Group" ></td>
                </tr>
            </table>
            <br>
            <h4>
                    <h3>Messages</h3>
                <?php
                if (isset($_GET['msg']))
                    echo $_GET['msg'];
                ?>
                        <br>
                <?php
                if (isset($_GET['msg1']))
                    echo $_GET['msg1'];
                ?>
                        <br>
                <?php
                if (isset($_GET['msg2']))
                    echo $_GET['msg2'];
                    ?>
                        <br>
                    <?php
                    if (isset($_GET['msg3']))
                        echo $_GET['msg3'];
                    ?> 
            </h4>
            <br>
            <br>
            <h3 style="color:#00b200">Make group or wait for joining under another leader</h3>
            <br>
            <h4>You can make group of at max 4 student including you</h4>
        </form>

    </body>
</html>
