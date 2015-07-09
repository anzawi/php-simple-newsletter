<?php
#---------------------------------------------------------------------------#
# this Project Created by Mohammad Anzawi                                   #
#                                                                           #
# This project is intended for beginners and learners                       #
# The main objective of this project is to see the way do something similar,#
#  such as sending messages via e-mail, files Read the content and create   #
#  templates or other                                                       #
#   and saved on the server within a specific folder.                       #
# Can anyone who want to modify or development (add some functions, styles),# 
# and use it in his dite, or commercially.                                  #
#                                                                           #
#  so if you have any question -> ask me on m.anzawi2013@gmail.com          #
# or visit my blog on http://www.phptricks.org                              #
#---------------------------------------------------------------------------#

/**
 * Subscribe
 * 
 * @package newsletter
 * @author Mr Mohammad Anzawi
 * @copyright 2015
 * @version 1.0.0
 * @access public
 */
class Subscribe
{

    /**
     *
     * @var object  $_db DB object
     * @var array  $_errors to save any error happened 
     */
    private
            $_db,
            $_errors = array();

    /**
     *  __construct
     * get $_db initial value
     */
    public function __construct() {
        $this->_db = DB::connect();
    }

    /**
     * exist
     * check if subscriber exist or not
     * @param mixed $param
     * @return boolean
     */
    // use query function from DB class
    private function exist($param = null) {
        // check if $param is number then get subscriber by id
        if(is_numeric($param)) {
            $user = $this->_db->query("SELECT * FROM subscribers WHERE u_id = ?",
                            array($param))->results();
            if(count($user)) {
                return true;
            }
            // if enter this else then the $param is string so get user by email
        } else {
            $user = $this->_db->query("SELECT * FROM subscribers WHERE u_email = ?",
                            array($param))->results();
            if(count($user)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Subscribe::add()
     * function to add new subscriber
     * @param array $data
     * @return boolean
     */
    protected function add($data = array()) {
        // if data isset
        if(count($data)) {
            // if subscriber have this email is not exist add new subscriber
            if(!$this->exist($data['u_email'])) {
                if($this->_db->insert('subscribers', $data)) {
                    return true;
                } else {
                    // if unable to insert new record add this error
                    $this->_errors[] = "Unknow Error";
                    return false;
                }
            }
            // if user exist add this error
            $this->_errors[] = "this Subscriber alredy exist";
        }

        return false;
    }

    /**
     * Subscribe::delete()
     * delete subscriber
     * @param integer $id
     * @return boolean
     */
    // use delete method from DB class 
    public function delete($id = 0) {

        // check if subscriber not exist add error and return false
        if($this->exist($id)) {
            // if $id is number
            if(is_numeric($id)) {
                // delete subscriber
                if($this->_db->delete('subscribers', array('u_id', '=', $id))) {
                    return true;
                }
            }
            // if unable to delete record add this error
            $this->_errors[] = "Unknow Error";
            return false;
        }

        $this->_errors[] = "this Subscriber is  not exist ";
        return false;
    }

    /**
     * Subscribe::update()
     * update subscriber
     * use like this : 
     * $subscriber->update(
     *                      array(
     *                            'u_id'=>$user_id, ## u_id required
     *                              ....
     *                            )
     *                      );
     * @param array $data
     * @return boolean
     */
    // use update method from DB class
    public function update($data = array()) {
        if(count($data)) {
            // if subscriber not exist add error and return false 
            if(!$this->exist($data['u_id'])) {
                $this->_errors[] = "this Subscriber is not exist";
                return false;
            }
            // update subscriber
            if($this->_db->update('subscribers', $data,
                            array('u_id', '=', $data['u_id']))) {
                return true;
            }
        }

        // if cant update record add this error
        $this->_errors[] = "Unknow Error";
        return false;
    }

    /**
     * un subscribe users
     * @param integer $id
     * @return boolean
     */
    public function unSubscribe($id = 0) {

        // if not isset $id  or is not number return false
        
        if($id && is_numeric($id) && $this->exist($is)) {
            // update active colomn to 0 for subscriber 
            
            // you can delete it or save it in other table
            if($this->_db->update('subscribers', array('active' => '0'),
                            array('u_id', '=', $id))) {
                return true;
            }
        }

        return false;
    }

    /**
     * return errors
     * @return array
     */
    public function errors() {
        return $this->_errors;
    }

    
    public function getAllSubscribers($where = '') {
        return $this->_db->query("SELECT * FROM subscribers {$where}")->results();
    }
}
