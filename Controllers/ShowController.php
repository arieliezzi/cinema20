<?php
	namespace Controllers;

	use Models\Cinema as Cinema;
	use Models\Room as Room;
	use Models\Movie as Movie;
	use Models\Show as Show;
	use DAO\CinemaDAODB as CinemaDAODB;
	use DAO\RoomDAODB as RoomDAODB;
	use DAO\MovieDAODB as MovieDAODB;
	use DAO\ShowDAODB as ShowDAODB;

	class ShowController {

		public function index($message = "") {
			require_once(VIEWS_PATH."adm-list-cinema.php");
		}

		public function showListView($message = "") {
			$this->showDAO = new ShowDAODB();
			$showList = $this->showDAO->getAll();
			$showList = $this->ConstructShow($showList);


			require_once(VIEWS_PATH."adm-list-show.php");
		}	

		public function showAddView($message = "") {
			$this->cinemaDAO = new CinemaDAODB();
			$cinemaList = $this->cinemaDAO->getAll();

			require_once(VIEWS_PATH."adm-add-show-cinema.php");
		}	

		public function showAddViewRoomSelect($idCinema) {
			$this->roomDAO = new RoomDAODB();
			$roomList = $this->roomDAO->getAll($idCinema);
			require_once(VIEWS_PATH."adm-add-show-room.php");
		}	

		public function showAddViewMovieSelect($idCinema,$idRoom) {
			$this->movieDAO = new MovieDAODB();
			$movieList = $this->movieDAO->getAll();
			require_once(VIEWS_PATH."adm-add-show-movie.php");
		}	

		public function showAddViewScheduleSelect($idCinema,$idRoom,$idMovie) {
			require_once(VIEWS_PATH."adm-add-show-schedule.php");
		}	

		public function Add($idCinema,$idRoom,$idMovie,$startDate,$endDate,$time) {

			$this->showDAO = new ShowDAODB();
			$show = new Show();
			$show->setStartDate($startDate);
			$show->setEndDate($endDate);
			$show->setTime($time);
			$show->setCinema($idCinema);
			$show->setRoom($idRoom);
			$show->setMovie($idMovie);
			$show->setIsActive(true);

			$this->showDAO->add($show);
			$this->showListView("✔️ ¡Funcion agregado con exito!");
		}	


		public function Remove($idShow) {


            $this->showListView("✔️ ¡Funcion eliminada con exito!");
		}
		
		public function ConstructShow($showList) {
	
			$this->cinemaDAO = new CinemaDAODB();
			$this->roomDAO = new RoomDAODB();
			$this->movieDAO = new MovieDAODB();

			foreach ($showList as $show)
			{
				$show->setCinema($this->cinemaDAO->getById($show->getCinema()));
				$show->setRoom($this->roomDAO->getById($show->getRoom()));
				$show->setMovie($this->movieDAO->getById($show->getMovie()));
				array_push($showList, $show);
			}

            return $showList;
        }
	}

?>