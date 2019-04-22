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

    if(isset($_POST['spec']) )
    {
		if(isset($_POST['cm']))
			$cm=1;
		else
			$cm=0;
		if(isset($_POST['ct']))
			$ct=1;
		else
			$ct=0;
		if(isset($_POST['cd']))
			$cd=1;
		else
			$cd=0;
            $stmt = $pdo->prepare('SELECT COUNT(*) FROM Role WHERE Role_name = :Role_Name AND Company_id=:cid');
            $stmt->execute(array(':Role_Name' => $_POST['r_name'],':cid'=>$_SESSION['cid']));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row['COUNT(*)'] !== '0')
            {
                $_SESSION['error'] = "This Role already exists";
                header('Location: addrole.php');
                return;
            }
            else
            {
                $stmt = $pdo->prepare('INSERT INTO Role (Role_name,Create_member,Create_Task,Create_Department,Company_id) VALUES (:Role_Name,:cm,:ct,:cd,:cid)');
                $stmt->execute(array(':Role_Name' => $_POST['r_name'],':cm' =>$cm,':ct' =>$ct,':cd' =>$cd,':cid'=>$_SESSION['cid']));
                $_SESSION['success'] = "Role Added Successfully";
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
        <h1>ADD SPECIFICATION</h1>
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
        <form method="POST" action="addrole.php">

        <div class="input-group">
        <span class="input-group-addon">Role Name </span>
        <input type="text" name="r_name" required class="form-control" placeholder="Role_Name" id="depname" onchange="Names('depname')" required> </div><br/>

		<div class="input-group">
        <div class="page-header">
        <h3>Permissions</h3>
        </div>
        </div>
		&nbsp&nbsp&nbsp<input type="checkbox" name="cm">Create Member<br>
		&nbsp&nbsp&nbsp<input type="checkbox" name="ct">Create Task<br>
		&nbsp&nbsp&nbsp<input type="checkbox" name="cd">Create Department<br>
		<br>

    <div class="input-group">
        <input type="submit" value="Add Role" name="spec" class="btn btn-info">
		&nbsp<a class ="link-no-format" href="home.php"><div class="btn btn-my">Cancel</div></a>
        </form>

    </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>
