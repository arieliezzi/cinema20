<?php
	namespace Controllers;

	use Models\Cinema as Cinema;
	use DAO\CinemaDAODB as CinemaDAODB;

	class CinemaController {

		private $cinemaDAO;

		public function index($message = "") {
			require_once(VIEWS_PATH."adm-add-cinema.php");
		}

		public function showAddView($message = "") {
			require_once(VIEWS_PATH."adm-add-cinema.php");
		}

		public function showListView($message = "") {
			$this->cinemaDAO = new CinemaDAODB();
			$cinemaList = $this->cinemaDAO->getAll();
			require_once(VIEWS_PATH."adm-list-cinema.php");
		}	

		public function showModifyView ($id) {
			$this->cinemaDAO = new CinemaDAODB();
			$cinema = $this->cinemaDAO->GetById($id);
		
			require_once(VIEWS_PATH."adm-modify-cinema.php");
		}		


		public function add($name,$address, $capacity, $price, $imageUrl) {
			$this->cinemaDAO = new CinemaDAODB();
			$cinema = new Cinema();
			$cinema->setName($name);
			$cinema->setAddress($address);
			$cinema->setCapacity($capacity);
			$cinema->setPrice($price);
			$cinema->setImageUrl($imageUrl);

			$this->cinemaDAO->add($cinema);
			$this->showListView();
		}

		public function Remove($id)
        {
			$this->CinemaDAO = new CinemaDAODB();
            $this->CinemaDAO->Remove($id);

            $this->showListView();
        }

		public function update($id,$name, $address, $capacity, $price, $imageUrl) {
			$this->cinemaDAO = new CinemaDAODB();
			$updatedCinema = new Cinema();
			$updatedCinema->setID($id);
			$updatedCinema->setName($name);
			$updatedCinema->setAddress($address);
			$updatedCinema->setCapacity($capacity);
			$updatedCinema->setPrice($price);
			$updatedCinema->setImageUrl($imageUrl);


			$this->cinemaDAO->update($updatedCinema);
			$this->showListView();
		}

	}

?>