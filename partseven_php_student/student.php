<?php

class Student
{
	private $fname, $lname, $sid, $courses;

	function __construct($f, $l, $id, $c)
	{
		$this->setFirstName($f);
		$this->setLastName($l);
                $this->setStudentID($id);
                $this->setCourses($c);
	}

	function setFirstName($f)
	{
		$this->fname = $f;
	}

	function setLastName($l)
        {
                $this->lname = $l;
        }

	function setStudentID($id)
        {
                $this->sid = $id;
        }

	function setCourses($c)
        {
                $this->courses = $c;
        }

	function getFirstName()
	{
		return $this->fname;
	}

	function getLastName()
        {
                return $this->lname;
        }

	function getStudentID()
        {
                return $this->sid;
        }

	function getCourses()
        {
                return $this->courses;
        }

}
?>
