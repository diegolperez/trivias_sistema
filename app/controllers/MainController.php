<?php


/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 14/05/14
 * Time: 02:59 PM
 */



class MainController extends BaseController {


    public function getIndex()
    {
        $trivias = Trivia::all();
        $this->layout->content= View::make('main',["trivias" => $trivias]);
    }
    
    public function postIndex()
    {
        $this->layout->content= View::make('main');
    }

    public function getUnauthorized()
    {
        $this->layout->content=  View::make('unauthorized');
    }

}