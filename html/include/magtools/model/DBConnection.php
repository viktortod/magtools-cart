<?php
/**
 * Implementation of the comunication with database
 * @final
 */
final class DBConnection{

    private $link;


    public function __construct() {
        $this->link = null;
    }

    /**
     * Connects to the database
     * @param array $db array of configs(host, user, password, database)
     * @return boolean if not successfull
     */
    public function connect($db) {
        $this->link = mysql_connect($db['host'], $db['user'], $db['password']);
        
        if(mysql_select_db($db["database"]))
            mysql_set_charset('utf8');
        else
            return false;
        
    }

    /**
     * Executes a query to the database
     * @param string $sql the query string
     * @return resource
     */
    public function query($sql) {
        if(($qresult = mysql_query($sql)) != false){
            return $qresult;
        }
        else{
            throw new Exception('Error in query '.$sql.'[ERROR]: '.  mysql_error());
        }
        
    }

    /**
     * fetches as array the result of the query
     * @param string $sql the query string
     * @return array
     */
    public function fetch($sql) {
        if ($qresult = mysql_query($sql)) {

            $result_array = mysql_fetch_array($qresult, MYSQL_ASSOC);

            if( count($result_array) > 0){
                mysql_free_result($qresult);

                return $result_array;
            }
            else{
                throw new Exception('Fetching returned empty set');
            }
            
        }
        else{
            throw new Exception('Error in query '.$sql.'[ERROR]: '.  mysql_error());
        }
    }

    /**
     * Fetches an sql query and group it into associative array
     * @param string $sql the given string
     * @return array
     */
    public function fetchGroup($sql){
        if ($qresult = $this->query($sql)) {
            $result = array();
            while ($row = mysql_fetch_array($qresult ) ) {

                $result[$row[0]] = $row[1];
            }

            mysql_free_result($qresult);

            return $result;
        } else {
            throw new Exception('Error in query '.$sql.'<br />The text of the query is: '.  mysql_error());
        }
    }

    /**
     * Fetches all records in the result of the sql query
     * @param string $sql query string
     * @return array
     */
    public function fetchAll($sql) {
        if ($qresult = $this->query($sql)) {

            $result = array();
            while ($row = mysql_fetch_array($qresult, MYSQL_ASSOC)) {
                $result[] = $row;
            }
//            dump($result[1]);
            mysql_free_result($qresult);

            return $result;
        } else {
            throw new Exception('Error in query '.$sql.'<br />The text of the query is: '.  mysql_error());
        }
    }

    /**
     * Fetch a query into associative array
     * @param string $sql the given query string
     * @param string $column_key key of the result
     * @param string $column_value key of the row
     * @return array
     */
    public function fetchColumn($sql, $column_key, $column_value) {
        if ($qresult = $this->query($sql)) {
            $result = array();
            while ($row = mysql_fetch_array($qresult, MYSQL_ASSOC)) {
                $result[$row[$column_key]] = $row[$column_value];
            }

            return $result;
        } else {
            throw new Exception('Error in query '.$sql.'<br />The text of the query is: '.  mysql_error());
        }
    }

    public function __destruct() {
        @mysql_close($this->link);
    }

}

?>