<?php
/** 
 * 发送post请求 
 * @param string $url 请求地址 
 * @param array $post_data post键值对数据 
 * @return string 
 */  
function send_post($url, $post_data) {  
  
  $postdata = http_build_query($post_data);  
  $options = array(  
    'http' => array(  
      'method' => 'POST',  
      'header' => 'Content-type:application/x-www-form-urlencoded',  
      'content' => $postdata,  
      'timeout' => 15 * 60 // 超时时间（单位:s）  
    )  
  );  
  $context = stream_context_create($options);  
  $result = file_get_contents($url, false, $context);  
  
  return $result;  
}    
/** 
 * Socket版本 
 * 使用方法： 
 * $post_string = "app=socket&version=beta"; 
 * request_by_socket('chajia8.com', '/restServer.php', $post_string); 
 */  
function request_by_socket($remote_server,$remote_path,$post_string,$port = 80,$timeout = 30) {  
  $socket = fsockopen($remote_server, $port, $errno, $errstr, $timeout);  
  if (!$socket) die("$errstr($errno)");  
  fwrite($socket, "POST $remote_path HTTP/1.0");  
  fwrite($socket, "User-Agent: Socket Example");  
  fwrite($socket, "HOST: $remote_server");  
  fwrite($socket, "Content-type: application/x-www-form-urlencoded");  
  fwrite($socket, "Content-length: ".strlen($post_string)+8);  
  fwrite($socket, "Accept:*/*");  
  fwrite($socket, "");  
  fwrite($socket, "mypost=$post_string");  
  fwrite($socket, "");  
  $header = "";  
  while ($str = trim(fgets($socket, 4096))) {  
    $header .= $str;  
  }  
  
  $data = "";  
  while (!feof($socket)) {  
    $data .= fgets($socket, 4096);  
  }  
  
  return $data;  
}  
/**  
 * Curl版本  
 * 使用方法：  
 * $post_string = "app=request&version=beta";  
 * request_by_curl('http://www.qianyunlai.com/restServer.php', $post_string);  
 */  
function request_by_curl($remote_server, $post_string) {  
  $ch = curl_init();  
  curl_setopt($ch, CURLOPT_URL, $remote_server);  
  curl_setopt($ch, CURLOPT_POSTFIELDS, 'mypost=' . $post_string);  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
  curl_setopt($ch, CURLOPT_USERAGENT, "qianyunlai.com's CURL Example beta");  
  $data = curl_exec($ch);  
  curl_close($ch);  
  
  return $data;  
}  
?>  