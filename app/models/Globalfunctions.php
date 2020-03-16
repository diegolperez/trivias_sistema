<?php

/**
 * File: globalfunctions
 * Author: DELL-PC
 * Creation Date: 28-05-2014
 * Last Modified:
 */

Class Globalfunctions {

    public function unshift_select_item($array, $word='- Seleccione -', $value=''){
        if(is_array($array)){
                $aux_array = array($value => $word);

                return $aux_array + $array;
        }else{
                return array($value => $word);
        }
    }

    public function select_tree($arrays) {
        $refs = array();
        $list = array();
        foreach($arrays as $array) {
            $thisref = &$refs[ $array['id'] ];

            $thisref['parent_id'] = $array['parent_id'];
            $thisref['name'] = $array['name'];

            if ($array['parent_id'] == 0) {
                $list[ $array['id'] ] = &$thisref;
            } else {
                $refs[ $array['parent_id'] ]['children'][ $array['id'] ] = &$thisref;
            }
        }

        $names_list = ((new Globalfunctions())->toUL_names($list));
        $key_list = ((new Globalfunctions())->toUL_ids($list));


        $names_list = explode(':',$names_list,-1);
        $key_list = explode(':',$key_list,-1);

        return(array_combine($key_list,$names_list));

    }

    function toUL_names ($arr, $pass = 0, $result = array()) {

        $list_names = '';
        $list_ids = '';

        foreach ( $arr as $key => $v ) {

            $list_names .= str_repeat("--", $pass); // use the $pass value to create the --
            $list_names .= $v['name'] .':';

            if ( array_key_exists('children', $v) ) {
                $list_names.= (new Globalfunctions())->toUL_names($v['children'], $pass+1);
            }

        }

        return $list_names;
    }

    function toUL_ids ($arr, $pass = 0, $result = array()) {

        $list_ids = '';

        foreach ( $arr as $key => $v ) {
            $list_ids .= $key.':';

            if ( array_key_exists('children', $v) ) {
                $list_ids.= (new Globalfunctions())->toUL_ids($v['children'], $pass+1);
            }
        }

        return $list_ids;
    }

    /* Función: permite obtiener las acciones disponibles
    *           en función al perfil.
    *  Realizado por: Graciela González
    */ 
    function obtenerPermisos($menu){
       $acciones_disponibles=$menu->acciones_permitidas_por_accion()->orderBy('allowed_id', 'asc')->get();

        for($i=0; $i<count($acciones_disponibles);$i++)
        {
            
            ///////Toca aqui capturar el perfil//////
            $perfil_id = Auth::user()->profile_id;
       
            if($acciones_disponibles[$i]['profile_id']== $perfil_id )
            {
            $accion_disponible=AllowedAction::find($acciones_disponibles[$i]['allowed_id']);
          
            $url=$accion_disponible->url;
            $url_inicio=strpos($url, "/");
            $url_fin=strlen($url);
            $url=substr($url, $url_inicio+1, $url_fin); 
           
               
                 switch ($url) {
                        case 'listar':
                            $nombre_acciones[$i]="boton_listar";
                            break;
                        case 'crear':
                            $nombre_acciones[$i]="boton_crear";
                            break;
                        case 'eliminar':
                            $nombre_acciones[$i]="boton_eliminar";
                            break;
                        case 'actualizar':
                            $nombre_acciones[$i]="boton_editar";
                            break;
                        
                        default:
                        $nombre_acciones[$i]="";
                            break;
                    }        
                }
                               
            }
            return $nombre_acciones;

    }

}
?>


