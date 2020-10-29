<?php
	namespace Models;

	class Room {

		private $id;
		private $name;
		private $capacity;
		private $price;
		private $shows;
		private $isActive;

		public function getId()
		{
				return $this->id;
		}

		public function setId($id)
		{
				$this->id = $id;

				return $this;
		}

		public function getName()
		{
				return $this->name;
		}

		public function setName($name)
		{
				$this->name = $name;

				return $this;
		}

		public function getCapacity()
		{
				return $this->capacity;
		}

		public function setCapacity($capacity)
		{
				$this->capacity = $capacity;

				return $this;
		}

		public function getPrice()
		{
				return $this->price;
		}

		public function setPrice($price)
		{
				$this->price = $price;

				return $this;
		}

		public function getShows()
		{
				return $this->shows;
		}

		public function setShows($shows)
		{
				$this->shows = $shows;

				return $this;
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