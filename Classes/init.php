<?php
  
  require "Connections.php";

  class Operation extends Database
  {
  
  	public function selectAll($tableName)  
  	{
  		$conn = $this->connect();
  		$sql = "SELECT * FROM $tableName "; 
  		$result = $conn->query($sql); 
  		return $result;             
  	}

  	public function select_with_join($columns,$tableName1,$tableName2,$join,$onConditon)
  	{
       $conn = $this->connect();
       $sql = "SELECT $columns FROM $tableName1 $join $tableName2 ON  $onConditon"; // query for user  
       $result = $conn->query($sql);
       return $result;
  	}

    public function select_with_join_condition($columns,$tableName1,$tableName2,$join,$onConditon,$whereConditon)
    {
       $conn = $this->connect();
       $sql = "SELECT $columns FROM $tableName1 $join $tableName2 ON  $onConditon WHERE $whereConditon"; // query for user  
       $result = $conn->query($sql);
       return $result;
    }

    public function select_with_condition($columns,$tableName,$whereConditon)
    {
       $conn = $this->connect();
       $column = implode(',', $columns);
       $sql = "SELECT $column FROM $tableName WHERE $whereConditon";
       $result = $conn->query($sql);
       return $result;
    }

     public function select_with_multiple_condition($columns,$tableName,$whereConditon1,$operator,$whereConditon2)
    {
       $conn = $this->connect();
       $column = implode(',', $columns);  
       $sql = "SELECT $column FROM $tableName WHERE $whereConditon1 $operator $whereConditon2";
       $result = $conn->query($sql);
       return $result;
    }

     public function select_with_multiple_conditions($columns,$tableName,$whereConditon1,$operator,$whereConditon2,$whereConditon3)
    {
       $conn = $this->connect();
       $column = implode(',', $columns); 
        $sql = "SELECT $column FROM $tableName WHERE $whereConditon1 $operator $whereConditon2 $operator $whereConditon3";
       $result = $conn->query($sql);
       return $result;
    }

    public function select_with_condition_orderby($columns,$tableName,$whereConditon,$orderByColumn,$asc_decs)
    {
       $conn = $this->connect();
       $column = implode(',', $columns);
       $sql = "SELECT $column FROM $tableName WHERE $whereConditon ORDER BY $orderByColumn $asc_decs";
       $result = $conn->query($sql);
       return $result; 
    }

    public function select_with_multiple_condition_orderby($columns,$tableName,$whereConditon1,$operator,$whereConditon2,$orderByColumn,$asc_decs)
    {
       $conn = $this->connect();
       $column = implode(',', $columns);
       $sql = "SELECT $column FROM $tableName WHERE $whereConditon1 $operator $whereConditon2 ORDER BY $orderByColumn $asc_decs";
       $result = $conn->query($sql);
       return $result; 
    }

    public function update($tableName,$columns,$whereConditon)
    {
        $conn = $this->connect();
        $column = implode(',', $columns);
        $sql = "UPDATE $tableName set $column WHERE $whereConditon"; 
        $result = $conn->query($sql);
        return $result;
    } 

    public function insert($tableName,$columns,$columnsValues)
    {
        $conn = $this->connect();
        $column = implode(',', $columns);
        $columnsValue = implode(',', $columnsValues);
        $sql = "INSERT INTO $tableName ($column) VALUES ($columnsValue)";
        $result = $conn->query($sql);
        return $result;
    }

    public function delete($tableName,$whereConditon)
    {
        $conn = $this->connect();
        $sql = "DELETE from $tableName WHERE $whereConditon";
        $result = $conn->query($sql);
        return $result;
    }

    
  }
?>