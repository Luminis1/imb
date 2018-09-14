<?php

namespace vendor;

class View
{	

    public $template = 'layout';

    public function render($view, $data = [])
    {

        if(is_array($data)){

            extract($data);

        }

        $viewPath = APP . 'views/';

        if(is_null($this->template)){

            if (file_exists($viewPath.$view.'.php')){

                include_once $viewPath.$view.'.php';
            }else{

                echo 'File not Found';
            }
        }else{

            if (file_exists($viewPath.$this->template.'.php')){

                include_once $viewPath.$this->template.'.php';

            }else{

                echo 'File Template not found';
            }
        }

    }

}