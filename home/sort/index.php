<?php 

    // require_once 'E:\server\phpstudy\phpstudy_pro\WWW\server\db\connect_db.php';
    require_once 'D:\Server\PhpStudy\phpstudy_pro\WWW\server\db\connect_db.php';

    if($_SERVER['REQUEST_METHOD'] <> 'GET') {
          echo '请求方式错误';
        return;
    } 

    $query = "SELECT * FROM sort";
    $stm = $pdo->prepare($query);
    $stm->execute();
    $result =  $stm->fetchAll();
    $data = array();
    if(count($result) > 0) {
        foreach ($result as $row) {
             $data[] = $row;
        }
       
        $output = array(
            'code' => "0",
            'msg' => "请求成功",
            'data' => $data,
        );
    } else {
         $output = array(
            'code' => "0",
            'msg' => "暂无数据",
            'data' => $data,
        );
    }
   
    echo json_encode($output);
 ?>