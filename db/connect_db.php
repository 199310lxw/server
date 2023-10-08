<?php
    $db_host     = "localhost";
    $db_user     = "root";
    $db_password = "root";
    $db_name     = "mine";
    $db_port     = "3306";
    $charset     = "utf8";
	
	 //连接数据库
    try {
        $dsn = "mysql:host=" .$db_host. ";dbname=" .$db_name. ";port=" .$db_port. ";charset=" .$charset ;
        $option = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ];

        $pdo = new PDO($dsn,$db_user,$db_password,$option);
      

    } catch(PDOException  $e) {
        echo "数据库连接失败！\n";
        echo $e->getMessage();
        $pdo = null;
        exit();
    }
?>