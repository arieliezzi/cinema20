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
			$this->cinemaDao = new CinemaDAO();
			$cinemaList = $this->cinemaDao->getAll();
			require_once(VIEWS_PATH."adm-list-cinema.php");
		}

		public function showAddCinema($message = "") {
			require_once(VIEWS_PATH."adm-add-cinema.php");
		}
		

		public function add($name, $capacity, $address, $price, $imageUrl) {
			$this->cinemaDao = new CinemaDAO();
			$cinema = new Cinema();
			$cinema->setName($name);
			$cinema->setCapacity($capacity);
			$cinema->setAddress($address);
			$cinema->setPrice($price);
			$cinema->setImageUrl($imageUrl);

			$this->cinemaDao->add($cinema);
			$this->showListCinema();
		}

		public function Remove($id)
        {
            $this->CinemaDAO->Remove($id);

            $this->showListCinema();
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
			$this->showListCinema();
		}

	}

?>