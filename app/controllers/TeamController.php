<?php


/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 14/05/14
 * Time: 02:59 PM
 */



class TeamController extends BaseController {

    public function getCreate()
    {
        $method = 'POST';
        $team = new Team();              
        $this->layout->content= View::make('team.create',["team"=>$team]);
    }
    
    public function postCreate()
    {
        $data = Input::all();
        $team = new Team();
        $team -> name = $data["name"];
        $team -> background_color = '#'.$data["background_color"];
        if (Input::hasFile('logo'))
        {
            $fileName = $this->limpia_espacios(Input::file('logo')->getClientOriginalName());
            Input::file('logo')->move(public_path().'/img/teams', $fileName);
            $team -> logo = $fileName;
        }
        if (Input::hasFile('background_image'))
        {
            $fileName = $this->limpia_espacios(Input::file('background_image')->getClientOriginalName());
            Input::file('background_image')->move(public_path().'/img/teams', $fileName);
            $team -> background_image = $fileName;
        }
        
        if($team->save()){
               return Redirect::to('main')->with('type_message',"success")->with('message',"El equipo fue correctamente ingresado");               
        }else{
                return Redirect::to('main')->with('type_message',"warning")->with('message',"Existieron errores al ingresar el equipo");
        }
       
    }
    
    public function getUpdate($team_id)
    {
        $method = 'PUT';
        $team = Team::find($team_id);
        $this->layout->content= View::make('team.create',["team"=>$team]);  
    }    
    
    public function postUpdate($team_id)
    {
        $data = Input::all();
        $team = Trivia::find($team_id);
        $team -> name = $data["name"];
        $team -> background_color = '#'.$data["background_color"];
        if (Input::hasFile('logo'))
        {
            $fileName = Input::file('logo')->getClientOriginalName();
            Input::file('logo')->move(public_path().'/img/teams', $fileName);
            $team -> logo = $fileName;
        }
        if (Input::hasFile('background_image'))
        {
            $fileName = Input::file('background_image')->getClientOriginalName();
            Input::file('background_image')->move(public_path().'/img/teams', $fileName);
            $team -> background_image = $fileName;
        }
        
        if($team->save()){
               return Redirect::to('main')->with('type_message',"success")->with('message',"El equipo fue correctamente actualizado");               
        }else{
                return Redirect::to('main')->with('type_message',"warning")->with('message',"Existieron errores al actualizar el equipo");
        }
       
    }
    

        
    public function postIsNameUnique(){
        $validation = Validator::make(Input::all(), ['name' => 'unique:team,name,'. Input::get('id')]);
        return Response::json($validation->passes() ? true : false);
    }
    
    public function limpia_espacios($cadena){
	$cadena = str_replace(' ', '', $cadena);
	return $cadena;
    }
}