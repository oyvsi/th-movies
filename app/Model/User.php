<?php
class User extends AppModel {
  public $primaryKey = 'id';
    
    public $hasMany = array('Rating' => array('className' => 'Rating', 'associationForeignKey' => 'movie_rating_id'),
    								 'Membership' => array('className' => 'Membership', 'associationForeignKey' => 'membership_id'));
    
    
    public $validate = array(
      'username' => array(
          array(
            'rule' => 'notEmpty',
            'message' => 'Username cannot be empty'
          ),
          array(
            'rule' => 'isUnique',
            'message' => 'This username is already taken'
          )          
      ),
      'password' => array(
          array(
            	'on' => 'create',
            	'rule' => 'notEmpty',
            	'message' => 'Password cannot be empty'
          ),
          array(
          	'on' => 'update',
          	'allowEmpty' => true,
          	'rule' => 'notEmpty'
          ),    
          array(
            'rule' => array('minLength', 4),
            'message' => 'Must be at least 4 chars' 
          ),
          array(
          	'on' => 'create',
            'rule' => array('passCompare'),
            'message' => 'The passwords do not match'
          ),
           array(
          	'on' => 'update',
            'rule' => array('passCompare'),
            'message' => 'The passwords do not match'
          )
      )
    );
    
    public function passCompare() {
        return ($this->data[$this->alias]['password'] === $this->data[$this->alias]['password_confirm']);        
    }
    //exchanging the code beneath to make it compable to PHP 5.4
    // "$optoins = array()" was not there before.
    public function beforeSave($options = array()) {
      if (isset($this->data[$this->alias]['password'])) {
        $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }

        //exchanging the code beneath to make it compable to PHP 5.4
        //$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        return true;
    }
}
