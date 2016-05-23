<?php
session_start();

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"https://login.ubanvpn.com/index.php/login/remote");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            "user=".$_POST['user']."&pass=".$_POST['pass']."");

// in real life you should use something like:
// curl_setopt($ch, CURLOPT_POSTFIELDS, 
//          http_build_query(array('postvar1' => 'value1')));

// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);

curl_close ($ch);

$response=json_decode($server_output, true);

if($response['error']){
  $_SESSION['flash']=$response['error'];
  header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else{
  $response['certificate']=str_replace("auth-user-pass", "auth-user-pass /etc/openvpn/auth.txt", $response['certificate']);

  file_put_contents('/etc/openvpn/client.conf', $response['certificate']);

  file_put_contents('/etc/openvpn/auth.txt', $_POST['user'].PHP_EOL.$_POST['pass']);

  exec('sudo /usr/sbin/service openvpn restart');
  
  require('header.php');
  require('loading.php');
  require('footer.php');
}
