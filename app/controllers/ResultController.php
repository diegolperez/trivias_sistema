<?php


/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 14/05/14
 * Time: 02:59 PM
 */



class ResultController extends BaseController {


    public function getResult($trivia_id)
    {
        $trivia = Trivia::find($trivia_id);
        $resultados = $trivia->resultados()->get();
        $this->layout->content= View::make('result/index',["resultados"=>$resultados,"trivia"=>$trivia]);
    }
    
    public function getCreate($trivia_id)
    {
        $trivia = Trivia::find($trivia_id);
        $resultados = $trivia->resultados()->where("users_id","=",Auth::user()->id)->first();
        if(!empty($resultados)){
            $resultado = Result::find($resultados->id);
        }else{
            $resultado = new Result();
        }
        
        $this->layout->content= View::make('result/create',["trivia"=>$trivia,"resultado"=>$resultado]);
    }
    
    public function postCreate()
    {
        $data = Input::all();
        $resultado = new Result();
        $resultado->users_id = Auth::user()->id;
        $resultado->trivia_id = $data["trivia_id"];
        $resultado->team_1_score = $data["equipo1"];
        $resultado->team_2_score = $data["equipo2"];
        if($resultado->save()){
               return Redirect::to('main')->with('type_message',"success")->with('message',"El marcador fue correctamente ingresado");               
        }
       
    }

}