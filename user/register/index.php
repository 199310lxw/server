<?php
  
   require_once 'D:\Server\PhpStudy\phpstudy_pro\WWW\server\db\connect_db.php';
   
   $phone    = $_REQUEST['phone'];
   $password = $_REQUEST['password'];
		
    $query_search = "SELECT phone FROM user WHERE phone = $phone";
    $stm = $pdo->prepare($query_search);
    $stm->execute();
    $query_rows =  $stm->fetchAll();
	
	
	if(count($query_rows) > 0) {
		$result  = array(
		   'code' => "501",
		   'msg' => "用户已存在",
		   'data' => "",
		) ;
	} else {
		$query_insert =  "INSERT INTO user(phone,password) VALUES ('$phone','$password')";

		if($pdo->query($query_insert) == true) {
			   $result  = array(
		       'code' => "0",
		       'msg' => "用户注册成功",
		       'data' => $phone ,
		   ) ;
		} else {
			  echo "Error: " .$pdo->error;
		}
		
	} 
	echo json_encode($result);	
?>