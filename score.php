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
	<script src="jquery-3.3.1.min.js" type="text/javascript"></script>
    <meta name="viewport" content="width = device-width, initial-scale = 1">

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" href="style5.css">
	<script>
		$(document).ready(function(){
			$("#dailybt").click(function(){
				$("#daily").show();
				$("#weekly").hide();
				$("#monthly").hide();
				$("#over").hide();
			});
			$("#weeklybt").click(function(){
				$("#daily").hide();
				$("#weekly").show();
				$("#monthly").hide();
				$("#over").hide();
			});
			$("#monthlybt").click(function(){
				$("#daily").hide();
				$("#weekly").hide();
				$("#monthly").show();
				$("#over").hide();
			});
			$("#overbt").click(function(){
				$("#daily").hide();
				$("#weekly").hide();
				$("#monthly").hide();
				$("#over").show();
			});
		});
	</script>
</head>
<body>
                  <div class="wrapper">
       <?php if (isset($_SESSION['id'])) include "navbar.php";
                else include "navbar_tech.php";?>

    <div class="container-fluid row" id="container">
	<br>
	<input type="submit" value="Daily" name="daily" id="dailybt" class="btn btn-info">
	&nbsp&nbsp&nbsp&nbsp&nbsp<input type="submit" value="Weekly" name="week" id="weeklybt" class="btn btn-info">
	&nbsp&nbsp&nbsp&nbsp&nbsp<input type="submit" value="Monthly" name="month" id="monthlybt" class="btn btn-info">
	&nbsp&nbsp&nbsp&nbsp&nbsp<input type="submit" value="Overall" name="over" id="overbt" class="btn btn-info">
	<div class="container-fluid row" id="daily">
	<div class="page-header">
	<h1>Daily Leaderboard</h1>
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
		$i=1;
        $stmtcnt = $pdo->query("SELECT COUNT(*) FROM Score ");
        $row = $stmtcnt->fetch(PDO::FETCH_ASSOC);
        if($row['COUNT(*)']!=='0')
        {
			$date = date('Y-m-d');
            $stmtread = $pdo->prepare("SELECT * FROM Score WHERE Company_id=:cid AND Time=:time");
            $stmtread->execute(array(':cid' => $_SESSION['cid'],':time'=>$date));
			$arr=[];
            echo ("<table class=\"table table-striped\">
                <tr> <th>Rank</th><th>Name</th><th>Score</th></tr>");
            while ( $row = $stmtread->fetch(PDO::FETCH_ASSOC) )
            {
				$flag=1;
				$co=count($arr);
				if(count($arr)==0)
				{
					$arr[0]=$row['Member_id'];
					$flag=0;
				}
				else
				{
					for($j=0;$j<$co;$j++)
					{
						if($arr[$j]==$row['Member_id'])
						{
							$flag=0;
							break;
						}
					}
					if($flag==1)
					{
						$arr[$i]=$row['Member_id'];
						$i++;
					}
				}
            }
			for($j=0;$j<count($arr);$j++)
			{
				$qr=$pdo->prepare("SELECT * from Member where Member_id= :mid");
                $qr->execute(array(':mid' => $arr[$j]));
                $rowtmp=$qr->fetch(PDO::FETCH_ASSOC);
                $mid=$rowtmp['Name'];
				$qr1=$pdo->prepare("SELECT sum(Points) as result from Score where Member_id= :mid AND Time=:time");
                $qr1->execute(array(':mid' => $arr[$j],':time'=>$date));
				$row1=$qr1->fetch(PDO::FETCH_ASSOC);
				$sum=$row1['result'];
                echo ("<tr>");
                echo ("<td>");
                echo ($j+1);
                echo ("</td>");
                echo ("<td>");
                echo(htmlentities($mid));
                echo ("</td>");
                echo ("<td>");
                echo(htmlentities($sum));
                echo ("</td>");
			}
            echo('</table>');
        }
    ?>
	</div>
	<br>
	<div class="container-fluid row" id="weekly" style="display:none;">
    <div class="page-header">
    <h1>Weekly Leaderboard</h1>
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
		$i=1;
        $stmtcnt = $pdo->query("SELECT COUNT(*) FROM Score ");
        $row = $stmtcnt->fetch(PDO::FETCH_ASSOC);
        if($row['COUNT(*)']!=='0')
        {
            $da2 = date('Y-m-d');
            $da1 = date('Y-m-d',strtotime($da2.'-7 day'));
			//$da3 = date('Y-m-d',strtotime($da2.'day'));
            $stmtread = $pdo->prepare("SELECT * FROM Score WHERE Company_id=:cid AND Time between :time AND :time1");
            $stmtread->execute(array(':cid' => $_SESSION['cid'],':time'=>$da1,':time1'=>$da2));
			$arr=[];
            echo ("<table class=\"table table-striped\">
                <tr> <th>Rank</th><th>Name</th><th>Score</th></tr>");
            while ( $row = $stmtread->fetch(PDO::FETCH_ASSOC) )
            {
				$flag=1;
				$co=count($arr);
				if(count($arr)==0)
				{
					$arr[0]=$row['Member_id'];
					$flag=0;
				}
				else
				{
					for($j=0;$j<$co;$j++)
					{
						if($arr[$j]==$row['Member_id'])
						{
							$flag=0;
							break;
						}
					}
					if($flag==1)
					{
						$arr[$i]=$row['Member_id'];
						$i++;
					}
				}
            }
			for($j=0;$j<count($arr);$j++)
			{
				$qr=$pdo->prepare("SELECT * from Member where Member_id= :mid");
                $qr->execute(array(':mid' => $arr[$j]));
                $rowtmp=$qr->fetch(PDO::FETCH_ASSOC);
                $mid=$rowtmp['Name'];
				$qr1=$pdo->prepare("SELECT sum(Points) as result from Score where Member_id= :mid AND Time between :time AND :time1");
                $qr1->execute(array(':mid' => $arr[$j],':time'=>$da1,':time1'=>$da2));
				$row1=$qr1->fetch(PDO::FETCH_ASSOC);
				$sum=$row1['result'];
                echo ("<tr>");
                echo ("<td>");
                echo ($j+1);
                echo ("</td>");
                echo ("<td>");
                echo(htmlentities($mid));
                echo ("</td>");
                echo ("<td>");
                echo(htmlentities($sum));
                echo ("</td>");
			}
            echo('</table>');
        }
    ?>

    </div>
</div>
<div class="container-fluid row" id="monthly" style="display:none;">
	<div class="page-header">
	<h1>Monthly Leaderboard</h1>
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
		$i=1;
        $stmtcnt = $pdo->query("SELECT COUNT(*) FROM Score ");
        $row = $stmtcnt->fetch(PDO::FETCH_ASSOC);
        if($row['COUNT(*)']!=='0')
        {
			$date = date('Y-m-d',strtotime($date.'-1 month'));
			$date1 = date('Y-m-d');
			//$date2 = date('Y-m-d',strtotime($date1.'-1 day'));
            $stmtread = $pdo->prepare("SELECT * FROM Score WHERE Company_id=:cid AND Time between :time AND :time1");
            $stmtread->execute(array(':cid' => $_SESSION['cid'],':time'=>$date,':time1'=>$date1));
			$arr=[];
            echo ("<table class=\"table table-striped\">
                <tr> <th>Rank</th><th>Name</th><th>Score</th></tr>");
            while ( $row = $stmtread->fetch(PDO::FETCH_ASSOC) )
            {
				$flag=1;
				$co=count($arr);
				if(count($arr)==0)
				{
					$arr[0]=$row['Member_id'];
					$flag=0;
				}
				else
				{
					for($j=0;$j<$co;$j++)
					{
						if($arr[$j]==$row['Member_id'])
						{
							$flag=0;
							break;
						}
					}
					if($flag==1)
					{
						$arr[$i]=$row['Member_id'];
						$i++;
					}
				}
            }
			for($j=0;$j<count($arr);$j++)
			{
				$qr=$pdo->prepare("SELECT * from Member where Member_id= :mid");
                $qr->execute(array(':mid' => $arr[$j]));
                $rowtmp=$qr->fetch(PDO::FETCH_ASSOC);
                $mid=$rowtmp['Name'];
				$qr1=$pdo->prepare("SELECT sum(Points) as result from Score where Member_id= :mid AND Time between :time AND :time1");
                $qr1->execute(array(':mid' => $arr[$j],':time'=>$date,':time1'=>$date1));
				$row1=$qr1->fetch(PDO::FETCH_ASSOC);
				$sum=$row1['result'];
                echo ("<tr>");
                echo ("<td>");
                echo ($j+1);
                echo ("</td>");
                echo ("<td>");
                echo(htmlentities($mid));
                echo ("</td>");
                echo ("<td>");
                echo(htmlentities($sum));
                echo ("</td>");
			}
            echo('</table>');
        }
    ?>
	</div>
	<div class="container-fluid row" id="over" style="display:none;">
	<div class="page-header">
	<h1>Overall Leaderboard</h1>
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
		$i=1;
        $stmtcnt = $pdo->query("SELECT COUNT(*) FROM Score ");
        $row = $stmtcnt->fetch(PDO::FETCH_ASSOC);
        if($row['COUNT(*)']!=='0')
        {
            $stmtread = $pdo->prepare("SELECT * FROM Score WHERE Company_id=:cid");
            $stmtread->execute(array(':cid' => $_SESSION['cid']));
			$arr=[];
            echo ("<table class=\"table table-striped\">
                <tr> <th>Rank</th><th>Name</th><th>Score</th></tr>");
            while ( $row = $stmtread->fetch(PDO::FETCH_ASSOC) )
            {
				$flag=1;
				$co=count($arr);
				if(count($arr)==0)
				{
					$arr[0]=$row['Member_id'];
					$flag=0;
				}
				else
				{
					for($j=0;$j<$co;$j++)
					{
						if($arr[$j]==$row['Member_id'])
						{
							$flag=0;
							break;
						}
					}
					if($flag==1)
					{
						$arr[$i]=$row['Member_id'];
						$i++;
					}
				}
            }
			for($j=0;$j<count($arr);$j++)
			{
				$qr=$pdo->prepare("SELECT * from Member where Member_id= :mid");
                $qr->execute(array(':mid' => $arr[$j]));
                $rowtmp=$qr->fetch(PDO::FETCH_ASSOC);
                $mid=$rowtmp['Name'];
				$qr1=$pdo->prepare("SELECT sum(Points) as result from Score where Member_id= :mid");
                $qr1->execute(array(':mid' => $arr[$j]));
				$row1=$qr1->fetch(PDO::FETCH_ASSOC);
				$sum=$row1['result'];
                echo ("<tr>");
                echo ("<td>");
                echo ($j+1);
                echo ("</td>");
                echo ("<td>");
                echo(htmlentities($mid));
                echo ("</td>");
                echo ("<td>");
                echo(htmlentities($sum));
                echo ("</td>");
			}
            echo('</table>');
        }
    ?>
	</div>
	<br>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>
