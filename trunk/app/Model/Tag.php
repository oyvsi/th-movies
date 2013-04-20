<?php
class Tag extends AppModel {
//	public $belongsTo = array('MovieTag' => array('className' => 'MovieTag', 'associationForeignKey' => 'tag_id'));
	public $actAs = array('Containable');
	public $hasMany = array('MoviesTags');
	//public $hasAndBelongsToMany = array('Movie'=>array('className'=>'Movie', 'with' => 'MoviesTags', 'associationForeignKey'  => 'movie_id'));
	//public $displayField = "tag";

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
