<?php
Class Sql
{
	protected $data = array();

	public function select($what, $key=false)
	{
		$this->data = array();

		if(!empty($what) && $what !== "*")
		{
			if($key == 'distinct')
			{ 
				$this->data['selectVal'] = "Select distinct $what ";
				return $this;
			}
			else
			{
				$this->data['selectVal'] = "Select $what ";
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
			$this->data['fromVal'] = "from $table ";
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
			switch ($key)
			{
				case "join" : $this->data['joinVal'] = "INNER JOIN $table ";
				return $this;
				break;
				case "leftJoin" : $this->data['joinVal'] = "LEFT OUTER JOIN $table ";
				return $this;
				break;
				case "rightJoin" : $this->data['joinVal'] = "RIGHT OUTER JOIN $table ";
				return $this;
				break;
				case "crossJoin" : $this->data['joinVal'] = "CROSS JOIN $table";
				return $this;
				break;
				case "naturalJoin" : $this->data['joinVal'] = "NATURAL JOIN $table";
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
			switch ($math) 
			{
				case "<" :  $operator = "<";
				break;
				case ">" :  $operator = ">";
				break;
				default: $operator = "=";
			}

			switch ($key) 
			{
				case "where" : $this->data['whereOrOnVal'] = "where $param1 $operator '$param2' ";
				return $this;
				break;
				case "on" : $this->data['whereOrOnVal'] = "ON $param1 $operator $param2 ";
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
			$this->data['groupVal'] = "GROUP BY $param ";
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
			$this->data['havingVal'] = "HAVING $params ";
			return $this;
		}
		else
		{
			throw new Exception("Empty having values");
		}
	}

	public function order($param, $key)
	{
		if(!empty($param) && !empty($key) && ($key == "asc" or $key == "desc"))
		{
			$this->data['orderVal'] = "ORDER BY $param $key ";
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
			$this->data['limitVal'] = "LIMIT $param ";
			return $this;
		}
		else
		{
			throw new Exception("Wrong limit values");
		}
	}
	
	public function insert($table, $col1, $col2)
	{
		$this->data = array();

		if(!empty($table) && !empty($col1) && !empty($col2))
		{
			$this->data['insertVal'] = "INSERT INTO $table ($col1, $col2) ";
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
			$this->data['valuesVal'] = "VALUES ('$val1', '$val2')";
			return $this;
		}
		else
		{
			throw new Exception("Empty value values");
		}
	}

	public function delete($table)
	{
		$this->data = array();

		if(!empty($table))
		{
			$this->data['deleteVal'] = "DELETE FROM $table ";
			return $this;
		}
		else
		{
			throw new Exception("Empty delete values");
		}
	}
	
	public function update($table)
	{
		$this->data = array();

		if(!empty($table))
		{
			$this->data['updateVal'] = "UPDATE $table ";
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
			$this->data['setVal'] = "SET $col = '$val' ";
			return $this;
		}
		else
		{
			throw new Exception("Empty set values");
		}
	}
	
	public function exec()
	{		
		foreach($this->data as $kay => $val)
		{
			$kay?$str .= $val:false;
		}

		$this->data['sql'] = $str;
		return $this->data['sql'];
	}
}
?>
