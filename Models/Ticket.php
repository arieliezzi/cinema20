<?php
	namespace Models;

	use Models\User as User;
	use Models\Show as Show;
	use Models\Card as Card;

	class Ticket {
		
		private $id;
		private $user;
		private $show;
		private $price;
        private $cardType;
        private $cardNumber;
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

		public function setShow(Show $show) {
			$this->show = $show;
		}

		public function getShow() {
			return $this->show;
		}

		public function setPrice($price) {
			$this->price = $price;
		}

		public function getPrice() {
			return $this->price;
		}

		public function setQuantity($quantity) {
			$this->quantity = $quantity;
		}

		public function getQuantity() {
			return $this->quantity;
		}
		
        public function getCardType() {
                return $this->cardType;
        }

        public function setCardType($cardType) {
                $this->cardType = $cardType;

                return $this;
        }

        public function getCardNumber() {
                return $this->cardNumber;
        }

        public function setCardNumber($cardNumber) {
                $this->cardNumber = $cardNumber;

                return $this;
        }

        public function getQrInfo() {
			return $this->getId()."-".$this->getShow()->getMovie()->getTitle()."-".$this->getShow()->getCinema()->getName()."-".$this->getShow()->getStartDate()."/".$this->getShow()->getTime();
		}
	}
?>