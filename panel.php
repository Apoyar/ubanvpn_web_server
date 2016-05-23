
<?php 
$taken_SSID=explode("\n", shell_exec('sudo /sbin/iwlist wlan0 scan | grep ESSID'));
?>
<center><img src='logo.png' width='300'></center><hr>
<div class='row'>
<div class='col-md-6'>
  <?php $auth=explode("\n", file_get_contents('/etc/openvpn/auth.txt'));?>
  <center>
  <h3>Your account:</h3>
  <form method='post' action='submit.php'>
  <input type='hidden' name='user' value='user0'>
  <input type='hidden' name='pass' value='password0'>
  <br>
  <table class='table'>
  <tr>
  <td><b>User name: </b></td><td><?php echo $auth[0];?></td>
  </tr>
  <tr>
  <td><b>Expires on: </b></td><td>02/03/2017</td>
  </tr>
  </table>
  <button type='submit' class='btn btn-default btn-block'>Logout</button><br>
  <a class='btn btn-warning btn-block'>Account management/billing</a>
  </form>
  </center>
</div>
<div class='col-md-6'>
  <?php $device=explode("\n", file_get_contents('/etc/hostapd/hostapd.conf'));?>
  <center>
  <form method='post' class='form-group' action='device.php'>
  <h3>Device settings:</h3><br> 
  <table class='table'>
  <tr>
  <td><b>SSID: </b></td><td><input type='text' class='form-control' name='ssid' value='<?php echo str_replace('ssid=', '', $device[1]);?>' pattern=".{8,}"   required title="8 characters minimum"></td>
  </tr>
  <tr>
  <td><b>Password: </b></td><td><input type='text' class='form-control' name='wifi_pass' value='<?php echo str_replace('wpa_passphrase=', '', $device[7]);?>' pattern=".{8,}"   required title="8 characters minimum"></td>
  </tr>
  </table>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#myModal">View taken SSIDs</button>

  <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Taken SSIDs</h4>
        </div>
        <div class="modal-body">
          <?php
            $counter=0;
            foreach ($taken_SSID as $ssid) {
              preg_match("/ESSID:\"(.*)\"/", $ssid, $ssid);
              $ssid=$ssid[1];
              $counter++;
              if ($counter==count($taken_SSID)){

              }
              elseif ($counter==count($taken_SSID)-1){
                echo $ssid;
              }
              else{
                echo $ssid.'<hr>';
              }
            }
          ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

  <br>
  <button type='submit' class='btn btn-success btn-block'>Save and reboot device</button><br><br>
  </form>
  </center>
</div>
</div>
<script>
$('body > div > div > div:nth-child(2) > center > form').submit(function(){
  $('body > div > div > div:nth-child(2) > center > form > button.btn.btn-success.btn-block').attr('disabled', true);
  $('body > div > div > div:nth-child(2) > center > form > button.btn.btn-success.btn-block').html('Rebooting...');
});
</script>