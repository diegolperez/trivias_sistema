<?php

class BaseController extends Controller {

     protected $layout = 'container.master';
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
                        //Validar si el usuario está autenticado 
                        if(Auth::user())
                        {
                            $this->layout = View::make($this->layout);

                        }else{
                            //Redireccionar al login
                            return Redirect::to('/');
                        } 
                }
	}

}
