<?php
    session_start();
    require_once "pdo.php";
    $salt='new_ton56*';
    if(isset($_POST['cancel']))
    {
        header("Location: home.php");
        return;
    }

    if(isset($_POST['co_name']) )
    {
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM Company WHERE Company_name = :cn');
        $stmt->execute(array(':cn' => $_POST['co_name']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row['COUNT(*)'] !== '0' )
        {
            $_SESSION['error'] = "This Company Or Owner already exists";
            header('Location: addcompany.php');
            return;
        }
        if($_POST['pass'] === $_POST['c_pass'])
        {
            if(strlen($_POST['pass'])<8)
            {
                $_SESSION['error'] = "Password must be atleast 8 character long";
                header('Location: addcompany.php');
                return;
            }
        }

        {
            $stmt = $pdo->prepare('INSERT INTO Company (Company_name,Domain,Owner,City,Country,Est) VALUES (:Company_Name,:Domain,:Owner,:City,:Country,:Establishment)');
			$stmt->execute(array(':Company_Name' => $_POST['co_name'], ':Domain' => $_POST['domain'], ':Owner' => $_POST['owner'], ':City' => $_POST['city'], ':Country' => $_POST['country'], ':Establishment' => $_POST['est']));


            $id = $pdo->lastInsertId();

            $_SESSION['success'] = "Company Added Successfully<br> Your company id is ".$id."<br> Please Remember it for future use.";

            if($_POST['pass'] === $_POST['c_pass'])
            {
                if(strlen($_POST['pass'])<8)
                {
                    $_SESSION['error'] = "Password must be atleast 8 character long";
                    header('Location: add_member.php');
                    return;
                }
                else
                {
                    $check = hash('md5', $salt.$_POST['pass']);
                    $stmt = $pdo->prepare('INSERT INTO Member (id, Company_id, Name, DOB, Email, Address, Phone, Password ,Department_id, Leader_id, Role_id) VALUES (:id, :cid, :n, :dob, :em, :add,:ph, :pass, :did, :lid, :rid)');
                    $stmt->execute(array(':id' => $_POST['id'], ':cid' => $id, ':n' => $_POST['name'], ':dob' => $_POST['dob'], ':em' => $_POST['email'], ':add' => $_POST['address'], ':ph' => $_POST['contact_no'], ':pass' => $check, ':did' => $_POST['department'], ':lid' => $_POST['leader'], ':rid' => $_POST['role']));

                    header('Location: index.php');
                    return;
                }
            }
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
        <h1>ADD COMPANY</h1>
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
        <form method="POST" action="addcompany.php">

        <div class="input-group">
        <span class="input-group-addon">Company Name </span>
        <input type="text" name="co_name" required class="form-control" placeholder="Company_Name" id="depname" onchange="Names('depname')" required> </div><br/>

		<div class="input-group">
        <span class="input-group-addon">Domain </span>
        <input type="text" name="domain" required class="form-control" placeholder="Domain" id="depname" onchange="Names('depname')" required> </div><br/>

		<div class="input-group">
        <span class="input-group-addon">Owner </span>
        <input type="text" name="owner" required class="form-control" placeholder="Owner" id="depname" onchange="Names('depname')" required> </div><br/>

		<div class="input-group">
        <span class="input-group-addon">City </span>
        <input type="text" name="city" required class="form-control" placeholder="City" id="depname" onchange="Names('depname')" required> </div><br/>

		<div class="input-group">
        <span class="input-group-addon">Country </span>
        <input type="text" name="country" required class="form-control" placeholder="Country" id="depname" onchange="Names('depname')" required> </div><br/>

		<div class="input-group">
        <span class="input-group-addon">Establishment </span>
        <input type="text" name="est" required class="form-control" placeholder="Establishment" id="depname" onchange="Names('depname')" required> </div><br/>

        <hr>
        <h3>Company Owner Details</h3>
        <div class="input-group">
        <span class="input-group-addon">ID</span>
        <input type="text" name="id" required="" class="form-control" placeholder="Enter ID" id="Mid" onchange="labs('Mid')"> </div><br/>

        <div class="input-group">
        <span class="input-group-addon">Name</span>
        <input type="text" name="name" required="" class="form-control" id="name" onchange="Names('fname')" placeholder="Name"> </div><br/>

        <div class="input-group">
        <span class="input-group-addon">Date Of Birth</span>
        <input type="date" name="dob" required="" class="form-control"> </div><br/>

        <div class="input-group">
        <span class="input-group-addon">Email</span>
        <input type="email" name="email" required="" class="form-control" placeholder="xyz@abc.com"> </div><br/>

        <div class="input-group">
        <span class="input-group-addon">Address</span>
        <input type="text" name="address" required="" class="form-control"> </div><br/>

        <div class="input-group">
          <span class="input-group-addon">Contact No.</span>
          <input type="text" name="contact_no" class="form-control" required placeholder="10 digit number" id="cnct" onchange="contact('cnct')"> </div><br/>

          <div class="input-group">
          <span class="input-group-addon">Department</span>
          <select id="drop-other" name="department" class="form-control" onchange="Device();">
              <?php

                  $qr=$pdo->prepare("SELECT Name,Department_id from Department where Company_id= :cid");
                  $qr->execute(array(':cid' => $_SESSION['cid']));
                  while($rowx=$qr->fetch(PDO::FETCH_ASSOC))
                  {
                      echo '<option value ='.$rowx[Department_id].'>';
                      echo ($rowx['Name']);
                      echo '</option>';
                  }
               ?>
       </select>
        </div></br>


          <div class="input-group">
          <span class="input-group-addon">Leader</span>
          <select id="drop-other" name="leader" class="form-control" onchange="Device();" >
              <?php

                  $qr=$pdo->prepare("SELECT Name,Member_id from Member where Company_id = :cid");
                  $qr->execute(array(':cid' => $_SESSION['cid']));
                  while($rowx=$qr->fetch(PDO::FETCH_ASSOC))
                  {
                      echo '<option value ='.$rowx[Member_id].'>';
                      echo ($rowx['Name']);
                      echo '</option>';
                  }
               ?>
       </select>
        </div></br>

          <div class="input-group">
          <span class="input-group-addon">Role</span>
          <select id="drop-other" name="role" class="form-control" onchange="Device();" >
              <?php

                  $qr=$pdo->prepare("SELECT Role_id,Role_name from Role where Company_id = :cid");
                  $qr->execute(array(':cid' => $_SESSION['cid']));
                  while($rowx=$qr->fetch(PDO::FETCH_ASSOC))
                  {
                      echo '<option value ='.$rowx[Role_id].'>';
                      echo ($rowx['Role_name']);
                      echo '</option>';
                  }
               ?>
       </select>
        </div></br>

        <div class="input-group">
        <span class="input-group-addon">Password</span>
        <input type="password" name="pass" required="" class="form-control" placeholder="min. 8 characters" id="npswrd" onchange="newp('npswrd')"> </div><br/>

        <div class="input-group">
        <span class="input-group-addon">Confirm Password</span>
        <input type="password" required="" name="c_pass" class="form-control" placeholder="min. 8 characters" id="cpswrd" onchange="conp('cpswrd')"> </div><br/>

        <input type="submit" value="Add Company" name="add_co"class="btn btn-info">
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
