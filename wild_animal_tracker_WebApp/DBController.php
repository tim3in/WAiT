<?php


class DBController  {

	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "test";
		
	private $conn;
	
    function __construct() {
        $this->conn =  $this->connectDB();
	}	
	/********************************************************************************************/
	function connectDB() {
		$con = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $con;
	}
	/********************************************************************************************/
   	
	function getData(){
		$result = $this->conn->query("SELECT * FROM wild_animal_data ORDER By id DESC LIMIT 1");
   		$data = $result->fetch_assoc();
        $this->conn->close();
		return array($data['animal_detected'], $data['reading_time']); 
	}
	/********************************************************************************************/
       	
	function insertData($animal){
        
        $sql = "INSERT INTO wild_animal_data (animal_detected) VALUES ('". $animal ."')";
        $flag = $this->conn->query($sql);
        $this->conn->close();
        return $flag;
		
	}
	/********************************************************************************************/
          	
	function getJSON(){
        
        $data = array();
        $result = $this->conn->query("SELECT animal_detected, reading_time FROM wild_animal_data ORDER By id DESC LIMIT 15");
   		while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
     $this->conn->close();
      //convert to json
      $JSON_data = json_encode($data);
      echo $JSON_data; 
		
	}
	/********************************************************************************************/
    function countRecords(){
        
        
        $result = $this->conn->query("SELECT count(*) AS total_records FROM `wild_animal_data`");
   		$row = $result->fetch_assoc();
        
        return $row['total_records'];
      
		
	}
	/********************************************************************************************/
            	
	function getTop5Animals(){
        
        $i=0;
        $d="";
        $data = array();
        $result = $this->conn->query("SELECT animal_detected, count(*) as Total FROM `wild_animal_data` GROUP BY animal_detected ORDER BY Total DESC LIMIT 5");
   		while($row = $result->fetch_assoc()){
            $d .= $row['animal_detected'] . ": " . number_format(($row['Total']*100)/$this->countRecords(), 2) . "%;  "; 
        }
        
        $JSON_data = json_encode($data);
        echo $d;
	}
	/********************************************************************************************/
	
} //class
?>