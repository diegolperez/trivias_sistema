<?php


/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 14/05/14
 * Time: 02:59 PM
 */



class UserController extends LoginBaseController {

    public function getCreate()
    {
        $user = new User();
        $this->layout->content= View::make('user/create',["user"=>$user]);
    }
    
    public function postCreate()
    {
        $data = Input::all();
        $user = new User();
        $user->name = $data["name"];
        $user->lastname = $data["lastname"];
        $user->password = Hash::make($data["password"]);
        $user->document = $data["document"];
        if($user->save()){
               return Redirect::to('/')->with('type_message',"success")->with('message',"El usuario fue registrado exitosamente. Ya puede ingresar al sistema");               
        }else{
                return Redirect::to('/')->with('type_message',"warning")->with('message',"Existieron errores al registrarse");  
        }
       
    }

    public function postIsDocumentUnique(){

        $validation = Validator::make(Input::all(), ['document' => 'unique:users,document,'. Input::get('id')]);
        return Response::json($validation->passes() ? true : false);
    }

}