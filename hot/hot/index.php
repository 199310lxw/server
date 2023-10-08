<?php 

    require_once 'E:\server\phpstudy\phpstudy_pro\WWW\db\connect_db.php';

    $page    = $_GET['page'];
    $size    = $_GET['size'];
 
    $low   = (($page - 1) * $size + 1);
    $hight = $page * $size;

    if($_SERVER['REQUEST_METHOD'] <> 'GET') {
          echo '请求方式错误';
        return;
    } 

    $query = "SELECT * FROM hot WHERE id BETWEEN $low AND $hight ";
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
