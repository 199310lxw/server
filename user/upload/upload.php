<?php
/**
文件上传类
 */
class UploadPic
{
    // 定义成员变量
    private $allow_type = array('image/jpeg','image/pjpeg','image/jpg','image/png','image/x-png','image/gif');
    private $max_size = 10 * 1024 * 1024;
    private $upload_path = 'D:\Server\PhpStudy\phpstudy_pro\WWW\server\user\icon\\';
    private $error = '';

    /**
    构造方法
     $param 用来修改成员属性的数组数据
     */
    public function __construct($param)
    {
        if (isset($param['allow_type'])) $this->allow_type = $param['types'];
        if (isset($param['max_size'])) $this->max_size = $param['size'];
        if (isset($param['upload_path'])) $this->upload_path = $param['path'];
    }

    /**文件上传函数
     * $file 包含文件上传的5个信息数据
     * $prefix 前缀
     */
    public function upload($file,$prefix = ''){
        // 判断文件是否有错误
        if($file['error'] != 0){
            $upload_error = array(
                1 => '文件过大，超出PHP配置的限制',
                2 => '文件过大，超出Form表单中的限制',
                3 => '文件未上传完毕',
                4 => '文件没有上传',
                5 => '',
                6 => '没有找到临时上传目录',
                7 => '临时文件写入失败'
            );
            $this->error = isset($upload_error[$file['error']]) ? $upload_error[$file['error']] : '未知错误';
            return false;
        }

        // 判断类型是否在$allow_type中
        // if (!in_array($file['type'],$this->allow_type)){
        //     $this->error = '此类型的图片不支持上传！图片类型请参考：'.implode('|',$this->allow_type);
        //     return false;
        // }

        // 判断文件是否超出$max_size规定值
        if ($file['size'] > $this->max_size){
            $this->error = '文件不能超过'.$this->max_size.'字节';
            return false;
        }

        // 新文件名，生成唯一的文件名，并保留原有的文件扩展名
        $new_fileName = uniqid($prefix).strrchr($file['name'],'.');
        // 确定当前子目录
        // $sub_path ='pic'. date('Ymd');
        // 确定文件上传全路径
        // $upload_path = $this->upload_path.$sub_path;
         $upload_path = $this->upload_path;
        // 判断目录是否存在
        if (!is_dir($upload_path)){
            mkdir($upload_path);
        }
        // 移动文件
        if (move_uploaded_file($file['tmp_name'],$upload_path.'\\'.$new_fileName)){
            return 'server/user/icon/'. $new_fileName;
        }else{
            $this->error = '上传失败！';
            return false;
        }
    }

    public function getError(){
        return $this->error;
    }
}
