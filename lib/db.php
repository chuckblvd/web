<?php

define("OBJECT","OBJECT",true);
define("ARRAY_A","ARRAY_A",true);
define("ARRAY_N","ARRAY_N",true);

class db{

	function db($dbuser,$dbpassword,$dbname,$dbhost){
		$this->dbh = mysqli_connect($dbhost,$dbuser,$dbpassword);
		if (!$this->dbh){
			$this->print_error("<ol><b>Error establishing a database connection!</b><li>Are you sure you have the correct user/password?<li>Are you sure that you have typed the correct hostname?<li>Are you sure that the database server is running?</ol>");
		}
		$this->select($dbname);
	}

	function print_error($str=""){
		if(!$str)$str = mysqli_error($this->dbh);
		print "<blockquote><font face=arial size=2 color=ff0000>";
		print "<b>SQL/DB Error --</b> ";
		print "[<font color=000077>$str</font>]";
		print "</font></blockquote>";	
	}

	function select($db){
		if(!mysqli_select_db($this->dbh,$db)){
			$this->print_error("<ol><b>Error selecting database <u>$db</u>!</b><li>Are you sure it exists?<li>Are you sure there is a valid database connection?</ol>");
		}
	}

	function check_query($query,$output=OBJECT){
		$this->result = mysqli_query($this->dbh,$query);
		if(mysqli_error($this->dbh)){
			$this->print_error();
		}
	}

	function query($query,$output=OBJECT){
		$this->last_result = null;
		$this->check_query($query);
		if($this->result){	
			$i=0;
			while($row = mysqli_fetch_object($this->result)){ 
				$this->last_result[$i] = $row;
				$i++;
			}

			mysqli_free_result($this->result);
			if($i){
				return true;
			}
			else{
				return false;
			}
		}
	}

	function raw_query($query,$output=OBJECT){
		$this->result = mysqli_query($this->dbh,$query) or die(mysqli_error($this->dbh));
		if(mysqli_error($this->dbh)){
			$result = $this->print_error();
		}
		else{
			if($this->result){
				$result	= $query;
			}
		}
		return $result;
	}

	function get_row($query=null,$y=0,$output=OBJECT){
		if($query){
			$this->query($query);
		}
		if($output == OBJECT){
			return $this->last_result[$y]?$this->last_result[$y]:null;
		}
		elseif($output == ARRAY_A){
			return $this->last_result[$y]?get_object_vars($this->last_result[$y]):null;	
		}
		elseif($output == ARRAY_N){
			return $this->last_result[$y]?array_values(get_object_vars($this->last_result[$y])):null;
		}
		else{
			$this->print_error(" \$db->get_row(string query,int offset,output type) -- Output type must be one of: OBJECT, ARRAY_A, ARRAY_N ");	
		}
	}

	function get_var($query=null,$x=0,$y=0){
		if($query){
			$this->query($query);
		}
		if($this->last_result[$y]){
			$values = array_values(get_object_vars($this->last_result[$y]));
		}
		return $values[$x]?$values[$x]:null;
	}

	function get_results($query=null,$output=OBJECT){
		if($query){
			$this->query($query);
		}
		if($output == OBJECT){
			return $this->last_result; 
		}
		elseif($output == ARRAY_A || $output == ARRAY_N){
			if($this->last_result){
				$i=0;
				foreach($this->last_result as $row){
					$new_array[$i] = get_object_vars($row);
					if($output == ARRAY_N){
						$new_array[$i] = array_values($new_array[$i]);
					}
					$i++;
				}
				return $new_array;
			}
			else
			{
				return null;	
			}
		}
	}

	function insert($table_name,$values,$output=OBJECT){
		$query = "SELECT * FROM " . $table_name;
		$this->check_query($query);
		$query = "INSERT INTO ". $table_name . " VALUES(NULL";
		foreach($values as $col=>$value){
			$query .= ",'" . $value . "'";
		}
		$query .= ")";
		$this->check_query($query);
	}

	function update($table_name,$values,$id,$val,$output=OBJECT){
		$query = "SELECT * FROM " . $table_name;
		$this->check_query($query);
		$query = "UPDATE ". $table_name . " SET ";
		$i=1;
		foreach($values as $col=>$value){
			if($i == count($values)){
				$query .= $col . " = '". $value . "' ";
			}
			else{
				$query .= $col . " = '". $value . "', ";
			}
			$i++;
		}
		$query .= "WHERE " . $id . " = '" . $val . "'";
		$this->check_query($query);
	}


	function delete($table_name,$id,$val,$output=OBJECT){
		$query = "SELECT * FROM " . $table_name;
		$this->check_query($query);
		$query = "DELETE FROM " . $table_name . " WHERE " . $id . " = '" . $val . "'";
		$this->check_query($query);
	}

}
?>