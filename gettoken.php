<?php
function sign_creator(&$data_login){
$sig = '';
  foreach($data_login as $key => $value){
    $sig .= "$key=$value";
  }
  $sig .= 'c1e620fa708a1d5696fb991c1bde5662';
  $sig = md5($sig);
  return $data_login['sig'] = $sig;
}
$username = $_GET['u'];
$password = $_GET['p'];
$md5Time = md5(time());
$hash = substr($md5Time, 0, 8).'-'.substr($md5Time, 8, 4).'-'.substr($md5Time, 12, 4).'-'.substr($md5Time, 16, 4).'-'.substr($md5Time, 20, 12);
$data_login = array(
'meta_inf_fbmeta' => 'NO_FILE',
'adid' => '01bffadf-c4e9-4793-b6a4-5894fff7149d',
'advertiser_id' => '01bffadf-c4e9-4793-b6a4-5894fff7149d',
'api_key' => '882a8490361da98702bf97a021ddc14d',
'credentials_type' => 'password',
'country_code' => 'VN',
'client_country_code' => 'VN',
'currently_logged_in_userid' => 0,
'email' => $username,
'family_device_id' => 'c3a74c28-1a16-4d78-b029-ef3d13ee0283',
'fb_api_caller_class' => "com.facebook.auth.login.AuthOperations$PasswordAuthOperation",
'fb_api_req_friendly_name' => 'authenticate',
'format' => 'json',
'generate_session_cookies' => 1,
'jazoest' => 22650,
'locale' => 'vi_VN',
'machine_id' => 'U72FXWwIWwVIPpmp6OLU0x3L',
'method' => 'auth.login',
'password' => $password,
'session_id' => $hash,
'reg_instance' => $hash,
'device_id' => $hash,
'family_device_id' => $hash,
'source' => 'loggin',
'access_token' => '350685531728 |62f8ce9f74b12f84c123cc23437a4a32'
);
sign_creator($data_login);
$login = curl('https://b-api.facebook.com/method/auth.login',$data_login);
echo $login;
function curl($url,$post_data){
$user_agent = array(
'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36',
'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36'
);
$useragent = $user_agent[array_rand($user_agent)];
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_USERAGENT, $useragent);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_ENCODING , 'gzip, deflate');
curl_setopt($curl, CURLOPT_POST, count($post_data));
curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
$timeout = 10;
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
$data = curl_exec($curl);
curl_close($curl);
return $data;
}
?>
