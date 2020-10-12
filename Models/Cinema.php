<?php
	namespace Models;

	class Cinema {

		private $id;
		private $imageUrl;
		private $name;
		private $capacity;
		private $address;
		private $price;

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

		public function setCapacity($capacity) {
			$this->capacity = $capacity;
		}

		public function getCapacity() {
			return $this->capacity;
		}

		public function setAddress($address) {
			$this->address = $address;
		}

		public function getAddress() {
			return $this->address;
		}
		
		public function setPrice($price) {
			$this->price = $price;
		}

		public function getPrice() {
			return $this->price;
		}

		public function setImageUrl($imageUrl) {
			$this->imageUrl = $imageUrl;
		}

		public function getImageUrl() {
			return $this->imageUrl;
		}
		
	}
?>