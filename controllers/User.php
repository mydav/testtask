<?php
namespace controllers;

class User extends \controllers\Base
{

    protected $iHelper;
    protected $params;


    public function __construct(Array $params = [])
    {
        parent::__construct();
        $this->iHelper = \includes\Helper::Instance();
    }

    public function action_login()
    {
        $this->title .='Авторизация';
        $error = '';
        if (isset($_POST['login']) & isset($_POST['password'])){
            if ($_POST['login'] == 'admin' & $_POST['password'] == 123 ){
                $_SESSION['admin'] = true ;
            } else {
                $error = 'Invalid login or password';
            }
        }

        if (isset($_SESSION['admin'])){
            $this->iHelper->redirectTo('/');
        }

        $this->subTemplate = \includes\Template::gen('blocks/login',
            [
                'error' => $error
            ]);
    }

    public function action_logout()
    {
        unset($_SESSION['admin']);
        $this->iHelper->redirectTo('/');
    }


}
