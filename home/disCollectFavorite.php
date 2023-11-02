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


    $query_delete =  "DELETE FROM favorite WHERE userphone = '$phone' AND url = '$videoUrl' ";
    $data = array();  

    try {
        $stmt = $pdo->prepare($query_delete);
        // $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $output  = array(
		            'code' => "0",
		            'msg' => "取消收藏成功",
		            'data' => "true" ,
          ) ;
    } catch(PDOException $e) {
         $output  = array(
		            'code' => "0",
		            'msg' => "取消收藏失败：" . $e->getMessage(),
		            'data' => "false" ,
          ) ;
   }
    echo json_encode($output);
?>