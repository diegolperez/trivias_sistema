<?php

class Trivia extends Eloquent{
	
        /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'trivia';
	protected $guarded = [];
        public $timestamps = false;
        
        public function equipo1(){
            return $this->belongsTo("Team","team_1_id");
        }
        
        public function equipo2(){
            return $this->belongsTo("Team","team_2_id");
        }
        
        public function resultados(){
            return $this->hasMany("Result","trivia_id");
        }

}
