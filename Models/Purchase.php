<?php
	namespace Models;

	use Models\User as User;
	use Models\Screening as Screening;
	use Models\Card as Card;

	class Purchase {
		
		private $id;
		private $user;
		private $screening;
		private $price;
		private $card;
		private $quantity;

		public function setId($id) {
			$this->id = $id;
		}

		public function getId() {
			return $this->id;
		}

		public function setUser(User $user) {
			$this->user = $user;
		}

		public function getUser() {
			return $this->user;
		}

		public function setScreening(Screening $screening) {
			$this->screening = $screening;
		}

		public function getScreening() {
			return $this->screening;
		}

		public function setPrice($price) {
			$this->price = $price;
		}

		public function getPrice() {
			return $this->price;
		}

		public function setCard(Card $card) {
			$this->card = $card;
		}

		public function getCard() {
			return $this->card;
		}

		public function setQuantity($quantity) {
			$this->quantity = $quantity;
		}

		public function getQuantity() {
			return $this->quantity;
		}
		
		public function getQrInfo() {
			return $this->getId()."-".$this->getScreening()->getMovie()->getTitle()."-".$this->getScreening()->getCinema()->getName()."-".$this->getScreening()->getDate()."/".$this->getScreening()->getTime();
		}

	}
?>