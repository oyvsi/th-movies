<?php
class Movie extends AppModel {
	public $primaryKey = 'id';    
	public $hasMany = array('Rating' => array('className' => 'Rating', 'foreignKey' => 'movie_rating_id'), 'MoviesTags' /*'MovieTag' => array('className' => 'MovieTag', 'foreignKey' => 'movie_id')*/);
/*	public $hasAndBelongsToMany = array(
												'Tag' => 
													array(
														'className' => 'Tag',
														'with' => 'MoviesTags',
														'associationForeignKey'  => 'movie_id',
														'fields' => 'Tag.tag'
													)
														
														);
 */
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
