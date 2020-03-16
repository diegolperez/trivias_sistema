<?php


/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 14/05/14
 * Time: 02:59 PM
 */



class TriviaController extends BaseController {

    public function getCreate()
    {
        $method = 'POST';
        $teams = Team::all()->lists("name","id");
        $teams_list = (new Globalfunctions)->unshift_select_item($teams);
        $trivia = new Trivia();              
        $this->layout->content= View::make('trivia.create',["trivia"=>$trivia,"teams_list"=>$teams_list]);
    }
    
    public function postCreate()
    {
        $data = Input::all();
        $trivia = new Trivia();
        $trivia->name = $data["name"];
        $trivia->description = $data["description"];
        $trivia->team_1_id = $data["team_1"];
        $trivia->team_2_id = $data["team_2"];
        
        if($trivia->save()){
               return Redirect::to('main')->with('type_message',"success")->with('message',"La trivia fue correctamente ingresado");               
        }else{
                return Redirect::to('main')->with('type_message',"warning")->with('message',"Existieron errores al ingresar la trivia");
        }
       
    }
    
    public function getUpdate($trivia_id)
    {
        $method = 'PUT';
        $teams = Team::all()->lists("name","id");
        $teams_list = (new Globalfunctions)->unshift_select_item($teams);
        $trivia = Trivia::find($trivia_id);
        $this->layout->content= View::make('trivia.create',["trivia"=>$trivia,"teams_list"=>$teams_list]);  
    }    
    
    public function postUpdate($trivia_id)
    {
        $data = Input::all();
        $trivia = Trivia::find($trivia_id);
        $trivia->name = $data["name"];
        $trivia->description = $data["description"];
        $trivia->status = $data["status"];
        
        if($trivia->save()){
               return Redirect::to('main')->with('type_message',"success")->with('message',"La trivia fue actualizada con exito");               
        }else{
                return Redirect::to('main')->with('type_message',"warning")->with('message',"Existieron errores al actualizar la trivia");
        }
       
    }
    
    public function putUpdate($trivia_id)
    {
        $data = Input::all();
        $trivia = Trivia::find($trivia_id);
        $trivia->name = $data["name"];
        $trivia->description = $data["description"];
        $trivia->status = $data["status"];
        
        if($trivia->save()){
               return Redirect::to('main')->with('type_message',"success")->with('message',"La trivia fue actualizada con exito");               
        }else{
                return Redirect::to('main')->with('type_message',"warning")->with('message',"Existieron errores al actualizar la trivia");
        }
       
    }
    
    public function getClosed($trivia_id)
    {
        $method = 'POST';
        $trivia = Trivia::find($trivia_id);   
        $this->layout->content= View::make('trivia.closed',["trivia"=>$trivia]);
    }
    
    public function postClosed($trivia_id)
    {
        $data = Input::all();
        $trivia = Trivia::find($trivia_id);
        $trivia -> team1_score = $data['team1_score'];
        $trivia -> team2_score = $data['team2_score'];
        $trivia -> status = 'CLOSED';
        
        if($trivia->save()){
               return Redirect::to('main')->with('type_message',"success")->with('message',"Los resultados fueron correctamente ingresados");               
        }else{
                return Redirect::to('main')->with('type_message',"warning")->with('message',"Existieron errores al guardar los resultados de la trivia");
        }
       
    }    
    
    
}