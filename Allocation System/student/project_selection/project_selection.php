

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
        <h1 align="center">Project Allocation</h1>
        <h3>Project Selection</h3>
        <h3 align="left"><a href="../index.php" class="back shadow"><= Back</a></h3>
        <h3 align="right">Id: <?php echo $_SESSION['student_id']; ?>  &emsp;       Name : <?php echo $_SESSION['student_name']; ?>&emsp;<a href="../student_logout.php" class="log_out shadow">Logout</a>&emsp;</h3>
        <table align="center">
            <tr>
                <th>PROJECTS AVAILABLE</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>PROJECTS SELECTED</th>
            </tr>
            <tr>
                <td><iframe src="other_project.php" height="500" width="350" ></iframe></td>
                <td></td>
                <td><iframe src="selected.php" height="500" width="500" ></iframe></td>
            </tr>
        </table>
    </body>
    <h3>
        <pre>
                                Please Refresh Page after Removing or Adding Project
        </pre>
    </h3>
    <h4><?php
    try{
                $sql='select * from allocation_process where id=1';
                $query=$dbhandler->query($sql);
                $r=$query->fetch();
   
                if($r['process']==4 || $r['process']==6){
                        echo 'Some of project may be removed from your previously selected list because they are selected by other';
                }
    }
 catch (Exception $ex){
     
 }
 ?>
    </h4>
</html>
