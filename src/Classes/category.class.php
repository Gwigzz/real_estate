<?php
/*
 * Class Category
 */

class Category
{
	private $id;
	private $value;

	public function __construct(array $data)
	{
		foreach ($data as $key => $value) {
			$method = 'set' . ucfirst($key);

			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

	/**
	 * GetIdCategory
	 *
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * SetIdCategory
	 *
	 * @param integer $id
	 * @return object Category
	 */
	public function setId(int $id)
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * GetValue
	 *
	 * @return string
	 */
	public function getValue()
	{
		return $this->title;
	}

	/**
	 * SetValuue
	 *
	 * @param integer $int
	 * @return object Category
	 */
	public function setValue(string $str)
	{
		$this->title = $str;
		return $this;
	}
}
