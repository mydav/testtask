<?php

namespace includes;


class Template
{
    public static function gen($path, Array $data = [])
    {
        foreach ($data as $k => $v) {
            $$k = $v;
        }

        ob_start();

        include_once TEMPLATES_DIR . '/' . $path . '.html.php';

        return ob_get_clean();
    }
}