<?php

namespace controllers;

use models\Task as mTask;

class Task extends \controllers\Base
{
    protected $mTask;
    protected $iHelper;
    protected $params;


    public function __construct(Array $params = [])
    {
        parent::__construct();
        $this->params = $params;
        $this->mTask = mTask::Instance();
        $this->iHelper = \includes\Helper::Instance();
        $this->table = 'task';
        $this->pk = 'id';
    }

    public function action_index()
    {
        $this->action_all();

    }

    public function action_all()
    {
        $sort = isset($_POST['sort']) ? $_POST['sort'] : 'id desc';

        $allTask = $this->mTask->getAllTasks($sort) ;

        $this->subTemplate = \includes\Template::gen('blocks/all_tasks',
            [
                'allTask' => $allTask,
                'success' => @!empty($_SESSION['success']) ? $_SESSION['success'] : ''
            ]
        );

        if (isset($_SESSION['success']))
            unset($_SESSION['success']);
    }

    public function action_add_task()
    {
        $this->subTemplate = \includes\Template::gen('blocks/add_task');

    }

    public function action_record_task()
    {
        if ( isset($_POST) ){

            if (isset($_FILES)) {
                $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

                if (
                    $ext=='png' || $ext=='PNG' ||
                    $ext=='jpg' || $ext=='jpeg' ||
                    $ext=='JPG' || $ext=='JPEG' ||
                    $ext=='gif' || $ext=='GIF'  )
                {
                    $sizeImage = getimagesize($_FILES['file']["tmp_name"]);
                    $uploaddir = __DIR__ . '/../img/';
                    $uploadfile = $uploaddir . basename($_FILES['file']['name']);

                    if ($sizeImage[0]<=320 & $sizeImage[1]<=240) {
                        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                            chmod(__DIR__ . '/../img/'.$_FILES['file']['name'],0777);
                        } else {
                            echo "File uploading failed.\n";
                        }
                    } else {
                        $this->iHelper->imageresize($_FILES['file']['name'], $_FILES['file']['tmp_name'], $uploadfile);
                        chmod(__DIR__ . '/../img/'.$_FILES['file']['name'],0777);
                    }
                }
            }
            $this->mTask->createNewTask([
                'user_name' => isset($_POST['name']) ? $_POST['name'] : 'no name',
                'email' => isset($_POST['email']) ? $_POST['email'] : 'no email',
                'text' => isset($_POST['task']) ? $_POST['task'] : 'no task',
                'img' => isset($_FILES['file']['name']) ? '/img/'.$_FILES['file']['name'] : 'no photo',
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
        $_SESSION['success'] = 'Task successfully created!';
        $this->iHelper->redirectTo('/');

    }

    public function action_edit()
    {
        $idTask = explode('/',$_SERVER['REQUEST_URI']);
        $idTask = array_pop($idTask);

        $oneTask = $this->mTask->getOneTask($idTask);

        if (isset($_POST['text']) || isset($_POST['is-end'])){

            $this->mTask->updateTask([
                'status' => isset($_POST['is-end']) ? $_POST['is-end'] : 0,
                'text' => isset($_POST['text']) ? $_POST['text'] : ''
                ], $_POST['id']
            );

            $this->iHelper->redirectTo('/');
        }

        $this->subTemplate = \includes\Template::gen('blocks/edit', [
            'oneTask' => $oneTask[0]
        ]);
    }

    public function action_delete()
    {
        $tmp = explode('/', $_SERVER['REQUEST_URI']);
        $idTask = end($tmp);
        $this->mTask->deleteTask(['id' => $idTask]);
    }


}
