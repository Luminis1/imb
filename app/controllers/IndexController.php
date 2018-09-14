<?php

namespace app\Controllers;

use app\Models\DocPriceBody;
use vendor\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        $this->view->render('index');
    }

    public function priceByDateAction()
    {

        $date = $_REQUEST['date'];
//        var_dump($date);
//        die();

        $dpb = new DocPriceBody();

        $priceByDate = $dpb->priceByDate($date);


        $this->view->render('index', ['obj' => $priceByDate]);
    }
}