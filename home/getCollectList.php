<?php 
   require_once 'D:\Server\PhpStudy\phpstudy_pro\WWW\server\db\connect_db.php';

    if($_SERVER['REQUEST_METHOD'] <> 'GET') {
          $output = array(
            'code' => "405",
            'msg' => "",
            'data' => "wrong request method",
        );
        echo json_encode($output);
        return;
    } 

     $phone = $_GET['phone'];
     $type = $_GET['type'];

     $query = "SELECT * FROM favorite WHERE userphone = '$phone' AND type = '$type' ORDER BY id DESC ";
   
     $stmt = $pdo->prepare($query);
     $stmt->execute();
     $result =  $stmt->fetchAll();

    $data = array();
    if(count($result) > 0) {
        foreach ($result as $row) {
                    $data[] = $row;
                }
       $output  = array(
		      'code' => "0",
		      'msg' => "请求成功",
		      'data' => $data
        ) ;
    } else {
        $output  = array(
		    'code' => "-1",
		    'msg' => "暂无数据",
		    'data' => $data 
        ) ;
    }
    echo json_encode($output);
?>