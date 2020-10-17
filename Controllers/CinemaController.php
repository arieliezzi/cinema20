<?php
	namespace Controllers;

	use Models\Cinema as Cinema;
	use DAO\CinemaDAO as CinemaDAO;

	class CinemaController {

		private $cinemaDAO;

		public function index($message = "") {
			require_once(VIEWS_PATH."adm-add-cinema.php");
		}

		public function showAddView($message = "") {
			require_once(VIEWS_PATH."adm-add-cinema.php");
		}

		public function showListView($message = "") {
			$this->cinemaDAO = new CinemaDAO();
			$cinemaList = $this->cinemaDAO->getAll();
			require_once(VIEWS_PATH."adm-list-cinema.php");
		}	

		public function showModifyView ($id) {
			$this->cinemaDAO = new CinemaDAO();
			$cinema = $this->cinemaDAO->GetById($id);
		
			require_once(VIEWS_PATH."adm-modify-cinema.php");
		}		


		public function add($name, $capacity, $address, $price, $imageUrl) {
			$this->cinemaDAO = new CinemaDAO();
			$cinema = new Cinema();
			$cinema->setName($name);
			$cinema->setCapacity($capacity);
			$cinema->setAddress($address);
			$cinema->setPrice($price);
			$cinema->setImageUrl($imageUrl);

			$this->cinemaDAO->add($cinema);
			$this->showListView();
		}

		public function Remove($id)
        {
			$this->CinemaDAO = new CinemaDAO();
            $this->CinemaDAO->Remove($id);

            $this->showListView();
        }

		public function update($id,$name, $address, $capacity, $price, $imageUrl) {
			$this->cinemaDAO = new CinemaDAO();
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