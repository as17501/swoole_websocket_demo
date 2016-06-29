<?php  
  
  
/** 
file log.class.php 
作用: 记录信息到日志 
**/  
//echo str_replace('\\', ' /', dirname(dirname(__FILE__))) . '/','<br/>';  
//define('ROOT', str_replace('\\','/',dirname(dirname(__FILE__))) . '/');  
  
class log  
{  
      
    const LOGFILE = 'curr.log'; //建一个常量,代表日志文件的名称  
    //判断是否备份  
    public static function isbak()  
    {  
        //1.先来一个目录路径$route  
        $route=SITE_PATH. '/data/log/'. self::LOGFILE ;  
  
        //如果文件不存在,则创建该文件  
        if(!file_exists($route))  
        {  
            // touch在linux也有此命令,是快速的建立一个文件  
            touch($route);  
            return $route;  
        }  
  
          
        // 清除缓存  
        clearstatcache(true,$route);  
        // 要是存在,则判断大小  
        $size=filesize($route);  
        if($size <=1024 * 1024)  
        {  
            return $route;  
        }else  
        {  
            if(!self::bak())  
            {  
                return $route;  
            }else  
            {  
                touch($route);  
                return $route;  
  
            }  
  
        }  
    }  
    public static function write($cont)  
    {     
        //换行回车  
        $cont .= "\r\n";  
        //调用判断是否备份的方法  
        $route=self::isbak();  
        $fh = fopen($route,'ab');  
        fwrite($fh,$cont);  
        fclose($fh);  
  
  
    }  
  
    public static function bak()  
    {  
        $route=SITE_PATH. '/data/log/'. self::LOGFILE ;  
        $bak = SITE_PATH . '/data/log/' . date('ymd') . mt_rand(10000,99999) . '.bak';  
        return rename($route,$bak);  
  
  
    }  
} 
?>