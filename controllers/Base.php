<?php

namespace controllers;

use \includes\Template;

class Base
{
    /**Выбор базового шаблона**/
    protected $layouts;
    /**Поля базового шаблона**/
    protected $title;
    protected $head;
    protected $nav;
    protected $subTemplate;
    protected $footer;


    public function __construct()
    {
        $this->layouts = 'layouts';
        $this->title = 'Main page :: ';
        $this->head = Template::gen('blocks/head');
        $this->nav = Template::gen('blocks/nav');
        $this->footer = Template::gen('blocks/footer');
    }

    public function render()
    {

        echo Template::gen('layouts/base',
            [
                'head' => $this->head,
                'title' => $this->title,
                'nav' => $this->nav,
                'subTemplate' => $this->subTemplate,
                'footer' => $this->footer,

            ]
        );

    }
}
