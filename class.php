<?php

class Person
{
	private $name;
	private $dob;
	private $address;
	private $gender;

	public function __construct($name,$dob,$gender)
	{
		$this->name=$name;
		$this->dob=$dob;
		$this->gender=$gender;
		echo $this->name  . PHP_EOL;
	}

	public function show()
	{
		echo "<p>NAME is </p>" . $this->name . "<p>DOB is </p>" .$this->dob . "<p> Gender is </p>" . $this->gender;
	}
}

$person = new Person('raj','19/10/83','M');
$person->show();
