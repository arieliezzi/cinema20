<?php
	namespace Controllers;

	use Models\Cinema as Cinema;
	use Models\Room as Room;
	use Models\Movie as Movie;
	use Models\Show as Show;

	class ShowController {

		public function index($message = "") {
			require_once(VIEWS_PATH."adm-list-cinema.php");
		}

		public function showListView($message = "") {
			require_once(VIEWS_PATH."adm-list-show.php");
		}	

		public function showAddView($message = "") {
			require_once(VIEWS_PATH."adm-add-show-cinema.php");
		}	

		public function showAddViewRoomSelect($message = "") {
			require_once(VIEWS_PATH."adm-add-show-room.php");
		}	

		public function showAddViewMovieSelect($message = "") {
			require_once(VIEWS_PATH."adm-add-show-movie.php");
		}	

		public function showAddViewScheduleSelect($message = "") {
			require_once(VIEWS_PATH."adm-add-show-schedule.php");
		}	

		public function showModifyView($idCinema,$message = "") {

			require_once(VIEWS_PATH."adm-modify-room.php");
		}	

		public function showCinemaRooms($idCinema,$message = "") {
			//Aca hay que poner todo lo necesario para crear un array de rooms en base al idCinema que le llega desde la otra view

			$id=1;
			$name="Sala 1";
			$capacity=100;
			$price=300;

			$room = new Room();
			$room->setId($id);
			$room->setName($name);
			$room->setCapacity($capacity);
			$room->setPrice($price);

			$roomList = array();
			array_push($roomList, $room);
			//Todo lo anterior es de prueba para que la view funcione, en el caso de hacer bien lo de arriba la view no hay que modificarla

			require_once(VIEWS_PATH."adm-list-room.php");
		}	

		public function Add($idCinema) {
			//Aca hay que poner todo lo necesario para que se agregue una sala al cine

			$this->showCinemaRooms($idCinema,"✔️ ¡Sala agregada con exito! Check ID CINEMA: ".$idCinema."");
		}	

		public function Update($idCinema,$idRoom) {
			//Aca hay que poner todo lo necesario para que se modifique una sala del cine

			$this->showCinemaRooms($idCinema,"✔️ ¡Sala Modificada con exito! Check ID CINEMA: ".$idCinema."");
		}	

		public function Remove($idCinema,$idRoom) {
			//Aca hay que poner todo lo necesario para que se elimine la sala

            $this->showCinemaRooms($idCinema,"✔️ ¡Sala eliminada con exito! Check ID CINEMA: ".$idCinema."");
        }
	}

?>