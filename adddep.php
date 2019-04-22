<?php
    session_start();
    require_once "pdo.php";
    if( !isset($_SESSION['id']) )
    {
        die('ACCESS DENIED');
    }
    if(isset($_POST['cancel']))
    {
        header("Location: home.php");
        return;
    }

    if(isset($_POST['add_co']) )
    {
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM Department WHERE Name = :dn and Company_id = :cid');
        $stmt->execute(array(':dn' => $_POST['de_name'], ':cid' => $_SESSION['cid']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row['COUNT(*)'] !== '0')
        {
            $_SESSION['error'] = "This Department already exists";
            header('Location: adddep.php');
            return;
        }
        else
        {
            $stmt = $pdo->prepare('INSERT INTO Department (Name,Company_id) VALUES (:Department_Name,:cid)');
			$stmt->execute(array(':Department_Name' => $_POST['de_name'],':cid'=>$_SESSION['cid']));
            $_SESSION['success'] = "Department Added Successfully";
            header('Location: home.php');
            return;
        }
    }
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
    <style>
        .input-group-addon {
        min-width:150px;
        text-align:left;
    }
    </style>
</head>
<body>
    <div class="wrapper">

        <?php if (isset($_SESSION['id'])) include "navbar.php";
                    else include "navbar_index.php"?>
      <div class="container-fluid row" id="content">
        <div class="page-header">
        <h1>ADD Department</h1>
        </div>
        <div id="error" style="color: red; margin-left: 90px; margin-bottom: 20px;">
        </div>
        <?php
        if ( isset($_SESSION['error']) )
        {
            echo('<p style="color: red;">'.$_SESSION['error']."</p>\n");
            unset($_SESSION['error']);
        }
        if ( isset($_SESSION['success']))
        {
            echo('<p style="color: green;">'.$_SESSION['success']."</p>\n");
                unset($_SESSION['success']);
        }
        ?>
        <div class="col-xs-5">
        <form method="POST" action="adddep.php">

        <div class="input-group">
        <span class="input-group-addon">Department Name </span>
        <input type="text" name="de_name" required class="form-control" placeholder="Department_Name" id="depname" onchange="Names('depname')" required> </div><br/>


        <input type="submit" value="Add Department" name="add_co" class="btn btn-info">
        <a class ="link-no-format" href="home.php"><div class="btn btn-my">Cancel</div></a>
        </form>

    </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>
