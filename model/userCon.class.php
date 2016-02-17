<?php

class userCon
{
	private $_name;
	private $_email;
	private $_id;

	public function __construct()
	{
		$ctp = func_num_args();
		$args = func_get_args();
		switch ($ctp) {
			case 3:
				$this->construct1($args[0], $args[1], $args[2]);
				break;
			case 1:
				$this->construct2($args[0]);
			default:
				break;
		}
	}

	private function construct1($id, $name, $email)
	{
		$this->_id = $id;
		$this->_name = $name;
		$this->_email = $email;
	}

	private function construct2($serial)
	{
		$arr = unserialize($serial);
		$this->_name = $arr["_name"];
		$this->_id = $arr["_id"];
		$this->_email = $arr["_email"];
	}

	public function getName()
	{
		if (isset($this->_name))
			return $this->_name;
		else
			return "name undefined";
	}

	public function getId()
	{
		if (isset($this->_id))
			return $this->_id;
		else
			return -1;
	}

	public function getEmail()
	{
		if (isset($this->_email))
			return $this->_email;
		else
			return "err";
	}
	public function serializeClasse()
	{
		return serialize(array("_name" => $this->getName(), "_id" => $this->getId(), "_email" => $this->getEmail()));
	}

}

?>