<?php

require_once("dataLayer.php");

header("Content-Type: Application/json");
header('Access-Control-Allow-Origin: *');

function getJson() {
   $jsonStringIn = file_get_contents('php://input');
   $json = array();
   $response = array();
   try {
      $json = json_decode($jsonStringIn,true);
      return $json;
   }
   catch (Exception $e) {
      header("HTTP/1.0 500 Invalid content -> probably invalid JSON format");
      $response['status'] = "fail";
      $response['message'] = $e->getMessage();
      print json_encode($response);
      exit;
   }
}

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
   if (isset($_SERVER['PATH_INFO'])) {
      // Parse URL and process Action 1 (/v1/keys) and 2 (/v1/keys/a_value)
      $path = explode("/", $_SERVER["PATH_INFO"]);

      if($path[1] == "v1" && $path[2] == "items"){
         // if(!isset($path[3])) {
         //    $keyNamesObj = new KeyNames();
         //    print json_encode($keyNamesObj->getKeyNames());
         // } else {
         //    $keyNamesObj = new KeyNames();
         //    print json_encode($keyNamesObj->getKeyName($path[3]));
         // }
<<<<<<< HEAD
         print json_encode({"status": "OK", "items": [{"pk": "1", "item": "Cheese"}]});
=======
         //print json_encode({'status':'OK', 'token':'cheese'});
>>>>>>> 0ab5b91caa93902952816cecd57f7c564423babb
      }
   }
} elseif ($method=="POST") {
   $body = getJson();
   // Parse URL and process Action 3 (/v1/login)
   $path = explode("/", $_SERVER["PATH_INFO"]);
   //alert($path);
   if($path[1] == "v1" && $path[2] == "user"){
      $tokensObj = new Tokens();
      $username = $body["user"];
      $password = $body["password"]; //ask why password here has to be password
      //print("here we are");
      print json_encode($tokensObj->authenticate($username,$password));
   }
} else {
   header("http/1.1 405 invalid method");
}
?>