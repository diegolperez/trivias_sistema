<?php

class Result extends Eloquent{
	
        /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'result';
	protected $guarded = [];
        public $timestamps = false;
       
        public function usuario(){
            return $this->belongsTo("User","users_id");
        }
        
        public function trivia(){
            return $this->belongsTo("Trivia","trivia_id");
        }

}
