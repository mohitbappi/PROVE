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
    if (isset($_POST['mem']))
    {

        $stmt = $pdo->prepare('SELECT COUNT(*) FROM Member WHERE id = :dn AND Company_id=:cid');
        $stmt->execute(array(':dn' => $_REQUEST['mid'],':cid'=>$_SESSION['cid']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row['COUNT(*)'] === '0')
        {
            $_SESSION['error'] = "This Member does not exist";
            //$_SESSION['success'] = "id=".$_REQUEST['mid']."Cid=".$_SESSION['cid'];
            header('Location: view_member.php');
            return;
        }
        else
        {
            $stmt = $pdo->prepare('DELETE FROM Member where id = :dn AND Company_id= :cid');
            $stmt->execute(array(':dn' => $_REQUEST['mid'],':cid'=>$_SESSION['cid']));
            $_SESSION['success'] = "Member Deleted Sucessfully";
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
	<link rel="icon" type="image/png" href="favi.ico" />
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
			<h1>REMOVE MEMBER</h1>
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

    <form method="POST" action="delete_member.php" class="col-xs-5">

    <input type="submit" value="Confirm" name="mem" class="btn btn-info">
    <input type="hidden" name="mid" value="<?= $_GET['mid'] ?>">
    <a class ="link-no-format" href="home.php"><div class="btn btn-my">Cancel</div></a>
    </form>

    </div>

    <script type="text/javascript" src="script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
