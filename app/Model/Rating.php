<?php
class Rating extends AppModel {
	public $primaryKey = 'movie_rating_id';    
	public $belongsTo = array('Movie' => array('className' => 'Movie', 'foreignKey' => 'movie_id'),
							  		  'User' => array('className' => 'User', 'foreignKey' => 'user_id'));

 /*   public $validate = array(
      'movie_id' => array(
          array(
            'rule' => 'notEmpty',
            'message' => 'Movie cannot be empty'
          ),
          array(
            'rule' => 'isUnique',
            'message' => 'This username is already taken'
          )          
      ),
      'rating' => array(
          array(
            'rule' => 'notEmpty',
            'message' => 'Password cannot be empty'
          ),
          array(
            'rule' => array('minLength', 4),
            'message' => 'Must be at least 4 chars' 
          ),
      )
	);*/
    
}
