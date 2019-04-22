<!-- Sidebar Holder -->
<nav id="sidebar">
    <div class="sidebar-header">
        <a href="home.php"><h3>PROVE</h3></a>
    </div>

    <ul class="list-unstyled components">
        <p>Menu</p>
        <li>
            <a href="score.php">View Leader Board</a>
        </li>
        <li class="active">
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Member</a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li><a href="add_member.php">Add Member</a></li>
                <li><a href="view_member.php">View Members</a></li>
            </ul>
        </li>
        <li class="">
            <a href="#machinemenu" data-toggle="collapse" aria-expanded="false">Department</a>
            <ul class="collapse list-unstyled" id="machinemenu">
                <li><a href="adddep.php">Add Department</a></li>
                <li><a href="viewdep.php">View Departments</a></li>
            </ul>
        </li>

        <li class="">
            <a href="#devicemenu" data-toggle="collapse" aria-expanded="false">Role</a>
            <ul class="collapse list-unstyled" id="devicemenu">
                <li><a href="addrole.php">Add Role</a></li>
                <li><a href="viewrole.php">View Roles</a></li>
            </ul>
        </li>

        <li class="">
            <a href="#specmenu" data-toggle="collapse" aria-expanded="false">Task</a>
            <ul class="collapse list-unstyled" id="specmenu">
                <li><a href="addtask.php">Create Task</a></li>
                <li><a href="home.php">View Tasks</a></li>
            </ul>
        </li>

        <li class="">
            <a href="#contactmenu" data-toggle="collapse" aria-expanded="false">Contact</a>
            <ul class="collapse list-unstyled" id="contactmenu">
                <li><a href="#">mohitagl1998@gmail.com</a></li>
                <li><a href="#">krishlalwani1@gmail.com</a></li>

            </ul>

        <hr>
        <li>
            <a href="logout.php">Logout</a>
        </li>
        <hr>
    <li class="">
            <a href="#developer">Developed By:</a>
            <ul class="list-unstyled" id="contactmenu">
                <li><a href="#">Krish Lalwani</a></li>
                <li><a href="#">Mohit Agrawal</a></li>
                <li><a href="#">Nitish Sainani</a></li>
            </ul>
    </li>
    <hr>
    </ul>
</nav>
<div class="container" id="content">
<div class="page-header">
<button type="button" id="sidebarCollapse" class="navbar-btn">
<span></span>
<span></span>
<span></span>
</button>
