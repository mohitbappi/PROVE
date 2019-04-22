<?php
    session_start();
    if( !isset($_SESSION['id']) )
    {
        die('ACCESS DENIED');
    }	
    require_once "pdo.php";
?>
<html>
<head>
    <title>PROVE</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel = "icon" type = "image/png" href="favi.ico">
    <meta name="viewport" content="width = device-width, initial-scale = 1">

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" href="style5.css">
</head>
<body>
                  <div class="wrapper">
       <?php if (isset($_SESSION['id'])) include "navbar.php";
                else include "navbar_tech.php";?>

    <div class="container-fluid row" id="container">
	<div class="page-header">
	<h1>TASK TO BE DONE</h1>
    </div>
    <?php

        if ( isset($_SESSION['success']))
        {
            echo('<p style="color: green;">'.$_SESSION['success']."</p>\n");
                unset($_SESSION['success']);
        }
        if ( isset($_SESSION['error']))
        {
            echo('<p style="color: red;">'.$_SESSION['error']."</p>\n");
            unset($_SESSION['error']);
        }
        //echo('<p><a href="logout.php">Logout</a></p>');
        $stmtcnt = $pdo->query("SELECT COUNT(*) FROM Task ");
        $row = $stmtcnt->fetch(PDO::FETCH_ASSOC);
		$stmtcnt2 = $pdo->query("SELECT * FROM Task ");
        $row2 = $stmtcnt2->fetch(PDO::FETCH_ASSOC);
		$st=$row2['Status'];		
        if($row['COUNT(*)']!=='0')
        {
            $i=1;
            $stmtread = $pdo->prepare("SELECT * FROM Task WHERE Member_id_assigned=:mid AND status=:s");
            $stmtread->execute(array(':mid' => $_SESSION['id'],':s'=>0));		
            echo ("<table class=\"table table-striped\">
                <tr> <th>S.no.</th><th>Name</th><th>Name of Task</th><th>Description</th><th>Points</th><th>Leader</th><th>Action</th> </tr>");
            while ( $row = $stmtread->fetch(PDO::FETCH_ASSOC) )
            {
				$qr=$pdo->prepare("SELECT * from Member where Member_id = :mid");
                $qr->execute(array(':mid' => $row['Member_id_assigned']));
                $rowtmp=$qr->fetch(PDO::FETCH_ASSOC);
                $rid=$rowtmp['Role_id'];
				$qr1=$pdo->prepare("SELECT * from Role where Role_id = :rid");
                $qr1->execute(array(':rid' => $rid));
				$rowtmp1=$qr1->fetch(PDO::FETCH_ASSOC);
				$ridn=$rowtmp1['Role_name'];

                $qr=$pdo->prepare("SELECT * from Member where Member_id= :did");
                $qr->execute(array(':did' => $row['Member_id_assigned']));
                $rowtmp=$qr->fetch(PDO::FETCH_ASSOC);
                $did=$rowtmp['Department_id'];
				$qr1=$pdo->prepare("SELECT * from Department where Department_id= :did");
                $qr1->execute(array(':did' =>$did));
                $rowtmp1=$qr1->fetch(PDO::FETCH_ASSOC);
                $did=$rowtmp1['Name'];

                $qr=$pdo->prepare("SELECT * from Member where Member_id = :mid");
                $qr->execute(array(':mid' => $row['Member_id_created']));
                $rowtmp=$qr->fetch(PDO::FETCH_ASSOC);
                $lid=$rowtmp['Name'];
								
				$qr=$pdo->prepare("SELECT * from Member where Member_id= :mid");
                $qr->execute(array(':mid' => $row['Member_id_assigned']));
                $rowtmp=$qr->fetch(PDO::FETCH_ASSOC);
                $mid=$rowtmp['Name'];

                echo ("<tr>");
                echo ("<td>");
                echo($i);
                echo ("</td>");
                echo ("<td>");
                echo(htmlentities($mid));
                echo ("</td>");
                echo ("<td>");
                echo(htmlentities($row['Name']));
                echo ("</td>");
                echo ("<td>");
                echo(htmlentities($row['Description']));
                echo ("</td>");
                echo ("<td>");
                echo(htmlentities($row['Points']));                
                echo ("</td>");
                echo ("<td>");
                echo(htmlentities($lid));
                echo ("</td>");
                echo ("<td>");
                echo('<a style="color:red;" href="confirm_task.php?mid='.$row['Task_id'].'">Done</a>');
                echo ("</td>");
                $i++;
            }
            echo('</table>');
        }
    ?>
	<br>
    <div class="page-header">
    <h1>TASK ASSIGNED TO OTHERS</h1>
    </div>
    <?php

        if ( isset($_SESSION['success']))
        {
            echo('<p style="color: green;">'.$_SESSION['success']."</p>\n");
                unset($_SESSION['success']);
        }
        if ( isset($_SESSION['error']))
        {
            echo('<p style="color: red;">'.$_SESSION['error']."</p>\n");
            unset($_SESSION['error']);
        }
        //echo('<p><a href="logout.php">Logout</a></p>');
        $stmtcnt = $pdo->query("SELECT COUNT(*) FROM Task ");
        $row = $stmtcnt->fetch(PDO::FETCH_ASSOC);
		$stmtcnt1 = $pdo->query("SELECT * FROM Task ");
        $row1 = $stmtcnt1->fetch(PDO::FETCH_ASSOC);

        if($row['COUNT(*)']!=='0')
        {
            $i=1;
            $stmtread = $pdo->prepare("SELECT * FROM Task WHERE Member_id_created=:mid AND status=:s");
            $stmtread->execute(array(':mid' => $_SESSION['id'],':s'=>1));		
            echo ("<table class=\"table table-striped\">
                <tr> <th>S.no.</th><th>Name</th><th>Name of Task</th><th>Description</th><th>Points</th><th>Department</th><th>Leader</th><th>Action</th> </tr>");
            while ( $row = $stmtread->fetch(PDO::FETCH_ASSOC) )
            {
				$qr=$pdo->prepare("SELECT * from Member where Member_id = :mid");
                $qr->execute(array(':mid' => $row['Member_id_assigned']));
                $rowtmp=$qr->fetch(PDO::FETCH_ASSOC);
                $rid=$rowtmp['Role_id'];
				$qr1=$pdo->prepare("SELECT * from Role where Role_id = :rid");
                $qr1->execute(array(':rid' => $rid));
				$rowtmp1=$qr1->fetch(PDO::FETCH_ASSOC);
				$ridn=$rowtmp1['Role_name'];

                $qr=$pdo->prepare("SELECT * from Member where Member_id= :did");
                $qr->execute(array(':did' => $row['Member_id_assigned']));
                $rowtmp=$qr->fetch(PDO::FETCH_ASSOC);
                $did=$rowtmp['Department_id'];
				$qr1=$pdo->prepare("SELECT * from Department where Department_id= :did");
                $qr1->execute(array(':did' =>$did));
                $rowtmp1=$qr1->fetch(PDO::FETCH_ASSOC);
                $did=$rowtmp1['Name'];

                $qr=$pdo->prepare("SELECT * from Member where Member_id = :mid");
                $qr->execute(array(':mid' => $row['Member_id_created']));
                $rowtmp=$qr->fetch(PDO::FETCH_ASSOC);
                $lid=$rowtmp['Name'];
								
				$qr=$pdo->prepare("SELECT * from Member where Member_id= :mid");
                $qr->execute(array(':mid' => $row['Member_id_assigned']));
                $rowtmp=$qr->fetch(PDO::FETCH_ASSOC);
                $mid=$rowtmp['Name'];

                echo ("<tr>");
                echo ("<td>");
                echo($i);
                echo ("</td>");
                echo ("<td>");
                echo(htmlentities($mid));                
                echo ("</td>");
                echo ("<td>");
                echo(htmlentities($row['Name']));
                echo ("</td>");
                echo ("<td>");
                echo(htmlentities($row['Description']));
                echo ("</td>");
                echo ("<td>");
                echo(htmlentities($row['Points']));
                echo ("</td>");
                echo ("<td>");                
                echo(htmlentities($did));
                echo ("</td>");
                echo ("<td>");
                echo(htmlentities($lid));
                echo ("</td>");
                echo ("<td>");
                echo('<a style="color:red;" href="mark.php?mid='.$row['Task_id'].'&point='.$row['Points'].'&mid1='.$row['Member_id_assigned'].'">Mark Completed</a>');
                echo ("</td>");
                $i++;
            }
            echo('</table>');
        }
    ?>

    </div>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>
