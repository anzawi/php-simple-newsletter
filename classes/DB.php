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
 * To see full features for this class and documentation visit this link
 * on arabic -> http://www.phptricks.org/pdo-class/
 * on engilsh -> https://github.com/anzawi/php-database-class
 */
class DB
 {
    /**
     * @var $_instace type object
     * store DB class object to allow one connection with database (deny duplicate)
     * @access private
     */
    private static $_instace;
    
    /**
     * @var $_pdo type object PDO object 
     * @var $_query type string store sql statement
     * @var $_results type array store sql statement result
     * @var $_count type int store row count for _results variable
     * @var $_error type bool if cant fetch sql statement = true otherwise = false
     */ 
    private $_pdo,
            $_query,
            $_results,
            $_count,
            $_error = false;
    
    /**
     * DB::__construct()
     * Connect with database
     * @access private
     * @return void
     */
    private function __construct()
    {
        try {
             $this->_pdo = new PDO("mysql:host=" . HOST . ";dbname=" . DB, USER, PASS);
              $this->_pdo->exec("set names " . CHARSET);
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }
    
    /**
     * DB::connect()
     * return instace 
     * @return object
     */
    public static function connect()
    {
        if(!isset(self::$_instace)) {
            self::$_instace = new DB();
        }
        
        return self::$_instace;
    }
    
    /**
     * DB::query()
     * check if sql statement is prepare 
     * append value for sql statement if $parame is set
     * featch results 
     * @param string $sql
     * @param array $params
     * @return mixed
     */
    public function query($sql, $params = array())
    {
        // set _erroe. true  to that if they can not be false for this function to work properly, this  function makes the value of _error false if there is no implementation of the sentence correctly
        $this->_error = false;
        // check if sql statement is prepared
        $this->_query = $this->_pdo->prepare($sql);
        // if $params isset
        if(count($params)) {
            /**
             *  @var $x type int
             * counter 
             */ 
            $x = 1;
            foreach($params as $param) {
                // append values to sql statement
                $this->_query->bindValue($x, $param);
                
                $x++;
            }
        }
        // check if sql statement executed
        if($this->_query->execute()) {
            // set _results = data comes 
            $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
            // set _count = count rows comes
            $this->_count = $this->_query->rowCount();
        } else {
            // set _error = true if sql statement not executed
            $this->_error = true;
        }
        
        return $this;
    }
    
    /**
     * DB::action()
     * do sql statements 
     * @uses action('table_name', 'SELECT *', array('id', '=', 5))
     * @param string $table
     * @param string $action
     * @param array $where
     * @param array $moreWhere
     * @return mixed
     */
    private function action($table, $action, $where = array(), $moreWhere = array())
    {
        // check if where = 3 fields (field, operator, value))
        if(count($where === 3)) {
            $field = $where[0]; // name of feild
            $operator = $where[1]; // operator 
            $value = $where[2]; // value of feild
            /**
             * @var $operators
             *  allowed operators
             */ 
            $operators = array('=', '<', '>', '<=', '>=', 'BETWEEN', 'LIKE');
            // check if operator user set is allowed
            if(in_array($operator, $operators)) {
                // do sql statement
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ? ";
                // check if query is not have errors
                if(!$this->query($sql, array($value))->error()) {
                    return $this;
                }
            }
        }
        return false;
    }
    
    /**
     * DB::insert()
     * insert into database tables
     * @param string $table
     * @param array $values
     * @return bool
     */
    public function insert($table, $values = array())
    {
        // check if $values set
        if(count($values)) {
            /**
             * @var $fields type array
             * store fields user want insert value for them
             */
            $fields = array_keys($values);
            /**
             * @var $value type string
             * store value for fields user want inserted
             */
            $value = '';
            /**
             *  @var $x type int
             * counter 
             */ 
            $x = 1;
            foreach($values as $field) {
                // add new value
                $value .="?";
                
                if($x < count($values)) {
                    // add comma between values
                    $value .= ", ";
                }
                $x++;
            }
             // generate sql statement
            $sql = "INSERT INTO {$table} (`" . implode('`,`', $fields) ."`)";
            $sql .= " VALUES({$value})";
            // check if query is not have an error
            if(!$this->query($sql, $values)->error()) {
                    return true;
             }
        }
        
        return false;
    }
    
    /**
     * DB::update()
     * 
     * @param string $table
     * @param array $values
     * @param array $where
     * @return bool
     */
    public function update($table, $values = array(), $where = array())
    {
        /**
         * @var $set type string
         * store update value 
         * @example "colomn = value"
         */
        $set = ''; // initialize $set
        $x = 1;
        // initialize feilds and values
        foreach($values as $i => $row) {
            $set .= "{$i} = ?";
            // add comma between values
            if($x < count($values)) {
                $set .= " ,";
            }
            $x++;
        }
        // generate sql statement
        $sql = "UPDATE {$table} SET {$set} WHERE {$where[0]} {$where[1]} {$where[2]}";
        // check if query is not have an error
        if(!$this->query($sql, $values)->error()) {
            return true;
        }
        
        return false;
    }
    
    /**
     * DB::delete()
     * delete row from table
     * @param string $table
     * @param array $where
     * @return bool
     */
    public function delete($table, $where = array())
    {
        // check if $where is set
        if(count($where)) {
            // call action method
            if($this->action($table, "DELETE", $where)) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * DB::error()
     * return _error variable
     * @return bool
     */
    public function error()
    {
        return $this->_error;
    }
    
    /**
     * DB::error()
     * return _results variable
     * @return array
     */
    
    public function results()
    {
        return $this->_results;
    }
    
    /**
     * DB::error()
     * return first key from results method
     * @return string
     */
    public function first()
    {
        return $this->results()[0];
    }
}
?>