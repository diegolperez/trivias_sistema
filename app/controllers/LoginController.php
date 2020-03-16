<?php

/**
 * Created by PhpStorm.
 * User: Diego P
 * Date: 14/05/16
 * Time: 02:59 PM
 */

class LoginController extends LoginBaseController {

    public function getIndex()
    {
       
        $this->layout->content=View::make('login');

    }

    public function postIndex(){
        
        $document = Input::get('document');
        $password = Input::get('password');
        
        
        //Realizar autenticación
        if (Auth::attempt(array('document' => $document, 'password' => $password)))
        {
            //Comprobar si el estado de la persona es activo
            if(Auth::user()->status=='ACTIVE'){               
                return Redirect::to('main');                 
            }
            else{
                //Redireccionar al login
                return Redirect::to('/')->with('type_message',"danger")
                        ->with('message',"Su usuario se encuentra inactivo. Contáctese con el administrador para activarlo");
            }
        }else{
            //Redireccionar al login
            return Redirect::to('/')->with('type_message',"danger")
                    ->with('message',"Sus credenciales son incorrectas. Vuelva a intentarlo");
        }

    }

    
    /*
     * System logout
     */    
    public function getLogout()
    {
        Session::flush();
        Auth::logout();
        return Redirect::to('/')->with('message', 'Ha salido exitosamente del sistema');
    }
} 