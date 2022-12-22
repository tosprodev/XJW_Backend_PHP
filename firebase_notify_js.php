 <?php 
 //if($_SERVER['REQUEST_METHOD']=='GET'){

 //$fcm_apiKey = $_POST['apiKey'];
 /*$getTitle = $_POST['title'];
 $getBody = $_POST['body'];
 $getTopic = $_POST['topic'];
 $getDevice_token = $_POST['token'];
 $getImageUrl = $_POST['image_url'];
 $getAction = $_POST['action'];
 $getColor = $_POST['color'];
 $getIcon = $_POST['icon'];
 $getSound = $_POST['sound'];*/
 
 //$fcm_apiKey = $_GET['apiKey'];
 /*$getTitle = $_GET['title'];
 $getBody = $_GET['body'];
 $getTopic = $_GET['topic'];
 $getDevice_token = $_GET['token'];
 $getImageUrl = $_GET['image_url'];
 $getAction = $_GET['action'];
 $getColor = $_GET['color'];
 $getIcon = $_GET['icon'];
 $getSound = $_GET['sound'];
 $redirect_url = $_GET['r_url'];*/
 
 
//}

function sendFCM(string $fcm_url, $fcm_apiKey, $getTitle, $getBody, $getImageUrl, $getsend_type, $getTopic, $getDevice_token, 	    $getIcon, $getSound, $getColor, $getAction, $redirect_url) {
  $url = $fcm_url;
  $apiKey = $fcm_apiKey;
  
  $title = $getTitle;
  $body = $getBody;
  $image = $getImageUrl;
  
  $send_type = $getsend_type;
  $topic = $getTopic;
  $device_token = $getDevice_token;
  $micon = $getIcon;
  $msound = $getSound;
  $mcolor = $getColor;
  $maction = $getAction;
  $rurl = $redirect_url;

  // Compile headers in one variable
  $headers = array (
    'Authorization:key=' . $apiKey,
    'Content-Type:application/json'
  );

  // Add notification content to a variable for easy reference
  $notifData = [
    'title' => $title,
    'body' => $body,
    'image' => $image,
	'icon' => $micon,
    'color' => $mcolor,
	'sound' => $msound,
    'click_action' => $maction //Action/Activity - Optional
	
  ];

  $dataPayload = ['to'=> 'My Name', 
  'points'=>80, 
  'other_data' => 'This is extra payload'
  ];

  if($send_type == "1") {
	  // Create the api body
  $apiBody = [
    'notification' => $notifData,
    'data' => $dataPayload,
    'time_to_live' => 600,
    'to' => '/topics/'.$topic
    //'registration_ids' = ID ARRAY
  ];
  } elseif($send_type == "2") {
  // Create the api body
  $apiBody = [
    'notification' => $notifData,
    'data' => $dataPayload,
    'time_to_live' => 600,
    //'registration_ids' = ID ARRAY
    'to' => $device_token
  ];
  }

  // Initialize curl with the prepared headers and body
  $ch = curl_init();
  curl_setopt ($ch, CURLOPT_URL, $url);
  curl_setopt ($ch, CURLOPT_POST, true);
  curl_setopt ($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt ($ch, CURLOPT_POSTFIELDS, json_encode($apiBody));

  // Execute call and save result
  $result = curl_exec($ch);
  //print($result); 
  //print("Task Done");
  header('Location: '.$redirect_url);
  
  $response['error'] = false; 
  $response['message'] = 'Your booking created successfully'; 
   //Close curl after call
  curl_close($ch);

  return $result;
}
 ?>