<?php
$device=explode("\n", file_get_contents('/etc/hostapd/hostapd.conf'));
$wifi_settings=file_get_contents('/etc/hostapd/hostapd.conf');
$wifi_settings=str_replace($device[1], 'ssid='.$_POST['ssid'], $wifi_settings);
$wifi_settings=str_replace($device[7], 'wpa_passphrase='.$_POST['wifi_pass'], $wifi_settings);
file_put_contents('/etc/hostapd/hostapd.conf', $wifi_settings);
exec('sudo /usr/sbin/service hostapd restart');
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
