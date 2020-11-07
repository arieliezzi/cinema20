<?php
	namespace Models;

	class User {

		private $id;
		private $name;
		private $pass;
		private $email;
		private $isActive;

		public function setId($id) {
			$this->id = $id;
		}

		public function getId() {
			return $this->id;
		}

		public function setName($name) {
			$this->name = $name;
		}

		public function getName() {
			return $this->name;
		}

		public function setPass($pass) {
			$this->pass = $pass;
		}

		public function getPass() {
			return $this->pass;
		}

		public function setEmail($email) {
			$this->email = $email;
		}

		public function getEmail() {
			return $this->email;
		}


		public function getIsActive()
		{
				return $this->isActive;
		}

		public function setIsActive($isActive)
		{
				$this->isActive = $isActive;

				return $this;
		}
	}
	
?>