<?php include_once "infidel.php"; ?>
<link href='https://fonts.googleapis.com/css?family=Covered By Your Grace' rel='stylesheet'>
<style>
  #logo{
    font-family: 'Covered By Your Grace';
    font-size: 45px;
    padding: 0px;
  }
  body{
  font-size:30px;
  }
  .btn-primary{
  font-size: 25px;
  }

</style>
</head>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" id="logo" href="/home/find.php?">Teoh</a>

  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="/home/room_content_manager.php">room manager</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/home/store_content_manager.php">store manager</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/home/point_content_manager.php">point manager</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/home/store_me.php">input</a>
    </li>
    <li class="nav-item">
      <a class="nav-link btn btn-primary" href="/home/handler/logout.php">logout</a>
    </li>
    <!-- Dropdown -->
    <!-- <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Dropdown link
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="#">Link 1</a>
        <a class="dropdown-item" href="#">Link 2</a>
        <a class="dropdown-item" href="#">Link 3</a>
      </div>
    </li> -->
  </ul>
</nav>
