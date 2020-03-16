<?php


/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 14/05/14
 * Time: 02:59 PM
 */



class AccountController extends BaseController {

    public function getIndex()
    {
        $user = User::find(Auth::user()->id);       
        $this->layout->content= View::make('account.edit',["user"=>$user]);
    }
    
    public function postIndex()
    {
        $data = Input::all();
        $user = User::find(Auth::user()->id);
        $user->name = $data["name"];
        $user->lastname = $data["lastname"];
        
        //If user entered a password update it
        if (Input::has('password')) {
            $user->password = Hash::make($data["password"]);
        }      

        $user->document = $data["document"];
        if($user->save()){
               return Redirect::to('main')->with('type_message',"success")->with('message',"El usuario fue actualizado exitosamente");               
        }else{
                return Redirect::to('/')->with('type_message',"warning")->with('message',"Existieron errores al registrarse");  
        }
       
    }
    
    public function postIsDocumentUnique(){

        $validation = Validator::make(Input::all(), ['document' => 'unique:users,document,'. Input::get('id')]);
        return Response::json($validation->passes() ? true : false);
    }

}