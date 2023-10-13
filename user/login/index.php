<?php 

   require_once 'D:\Server\PhpStudy\phpstudy_pro\WWW\server\db\connect_db.php';
   require_once 'D:\Server\PhpStudy\phpstudy_pro\WWW\server\session\session.php';

   session_start();

   if($_SERVER['REQUEST_METHOD'] <> 'POST') {
          $output = array(
            'code' => "405",
            'msg' => "",
            'data' => "wrong request method",
        );
        echo json_encode($output);
        return;
    } 

    $session = 

    $phone = $_POST['phone'];
    $password = $_POST['password'];
  
    $query_search = "SELECT phone FROM user WHERE phone = '$phone' ";
    $stmt = $pdo->prepare($query_search);
    $stmt->execute();
    $result =  $stmt->fetchAll();

  
    if(count($result) <= 0) {
       $output = array(
            'code' => "-1002",
            'msg' => "用户不存在",
            'data' => null,
        );
    } else {
         $query =  "SELECT * FROM user WHERE phone = '$phone' AND password = '$password' ";
         $stmt = $pdo->prepare($query);
         $stmt->execute();
         $result1 =  $stmt->fetchAll();
          if(count($result1) <= 0) { 
              $output = array(
                  'code' => "-1003",
                  'msg' => "密码错误，请重试",
                  'data' => null,
              );
          } else {
              $session_data = array (
                  'phone' => $phone,
                  'password' => $password,
              );
            //  $_SESSION['phone'] = $phone;
            //  $_SESSION['pwssword'] = $password;
             $session = new Session();
             $session->setSession('user',$session_data);
             $sessionId = session_id();
             $query_update =  "UPDATE user SET session = '$sessionId' WHERE phone = '$phone' ";
             if($pdo->query($query_update)) {
                  foreach ($result1 as $row) {
                      $data["phone"] = $row["phone"];
                      $data["password"] = $row["password"];
                      $data["icon"] = $row["icon"];
                      $data["username"] = $row["username"];
                      $data["nickname"] = $row["nickname"];
                      $data["sex"] = $row["sex"];
                      $data["birthday"] = $row["birthday"];
                      $data["signature"] = $row["signature"];
                      $data["session"] = $sessionId;
                  }
                    $output = array(
                        'code' => "0",
                        'msg' => "登陆成功",
                        'data' => $data,
                    );
               }
          }
    }

   echo json_encode($output);
 ?>