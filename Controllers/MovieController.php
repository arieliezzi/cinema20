<?php
	namespace Controllers;

	use Models\Movie as Movie;
	use DAO\MovieDAO as MovieDAO;

	class MovieController {

		public function index($message = "") {
			require_once(VIEWS_PATH."adm-list-internal-movies.php");
		}


		public function showListView($message = "") {
			$this->movieDAO = new movieDAO();
			$movieList = $this->movieDAO->getAll();
			require_once(VIEWS_PATH."adm-list-internal-movies.php");
		}	

		public function Remove($id)
        {
			$this->MovieDAO = new MovieDAO();
            $this->MovieDAO->Remove($id);

            $this->showListView("✔️ ¡Pelicula eliminada con exito!");
        }
	}

?>