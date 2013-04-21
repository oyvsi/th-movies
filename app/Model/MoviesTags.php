<?php
class MoviesTags extends AppModel {
//	public $actAs = array('Containable');
	public $belongsTo = array('Tag', 'Movie');	
//	public $hasOne = array('Tag' => array('className' => 'Tag', 'foreignKey' => 'tag_id')); 
//	public $hasAndBelongsToMany = array('Movie' => array('className' => 'Movie', 'foreignKey' => 'movie_id'));

//	public $hasMany = array('Rating' => array('className' => 'Rating', 'foreignKey' => 'movie_rating_id'));
///	public $hasOne = 'Movie';

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
