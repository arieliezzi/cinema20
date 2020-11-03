<?php
	namespace Controllers;

	use Models\Room as Room;
	use DAO\RoomDAODB as RoomDAODB;
	use DAO\CinemaDAODB as CinemaDAODB;

	class RoomController {

		public function index($message = "") {
			require_once(VIEWS_PATH."adm-list-cinema.php");
		}

		public function showAddView($idCinema,$message = "") {
			require_once(VIEWS_PATH."adm-add-room.php");
		}	

		public function showModifyView($idCinema,$idRoom) {
			$this->roomDAO = new RoomDAODB();
			$room = new Room;
			$room = $this->roomDAO->getById($idRoom);

			//Todo lo anterior es de prueba para que la view funcione, en el caso de hacer bien lo de arriba la view no hay que modificarla

			require_once(VIEWS_PATH."adm-modify-room.php");
		}	

		public function showCinemaRooms($idCinema,$message = "") {
			//Aca hay que poner todo lo necesario para crear un array de rooms en base al idCinema que le llega desde la otra view
            $roomList = array();
			$this->cinemaDAO = new CinemaDAODB();
			$cinema = $this->cinemaDAO->getById($idCinema);

			foreach($cinema->getRooms() as $room)
			{
              array_push($roomList,$room);
			}

			require_once(VIEWS_PATH."adm-list-room.php");
		}	

		public function Add($name,$capacity,$price,$idCinema) {
			//Aca hay que poner todo lo necesario para que se agregue una sala al cine
			$this->roomDAO = new RoomDAODB();
			$this->cinemaDAO = new CinemaDAODB();

			$room = new Room();

			$isActive=1;
			$room->setName($name);
            $room->setCapacity($capacity);
			$room->setPrice($price);
			$room->setIsActive($isActive);
			$this->roomDAO->add($room,$idCinema);

			$this->showCinemaRooms($idCinema,"✔️ ¡Sala agregada con exito!");
		}	

		public function Update($idCinema,$idRoom,$name,$capacity,$price) 
		{
			//Aca hay que poner todo lo necesario para que se modifique una sala del cine
			$this->roomDAO = new RoomDAODB();
				$updatedRoom = new Room();
				$updatedRoom->setId($idRoom);
				$updatedRoom->setName($name);
				$updatedRoom->setCapacity($capacity);
				$updatedRoom->setPrice($price);
	
				$this->roomDAO->update($updatedRoom);
			
			$this->showCinemaRooms($idCinema,"✔️ ¡Sala Modificada con exito!");
		}	

		public function Remove($idCinema,$idRoom) {
			//Aca hay que poner todo lo necesario para que se elimine la sala
			$this->RoomDAO = new RoomDAODB();
            $this->RoomDAO->Remove($idRoom);
            $this->showCinemaRooms($idCinema,"✔️ ¡Sala eliminada con exito!");
        }
	}

?>