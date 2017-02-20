<?php
/*
*
* Модуль для вспомогательных функций.
*
*/
namespace includes;

class Helper
{
    public static $instance;
    /*Глобальные масивы*/
    private $get;
    private $post;
    private $cookie;
    private $server;
    /**/
    public $uri;

    public static function Instance()
    {
        if(self::$instance === null)
            self::$instance = new self;
        return self::$instance;
    }

    public function __construct()
    {
        $this->post = $_POST;
        $this->cookie = $_COOKIE;
        $this->server = $_SERVER;
        $this->setUri();
        $this->get = $this->mekeGetArr();
    }
    /*
    * Выводит на экран переменную в человекочитаемом формате
    */
    public static function dump($var)
    {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    }

    /*
    *Перенаправляет (редиректит) браузер на определенный URL
    */
    public static function redirectTo($url){
        header('Location:' . $url);
        die();
    }
    /**
     * [[Получаем GET масив]]
     * @return array
     */
    public function _Get()
    {
        return $this->get;
    }
    /**
     * [[Description]]
     * @return boolean [[Description]]
     */
    public function isPost()
    {
        return $this->server['REQUEST_METHOD'] === 'POST';
    }
    /**
     * Разбиваем на URI
     */
    private function setUri()
    {
        try{
            if(!$buffer = parse_url($this->server['REQUEST_URI']))
                throw new \Exception('Invalid URL');

            $this->uri = $buffer["path"];

        }catch(\Exception $e){
            die($e->getMessage());
        }
    }
    /**
     * Парсим Uri тоесть забераем строку по / и присваеваем масиву
     */
    public function parseUri()
    {
        $params = [];
        $p = explode('/', $this->uri);
        foreach ($p as $v) {
            if ($v !== '') {
                $params[] = $v;
            }
        }

        return $params;
    }
    /**
     * Строку URI мы разбиваем на URI и query после чего из query согдаём асоц. масив подобный $_GET
     * @return array
     */
    private function mekeGetArr()
    {
        $result = [];
        $buffer = parse_url($this->server['REQUEST_URI']);

        if(!isset($buffer['query']))
            return $result;

        $ampersand = explode('&', $buffer['query']);//разбиваваем строку по &
            foreach ($ampersand as $k) {
                $equally = explode('=', $k);//разбиваваем строку по =
                $name = $equally['0'];
                unset($equally['0']);
                $result[$name] = $equally[1];
            }
        return $result;
    }

    /**
     * Description Resize image
     * @param $post_photo
     * @param $post_photo_tmp
     * @param $uploadfile
     */
    public function imageresize($post_photo, $post_photo_tmp, $uploadfile) {

        $ext = pathinfo($post_photo, PATHINFO_EXTENSION);  // getting image extension

        if  (
            $ext=='png' || $ext=='PNG' ||
            $ext=='jpg' || $ext=='jpeg' ||
            $ext=='JPG' || $ext=='JPEG' ||
            $ext=='gif' || $ext=='GIF'  )  // checking image extension
        {
            if($ext=='jpg' || $ext=='jpeg' || $ext=='JPG' || $ext=='JPEG')
            {
                $src=imagecreatefromjpeg($post_photo_tmp);
            }
            if($ext=='png' || $ext=='PNG')
            {
                $src=imagecreatefrompng($post_photo_tmp);
            }
            if($ext=='gif' || $ext=='GIF')
            {
                $src=imagecreatefromgif($post_photo_tmp);
            }

            list($width_min,$height_min)=getimagesize($post_photo_tmp); // fetching original image width and height

            $newwidth_min=320; // set compressing image width

            $newheight_min=240; // equation for compressed image height

            $tmp_min = imagecreatetruecolor($newwidth_min, $newheight_min); // create frame  for compress image

            imagecopyresampled($tmp_min, $src, 0,0,0,0,$newwidth_min, $newheight_min, $width_min, $height_min); // compressing image

            imagejpeg($tmp_min, $uploadfile,80); //copy image in folder//

        }

    }
}
?>
