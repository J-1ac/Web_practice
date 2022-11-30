<?php
/*
  Acts as an adapter for our database API so that all database api specific code
  will reside here in this class. In this example, we will use the mysqli (procedural) API. 
  

  NOTE: creating a generalized mysqli adapter class using prepared statements is way too
        complicated for the purposes of this exercise. As a consequence, this example takes
        a few shortcuts. Namely, it doesn't use prepared statements and instead assumes the
        user of this class is doing their own database parameter sanitization. PDO provides
        a much simpler approach to prepared statements that is amenable to generizalized approaches.
        
        While PDO allows you to add parameters one at a time, with mysqli the parameters need to be added one at a time  via arguments, e.g.
               mysqli_stmt_bind_param($statement, "issi", $arg1, $arg2, $arg3, ...);
        which isn't very amenable to a generalized solution that we are trying to
        achieve here.  
      
 
  Code inspired from:
     https://github.com/codeinthehole/domain-model-mapper
     http://www.devshed.com/c/a/PHP/PHP-Service-Layers-Database-Adapters/
 */
class DatabaseAdapterMysqli implements DatabaseAdapterInterface
{
   private $connection;
   private $lastStatement = null;   

    /**
     * Constructor is passed an array containing the following connection information:
     *   $values[0] -- database
     *   $values[1] -- user name
     *   $values[2] -- password
     *   $values[3] -- host
     */
   public function __construct($values)
   {
      $this->setConnectionInfo($values);
   }
   
    /**
     * sets the connection information and returns a valid PDO object. See constructor
     * for details about passed parameter
     */   
   public function setConnectionInfo($values=array()) {
      $database = $values[0];
      $user = $values[1]; 
      $password = $values[2];
      $host = $values[3];
      
      $this->connection = mysqli_connect($host, $user, $password, $database);
      if (mysqli_connect_errno()) {
         die( mysqli_connect_error() );
      }
   }
   
    /**
     * closes the connection
     */   
   public function closeConnection()   
   {
      mysqli_close($this->connection);
   }

    /**
     * Executes an SQL query and returns the prepared statement object
     */
    public function runQuery($sql, $parameters=array())
    {
       // see note at the top of this class
       
       $result = mysqli_query($this->connection, $sql);
       return $result;
    }

    /**
     * Wraps single quotes around a table or fieldname identifier
     */
    private function quoteIdentifier($identifier)
    {
        return sprintf("'%s'", $identifier);
    }


    /**
     * Returns a single field value
     *
     * @param string $sql The query to run
     * @param array $Parameters Parameter values to bind into query
     * @return string
     */
    public function fetchField($sql, $parameters=array())
    {
        return $this->fetchRow($sql, $parameters); 
    }

    /**
     * Returns a row
     *
     * @param string $sql The query to run
     * @param array $Parameters Parameter values to bind into query
     * @return array
     */
    public function fetchRow($sql, $parameters=array())
    {
        $result = $this->runQuery($sql, $parameters);
        return mysqli_fetch_row($result);
    }

    /**
     * Returns an array of rows
     *
     * @param string $sql The query to run
     * @param array $Parameters Parameter values to bind into query
     * @return array
     */
    public function fetchAsArray($sql, $parameters=array())
    {
        $result = $this->runQuery($sql, $parameters);
        return mysqli_fetch_array($result, MYSQLI_BOTH);
    }

    /**
     * Inserts data into a table
     *
     * @param string $tableName
     * @param array $Parameters A Hash of field name to value
     * @return PDOStatement
     */
    public function insert($tableName, $parameters=array())
    {
        // Extract fields and values from parameters
        $fields = array();
        $values = array();
        foreach ($parameters as $field => $value) {
            $fields[] = $this->quoteIdentifier($field);
            $values[] = '?';
        }
        // Construct SQL and execute
        $escapedTableName = $this->quoteIdentifier($tableName);
        $sql = sprintf("INSERT INTO %s (%s) VALUES (%s)", $escapedTableName, implode(', ', $fields), implode(', ', $values));
        return $this->runQuery($sql, array_values($parameters));
    }

    /**
     * Returns the last insert id
     */
    public function getLastInsertId()
    {
        return mysqli_insert_id($this->$connection);
    }

    /**
     * Executes an UPDATE statement
     *
     * @param string $tableName
     * @param array $updateParameters
     * @param string $whereCondition
     * @param array $whereParameters
     * @return int The number of rows affected
     */
    public function update($tableName, $updateParameters=array(), $whereCondition='', $whereParameters=array())
    {
        // Determine field assignments
        $assignments = array();
        $parameters = array();
        foreach ($updateParameters as $field => $value) {
            $placeHolder = strtolower($field);
            $assignments[] = sprintf("%s = %s", $this->quoteIdentifier($field), ":$placeHolder");
            $Parameters[$placeHolder] = $value;
        }
        // Construct SQL
        $escapedTableName = $this->quoteIdentifier($tableName);
        $sql = sprintf("UPDATE %s SET %s", $escapedTableName, implode(', ', $assignments));
        if ($whereCondition) {
            $sql .= " WHERE $whereCondition";
            $parameters = array_merge($parameters, $whereParameters);
        }
        $statement = $this->runQuery($sql, $parameters);
        
        // Return the number of rows affected
        return $this->getNumRowsAffected();
    }

    /**
     * Executes a DELETE statement
     *
     * Returns the number of rows deleted
     */
    public function delete($tableName, $whereCondition=null, $whereParameters=array())
    {
        $sql = sprintf("DELETE FROM %s ", $this->quoteIdentifier($tableName));
        $parameters = array(); 
        if ($whereCondition) {
            $sql .= "WHERE $whereCondition";
            $parameters = $whereParameters;
        }
        $statement = $this->runQuery($sql, $parameters);
        
        // Return the number of rows affected
        return $this->getNumRowsAffected();
    }

    /**
     * Begins a transaction
     */
    public function beginTransaction()
    {
        mysqli_autocommit($this->connection, FALSE);
    }
    
    /**
     * Commits current transaction
     */
    public function commit()
    {
        mysqli_commit($this->connection);
    }
    
    /**
     * Rolls back current transaction
     */
    public function rollBack()
    {
        mysqli_rollback($this->connection);
    }
    
    /**
     *  Returns the number of rows affected by the last SQL statement
     */
    public function getNumRowsAffected()
    {
        return mysqli_affected_rows($this->connection);
    }



}

?>