<?php
$auth=explode("\n", file_get_contents('/etc/openvpn/auth.txt'));
if($auth[0]=='user0' && $auth[1]=='password0'){
  require('header.php');
  require('login_form.php');
  require('footer.php');
}
else{
  require('header.php');
  require('panel.php');
  require('footer.php');
}