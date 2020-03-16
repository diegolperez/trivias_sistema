<?php

class Team extends Eloquent{
	
        /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'team';
	protected $guarded = [];
        public $timestamps = false;
}
