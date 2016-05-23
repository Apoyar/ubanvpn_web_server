<div style='height: 20vh;'></div>
<div class='row'>
  <div class='col-xs-12 col-md-6 col-md-offset-3'>
    <center><img src='logo.png' width='300'></center><br><br>
    <form action='submit.php' method='POST'>
      <div class="form-group">
        <label for='user' class='sr-only'>Username:</label>
        <input class="form-control" id='user' type='text' name='user' placeholder="Username" required>
      </div><br>
      <div class="form-group">
        <label for='pass' class='sr-only'>Password:</label>
        <input class="form-control" id='pass' type='password' name='pass' placeholder="Password" required>
      </div>
      <br>
      <button class='btn btn-default btn-block' type='submit'>Log-in</button><br>
      <?php
        if($_SESSION['flash']){
          echo '
          <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Warning!</strong> '.$_SESSION['flash'].'</div>';
        }
      ?>
      <center><a href='#'>I bought this device at a retailer and don't have a subscription.</a></center>
    </form>
  </div>
</div>
