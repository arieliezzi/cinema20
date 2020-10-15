<?php
	namespace Controllers;

	use Models\Movie as Movie;

	class MovieController {

		public function index($message = "") {
			require_once(VIEWS_PATH."adm-list-movies.php");
		}


		public function showListView($message = "") {
			require_once(VIEWS_PATH."adm-list-movies.php");
		}	

	}

?>