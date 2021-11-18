<?php 

class DB{
    public $connection;
    function __construct($configs){
        // connect the database and save the connection into a property
        $this->connection = mysqli_connect($configs->host,$configs->username,$configs->password, $configs->dbname);
        if(!$this->connection){
            die("Connection failed: " . mysqli_connect_error());
        }
    }
    function query($sql, $debug=false){
        if($debug == true) echo $sql . "<br>";
        return mysqli_query($this->connection, $sql);
    }
}