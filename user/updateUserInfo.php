<?php 
   require_once 'D:\Server\PhpStudy\phpstudy_pro\WWW\server\db\connect_db.php';
 
   if($_SERVER['REQUEST_METHOD'] <> 'POST') {
          $output = array(
            'code' => "405",
            'msg' => "",
            'data' => "wrong request method",
        );
        echo json_encode($output);
        return;
    } 

    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $sex = $_POST['sex'];
    $nickname = $_POST['nickname'];
    $birthday =  $_POST['birthday'];
    $icon = $_POST['icon'];
    $signature = $_POST['signature'];
   
    // $query_search = "SELECT phone FROM user WHERE phone = '$phone' ";
    // $stmt = $pdo->prepare($query_search);
    // $stmt->execute();
    // $result =  $stmt->fetchAll();

    $query_update =  "UPDATE user SET sex = '$sex', nickname = '$nickname',birthday = '$birthday',icon = '$icon',signature = '$signature'  WHERE phone = '$phone' ";
        if($pdo->query($query_update)) {
             $query =  "SELECT * FROM user WHERE phone = '$phone' AND password = '$password' ";
             $stmt = $pdo->prepare($query);
             $stmt->execute();
             $result =  $stmt->fetchAll();
            foreach ($result as $row) {
                $data["phone"] = $row["phone"];
                $data["password"] = $row["password"];
                $data["icon"] = $row["icon"];
                $data["username"] = $row["username"];
                $data["nickname"] = $row["nickname"];
                $data["sex"] = $row["sex"];
                $data["birthday"] = $row["birthday"];
                $data["signature"] = $row["signature"];
                $data["session"] = $row["session"];
            }
            $output = array(
                'code' => "0",
                'msg' => "保存成功",
                'data' => $data,
            );
        }
   echo json_encode($output);
 ?>