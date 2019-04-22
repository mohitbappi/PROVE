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
    <h1>MEMBERS</h1>
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
        $stmtcnt = $pdo->query("SELECT COUNT(*) FROM Member ");
        $row = $stmtcnt->fetch(PDO::FETCH_ASSOC);

        if($row['COUNT(*)']!=='0')
        {
            $i=1;
            $stmtread = $pdo->prepare("SELECT * FROM Member WHERE Company_id=:cid ORDER BY id");
            $stmtread->execute(array(':cid' => $_SESSION['cid']));
            echo ("<table class=\"table table-striped\">
                <tr> <th>S.no.</th><th>I.D.</th><th>Name</th><th>Role</th><th>D.O.B.</th><th>Email</th><th>Address</th><th>Phone</th><th>Department</th><th>Leader</th><th>Action</th> </tr>");
            while ( $row = $stmtread->fetch(PDO::FETCH_ASSOC) )
            {
                $qr=$pdo->prepare("SELECT * from Role where Role_id = :rid");
                $qr->execute(array(':rid' => $row['Role_id']));
                $rowtmp=$qr->fetch(PDO::FETCH_ASSOC);
                $rid=$rowtmp['Role_name'];

                $qr=$pdo->prepare("SELECT * from Department where Department_id = :did");
                $qr->execute(array(':did' => $row['Department_id']));
                $rowtmp=$qr->fetch(PDO::FETCH_ASSOC);
                $did=$rowtmp['Name'];

                $qr=$pdo->prepare("SELECT * from Member where Member_id = :mid");
                $qr->execute(array(':mid' => $row['Leader_id']));
                $rowtmp=$qr->fetch(PDO::FETCH_ASSOC);
                $lid=$rowtmp['Name'];

                echo ("<tr>");
                echo ("<td>");
                echo($i);
                echo("</td>");
                echo ("<td>");
                echo(htmlentities($row['id']));
                echo ("</td>");
                echo ("<td>");
                echo(htmlentities($row['Name']));
                echo ("</td>");
                echo ("<td>");
                echo(htmlentities($rid));
                echo ("</td>");
                echo ("<td>");
                echo(htmlentities($row['DOB']));
                echo ("</td>");
                echo ("<td>");
                echo(htmlentities($row['Email']));
                echo ("</td>");
                echo ("<td>");
                echo(htmlentities($row['Address']));
                echo ("</td>");
                echo ("<td>");
                echo(htmlentities($row['Phone']));
                echo ("</td>");
                echo ("<td>");
                echo(htmlentities($did));
                echo ("</td>");
                echo ("<td>");
                echo(htmlentities($lid));
                echo ("</td>");
                echo ("<td>");
                echo('<a style="color:red;" href="delete_member.php?mid='.$row['id'].'">Delete</a>');
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
