<?php
    require_once 'E:\server\phpstudy\phpstudy_pro\WWW\server\db\connect_db.php';
    // require_once 'D:\Server\PhpStudy\phpstudy_pro\WWW\server\db\connect_db.php';
    // require_once 'D:\Server\PhpStudy\phpstudy_pro\WWW\server\user\upload\upload.php';
    require_once 'E:\server\phpstudy\phpstudy_pro\WWW\server\user\upload\upload.php';
//    require_once ("uploadPic.php");
   $pic_path = '';
   $result = array();

   $phone = $_POST["phone"];
  if (isset($_FILES['file'])){
    // 设置上传图片参数
    $param = array(
        'types' => array('image/jpeg','image/jpg','image/png'),
        'size' => 6000000,
        'path' => 'D:\Server\PhpStudy\phpstudy_pro\WWW\server\user\icon\ '
    );
    // 实例化函数，传入$param
    $upload = new UploadPic($param);
    if (!$pic_path = $upload->upload($_FILES['file'],'pic_')){
        // echo $upload->getError();
		$result = array(
             'code' => "-1",
			 'msg' => "$upload->getError()",
			 'data' => ""
		);
        die;
    } else {
             $query_update =  "UPDATE user SET icon = '$pic_path' WHERE phone = '$phone' "; 
             if($pdo->query($query_update)) {
                     $result = array(
                        'code' => "0",
			            'msg' => "图片上传成功",
		        	    'data' => "$pic_path"
		            );	  
               }  
     	}
	 echo json_encode($result);
  }
?>