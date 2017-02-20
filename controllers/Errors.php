<?php

namespace controllers;

class Errors extends \controllers\Base
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function error404()
    {
        $this->subTemplate = \includes\Template::gen('blocks/error');
    }

}
