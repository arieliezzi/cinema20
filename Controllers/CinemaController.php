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


		public function add($name, $address,$capacity, $imageUrl) {
			$this->cinemaDAO = new CinemaDAODB();

			if (empty($imageUrl))
			{
				$imageUrl="/cinema2020/Views/default/images/image-not-found.png";
			}
			
			$cinema = new Cinema();
			$cinema->setName($name);
            $cinema->setAddress($address);
			$cinema->setCapacity($capacity);
			$cinema->setImageUrl($imageUrl);
			$cinema->setIsActive(1);

			if (!(empty($this->cinemaDAO->exist($cinema->getName()))))
            {
                $this->showListView("❌ ¡Ya hay un cine con ese mismo nombre, vuelva a ingresar!");
            } else 
            {
			$this->cinemaDAO->add($cinema);
			$this->showListView("✔️ ¡Cine agregado con exito!");}
		}

		public function Remove($id)
        {
			$this->CinemaDAO = new CinemaDAODB();
            $this->CinemaDAO->Remove($id);

            $this->showListView("✔️ ¡Cine eliminado con exito!");
        }

		public function update($id, $name, $address, $capacity, $imageUrl) {
			$this->cinemaDAO = new CinemaDAODB();
			$updatedCinema = new Cinema();
			$updatedCinema->setID($id);
			$updatedCinema->setName($name);
			$updatedCinema->setAddress($address);
			$updatedCinema->setCapacity($capacity);
			$updatedCinema->setImageUrl($imageUrl);


			$this->cinemaDAO->update($updatedCinema);
			$this->showListView("✔️ ¡Cine modificado con exito!");
		}

	}

?>