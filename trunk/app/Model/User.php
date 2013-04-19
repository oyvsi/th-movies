<?php
class User extends AppModel {
  public $primaryKey = 'id';
    
    public $hasMany = array('Rating' => array('className' => 'Rating', 'foreignKey' => 'movie_rating_id'),
    						'Membership' => array('className' => 'Membership', 'foreignKey' => 'membership_id'));
    
    
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
            'rule' => 'notEmpty',
            'message' => 'Password cannot be empty'
          ),
          array(
            'rule' => array('minLength', 4),
            'message' => 'Must be at least 4 chars' 
          ),
          array(
            'rule' => array('passCompare'),
            'message' => 'The passwords do not match'
          )
      )
    );
    
    public function passCompare() {
        return ($this->data[$this->alias]['password'] === $this->data[$this->alias]['password_confirm']);        
    }
    
    public function beforeSave() {
        $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        return true;
    }
}