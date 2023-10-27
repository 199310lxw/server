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
     $type = $_POST['type'];
     $data = $_POST['data'];
     $uploadtime = date("Y-m-d H:i:s");

    //   $query_insert =  "UPDATE favorites SET userphone = '$phone', type = '$type',data = '$data',uploadtime = '2023-10-26' ";
    //   $query_insert =  "INSERT INTO favorites(userphone,type,data,uploadtime) VALUES ('$phone','$type','$data','2023-10-26')";


      $query_insert =  "INSERT INTO favorite(userphone,type,data,uploadtime) VALUES ('$phone','$type','$data','$uploadtime')";
      $data = array();  

       if($pdo->query($query_insert) == true) {
              $query_update =  "UPDATE favorite SET userphone = '$phone', type = '$type',data = '$data',uploadtime = '2023-10-26' ";
              if($pdo->query($query_update)) { 
                   $output  = array(
		                'code' => "0",
		                'msg' => "收藏成功",
		                 'data' => $data ,
                          ) ;
              }
		}


    //   if($pdo->query($query_update)) {
    //        $output = array(
    //             'code' => "0",
    //             'msg' => "上传成功",
    //             'data' => $data,
    //         );
    //   }
      echo json_encode($output);
?>