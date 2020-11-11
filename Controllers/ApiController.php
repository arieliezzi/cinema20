<?php
    namespace Controllers;

    use DAO\GenreDAODB as GenreDAODB;
    use DAO\MovieDAODB as MovieDAODB;
    use DAO\ApiDAODB as ApiDAODB;

    class ApiController
    {
        public function index($message = "") {
			require_once(VIEWS_PATH."adm-list-api-movies.php");
		}

        public function showListView($message = "", $genreID = "")
        {
            $this->ApiDAODB = new ApiDAODB();
            $this->genreDAO = new GenreDAODB();
          
            $movieList = $this->ApiDAODB->getMoviesApi($genreID);
            $genreList = $this->genreDAO->getAll();

			require_once(VIEWS_PATH."adm-list-api-movies.php");
        }	

        public function getGenresFromAPI()
        {
            $this->ApiDAODB = new ApiDAODB();
            $this->GenreDAODB = new GenreDAODB();
            $genresList = $this->ApiDAODB->getGenresApi();
            foreach ($genresList as $genre)
            {
                $this->GenreDAODB->Add($genre);
            }
        }

        public function addMovie($id,$genreID)
        {
        $this->movieDAO = new movieDAODB();
        $this->apiDAO = new ApiDAODB();
        $movieList = $this->apiDAO->getMoviesApi($genreID);

        foreach ($movieList as $movie) {
            if ($movie->getId() == $id) {
                if ($this->movieDAO->exist($movie->getId())) {
                    if (($this->movieDAO->isActive($movie->getId()))) {
                        $this->showListView("❌ Error al agregar la pelicula, ya persiste.", $genreID);
                    } else {
                        $this->movieDAO->restore($movie->getId());
                        $this->showListView("⚠️ ¡Pelicula restaurada con exito!", $genreID);
                    }
                } else {
                    $this->movieDAO->add($movie);
                    $this->showListView("✔️ ¡Pelicula agregada con exito!", $genreID);
                }
            }
        }
    }
}
?>