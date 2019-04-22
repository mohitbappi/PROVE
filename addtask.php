<?php
    session_start();
    require_once "pdo.php";
   if( !isset($_SESSION['id']))
    {
        die('ACCESS DENIED');
    }
    if(isset($_POST['cancel']))
    {
        header("Location: home.php");
        return;
    }
    if (isset($_POST['add']))
    {
		for($i=1; $i<=$_POST['nom']; $i++)
		{
			$stmt = $pdo->prepare('INSERT INTO Task
				(Name,Description,Points,Member_id_created,Status,Member_id_assigned)
				VALUES ( :name, :des, :point,:mid,:status,:mida)');
			$stmt->execute(array(
				':name' => $_POST['title'],
				':des' => $_POST['des'],
				':point' => $_POST['point'.$i],
				':mid' => $_SESSION['id'],
				':status' => 0,
				':mida' => $_POST['mid'.$i])
            );
		}
		$_SESSION['success']="Task added";
		header("Location:home.php");
		return;
    }
    else {
        $statement = $pdo->prepare("SELECT Member_id, Company_id, Name FROM Member where Company_id = :cid and Leader_id = :lid");
        $statement->execute(array(
            ':cid' => $_SESSION['cid'], ':lid' => $_SESSION['id']));
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
    }
?>

<html>
<head>
    <title>PROVE</title>
    <link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
    integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
    crossorigin="anonymous">

    <link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
    integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r"
    crossorigin="anonymous">

    <link rel="stylesheet"
    href="https://code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css">

    <script
    src="https://code.jquery.com/jquery-3.2.1.js"
    integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
    crossorigin="anonymous"></script>

    <script
    src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
    integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
    crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width = device-width, initial-scale = 1">
	<link rel="icon" type="image/png" href="favi.ico" />
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
	<div class="container-fluid row" id="container">
    <div class="page-header">
    <?php
    if ( isset($_SESSION['id']) )
    {
        echo "<h1>Create New Task";
        echo "</h1></div>\n";
    }
    if ( isset($_SESSION['error']))
    {
        echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
        unset($_SESSION['error']);
    }
    ?>

    <form method="post" action="addtask.php">
	<div  class="col-xs-7">
    <div class="input-group">
    <span class="input-group-addon">Title</span>
    <input type="text" name="title" size="60" class="form-control" required /> </div><br/>
	<div class="input-group">
	<span class="input-group-addon">Description</span>
    <textarea name="des" rows="8" cols="60" class="form-control" required></textarea> </div><br/>
    <div class="input-group">
    <span class="input-group-addon">Number of Members</span>
    <input type="number" name="nom" size="60" id="nom" class="form-control" required /> </div><br/>
    <input type="button" value="OK" name="OK" class="btn btn-info" onclick="createTabs()">
    <p>
    <div id="question_fields">
    </div>
    </p>
    <input type="submit" value="Add" name="add" class="btn btn-info">
    <input type="submit" name="cancel" value="Cancel" class="btn btn-info">
    </p>
    </form>
	</div>

<script>
countQue = 0;

function populateSelect(j) {
    // if(mem==0)
    {
        window.console && console.log('Document ready called 22');

         var json = <?php echo json_encode($json) ?>;
         var data = JSON.parse(json);
         window.console && console.log("cq "+j);
         var ele = document.getElementById('mid'+j);
         ele.innerHTML='';
         ele.innerHTML=ele.innerHTML+'<option value="">Select Member</option>';
                for (var i = 0; i < data.length; i++) {
                    // POPULATE SELECT ELEMENT WITH JSON.
                    ele.innerHTML = ele.innerHTML +
                        '<option value="' + data[i]['Member_id'] + '">' + data[i]['Name'] + '</option>';
                }
                // mem=1;
    }

}

function createTabs() {
    window.console && console.log('Document ready called 33');
    var cc=document.getElementById('nom');
    var c=cc.value;
    window.console && console.log(c);
    var i;
    for(i=1;i<=c;i++){
    $('#question_fields').append(
        '<div id="question'+i+'"> \
        <div class="input-group">\
<span class="input-group-addon">Member Id</span>\
<select name="mid'+i+'" id="mid'+i+'" class="form-control input-lg">\
</select>\
  </div></br>\
<div class="input-group">\
<span class="input-group-addon">Points</span>\
<input type="text" name="point'+i+'" size="60" class="form-control" required /> </div><br/>\
        \<br>\
        </div>');
        populateSelect(i);
}
}

</script>

</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
