<?php
Class Sql
{
	protected $db;
	protected $sql;
	protected $selectVal;
	protected $fromVal;
	protected $joinVal;
	protected $whereVal;
	protected $groupVal;
	protected $havingVal;
	protected $orderVal;
	protected $limitVal;
	protected $insertVal;
	protected $valuesVal;
	protected $deleteVal;
	protected $updateVal;
	protected $setVal;
	
	public function select($what, $key=false)
	{
		if(!empty($what) && $what !== "*")
		{
			if($key == 'distinct')
			{ 
				$this->selectVal = "Select distinct `$what` ";
				return $this;
			}
			else
			{
				$this->selectVal = "Select `$what` ";
				return $this;
			}
		}
		else
		{
			throw new Exception("Empty select values");
		}
	}
	
	public function from($table)
	{
		if(!empty($table))
		{
			$this->fromVal = "from `$table` ";
			return $this;
		}
		else
		{
			throw new Exception("Empty from values");
		}
	}

	public function join($table, $key='join')
	{
		if(!empty($table) && !empty($key))
		{
			switch $key 
			{
				case "join" : $this->joinVal = "INNER JOIN `$table` ON ";
				return $this;
				break;
				case "leftJoin" : $this->joinVal = "LEFT OUTER JOIN `$table` ";
				return $this;
				break;
				case "rightJoin" : $this->joinVal = "RIGHT OUTER JOIN `$table` ";
				return $this;
				break;
				case "crossJoin" : $this->joinVal = "CROSS JOIN `$table`";
				return $this;
				break;
				case "naturalJoin" : $this->joinVal = "NATURAL JOIN `$table`";
				return $this;
				break;
				default: throw new Exception("Invalid join key");
			}
		}
		else
		{
			throw new Exception("Empty join values");
		}
	}
	
	public function whereOrOn($param1, $param2, $key='where', $math="=")
	{
		if(!empty($param1) && !empty($param2))
		{
			switch $math 
			{
				case "<" :  $operator = "<";
				break;
				case ">" :  $operator = ">";
				break;
				default: $operator = "=";
			}

			switch $key 
			{
				case "where" : $this->whereOrOnVal = "where `$param1` $operator '$param2' ";
				return $this;
				break;
				case "on" : $this->whereOrOnVal = "ON `$param1` $operator `$param2` ";
				return $this;
				break;
				default: throw new Exception("Invalid where key");
			}
		}
		else
		{
			throw new Exception("Empty whereOrOn values");
		}
	}

	public function group($param)
	{
		if(!empty($param))
		{
			$this->groupVal = "GROUP BY `$param` ";
			return $this;
		}
		else
		{
			throw new Exception("Empty group values");
		}
	}

	public function having($params)
	{
		if(!empty($params))
		{
			$this->havingVal = "HAVING $params ";
			return $this;
		}
		else
		{
			throw new Exception("Empty having values");
		}
	}

	public function order($param, $key)
	{
		if(!empty($param) && !empty($key) && ($key="DESC" || $key="ASC"))
		{
			$this->orderVal = "ORDER BY `$param` $key ";
			return $this;
		}
		else
		{
			throw new Exception("Wrong order values");
		}
	}

	public function limit($param)
	{
		if(!empty($param) && is_int($param))
		{
			$this->limitVal = "LIMIT $param ";
			return $this;
		}
		else
		{
			throw new Exception("Wrong limit values");
		}
	}
	
	public function insert($table, $col1, $col2)
	{
		
		if(!empty($table) && !empty($col1) && !empty($col2))
		{
			$this->insertVal = "INSERT INTO $table (`$col1`, `$col2`) ";
			return $this;
		}
		else
		{
			throw new Exception("Empty insert values");
		}
	}
	
	public function values($val1, $val2)
	{
		
		if(!empty($val1) && !empty($val2))
		{
			$this->valuesVal = "VALUES ('$val1', '$val2')";
			return $this;
		}
		else
		{
			throw new Exception("Empty value values");
		}
	}

	public function delete($table)
	{
		
		if(!empty($table))
		{
			$this->deleteVal = "DELETE FROM $table ";
			return $this;
		}
		else
		{
			throw new Exception("Empty delete values");
		}
	}
	
	public function update($table)
	{
		
		if(!empty($table))
		{
			$this->updateVal = "UPDATE $table ";
			return $this;
		}
		else
		{
			throw new Exception("Empty update values");
		}
	}

	public function set($col, $val)
	{
		
		if(!empty($col) && !empty($val))
		{
			$this->setVal = "SET `$col`='$val' ";
			return $this;
		}
		else
		{
			throw new Exception("Empty set values");
		}
	}
	
	public function exec()
	{		
		switch(TRUE)
		{
			case(!empty($this->selectVal) && !empty($this->whereVal)): $this->sql = $this->selectVal . $this->fromVal . $this->whereVal; break;
			case(!empty($this->selectVal)): $this->sql = $this->selectVal . $this->fromVal . $this->whereVal; break;
			case(!empty($this->insertVal)): $this->sql = $this->insertVal . $this->valuesVal; break;
			case(!empty($this->deleteVal)): $this->sql = $this->deleteVal . $this->whereVal; break;
			case(!empty($this->updateVal)): $this->sql = $this->updateVal . $this->setVal . $this->whereVal; break;
			default: throw new Exception("Wrong exec values");
		}
	}
	
	public function restartVal()
	{
		$this->selectVal = FALSE;
		$this->insertVal = FALSE;
		$this->updateVal = FALSE;
		$this->deleteVal = FALSE;
		$this->whereVal = FALSE;
	}
}
?>
