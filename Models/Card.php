<?php

	namespace Models;

	class Card {

		private $id;
		private $number;
		private $type;
        
		public function setId($id) {
			$this->id = $id;
		}

		public function getId() {
			return $this->id;
		}

		public function setNumber($number) {
			$this->number = $number;
		}

		public function getNumber() {
			return $this->number;
		}

		public function setType($type) {
			$this->type = $type;
		}

		public function getType() {
			return $this->type;
		}

	}

?>