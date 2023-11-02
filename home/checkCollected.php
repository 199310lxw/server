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
     $videoUrl = $_POST['videoUrl'];
    // $query_insert =  "INSERT INTO favorite(userphone,type,data,uploadtime) VALUES ('$phone','$type','$data','$uploadtime')";
    $query_select = "SELECT * FROM favorite WHERE userphone = '$phone' AND url = '$videoUrl' ";
   
    $stmt = $pdo->prepare($query_select);
    $stmt->execute();
    $result =  $stmt->fetchAll();
    if(count($result) > 0) {
       $output  = array(
		      'code' => "0",
		      'msg' => "内容已收藏",
		      'data' => "true" ,
        ) ;
    } else {
        $output  = array(
		       'code' => "0",
		       'msg' => "内容没有收藏",
		       'data' => "false" ,
        ) ;
    }
    echo json_encode($output);
?>