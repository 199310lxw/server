<?php
/**
 * Session控制类
 */
class Session {
       /**
   * 设置session
   * @param String $name  session name
   * @param Mixed $data  session data
   * @param Int  $expire 超时时间(秒)
   */
  public static function setSession($name, $data){
    $session_data = array();
    $session_data['data'] = $data;
    $_SESSION[$name] = $session_data;
  }

  /**
   * 读取session
   * @param String $name session name
   * @return Mixed
   */
  public  function get($name){
    if(isset($_SESSION[$name])){
      if($_SESSION[$name]['expire']>time()){
        return $_SESSION[$name]['data'];
      }else{
        self::clear($name);
      }
    }
    return false;
  }

  /**
   * 清除session
   * @param String $name session name
   */
  private static function clear($name){
    unset($_SESSION[$name]);
  }
}
?>
