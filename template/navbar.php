<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/">Firmstep Developer Test</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <?php
      if(isset($_SESSION['userInfo'])){
        $string = '<li class="navbar-text">'.$_SESSION['userInfo']['userName'].'</li>';
        $string .= '<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
      }
      else
        $string = '<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
      
      echo $string;
      ?>
      
    </ul>
  </div>
</nav>