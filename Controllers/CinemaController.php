<?php
	namespace Controllers;

	use Models\Cinema as Cinema;
	use DAO\CinemaDAO as CinemaDAO;

	class CinemaController {

		private $cinemaDao;

		public function index($message = "") {
			require_once(VIEWS_PATH."adm-add-cinema.php");
		}

		public function showListCinema($message = "") {
			require_once(VIEWS_PATH."adm-list-cinema.php");
		}

		public function showAddCinema($message = "") {
			require_once(VIEWS_PATH."adm-add-cinema.php");
		}
		
		public function showListView() {
			$this->cinemaDao = new CinemaDAO();
			$cinemaList = $this->cinemaDao->getAll();
			require_once(VIEWS_PATH."adm-list-cinema.php");
		}

		public function add($name, $capacity, $address, $price) {
			$this->cinemaDao = new CinemaDAO();
			$cinema = new Cinema();
			$cinema->setName($name);
			$cinema->setCapacity($capacity);
			$cinema->setAddress($address);
			$cinema->setPrice($price);

			$this->cinemaDao->add($cinema);
			$this->showListView();
		}

		public function delete($id) {
			$this->cinemaDao = new CinemaDAO();
			$isUsed = $this->cinemaDao->isUsed($id);
			if( $isUsed != 0) {
				echo "Can't remove that cinema, because has Screenings asociated";
			} else {
				$this->cinemaDao->remove($id);
			}
			$this->showListView();
		}

		public function update($id,$name, $capacity, $adress, $value) {
			$this->cinemaDao = new CinemaDAO();
			$updatedCinema = Cinema();
			$updatedCinema->setID($id);
			$updatedCinema->setName($name);
			$updatedCinema->setCapacity($capacity);
			$updatedCinema->setAdress($adress);
			$updatedCinema->setValue($value);

			$this->cinemaDao->update($updatedCinema);
			$this->showListView();
		}

	}

?>