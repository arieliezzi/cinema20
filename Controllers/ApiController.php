<?php
    namespace Controllers;

    use Models\Movie as Movie;
    use Models\Genre as Genre;
    use DAO\GenreDAO as GenreDAO;
    use DAO\MovieDAO as MovieDAO;

    class ApiController
    {
        public function index($message = "") {
			require_once(VIEWS_PATH."adm-list-api-movies.php");
		}


		public function showListView($message = "") {
           
              $movieList = $this->getMoviesApi($message);
              $this->genreDAO = new GenreDAO();
              $genreList = $this->genreDAO->getAll();

			require_once(VIEWS_PATH."adm-list-api-movies.php");
		}	

        public function getMoviesApi($message = "")
        {
            $movieList = array();
            if ($message==NULL)
            {
                $movieList = $this->getMovies("https://api.themoviedb.org/3/movie/now_playing?page=1&language=es-Ar&api_key=a7580011981ddc91268a6ad5022a8ec7", $movieList);     
            } 
            else
            {
                $movieList = $this->getMovies("https://api.themoviedb.org/3/movie/now_playing?page=1&language=es-Ar&with_genres=".$message."&api_key=a7580011981ddc91268a6ad5022a8ec7", $movieList);  
            }
    
            return $movieList;
        }

        public function addMovie($id)
        {
        $movieList = $this->getMoviesApi();

        $this->movieDAO = new movieDAO();
        $internalMovieList = $this->movieDAO->getAll();
        $state=0;

        foreach($movieList as $movie)
        {
            if ($movie->getId()==$id)
            {
                foreach($internalMovieList as $internal)
                {
                    if ($internal->getId()==$movie->getId())
                    {
                        $state=1;
                    }
                }
                
                if ($state==0)
                {
                    $this->movieDAO = new MovieDAO();
                    $this->movieDAO->add($movie);
                }
            }
        }

        $this->showListView();
        }

        private function getMovies($url, $movieList)
        {
            $response = file_get_contents($url);
        
            $movieDao = new MovieDAO();

            $arrayToDecode = ($response) ? json_decode($response, true) : array();

            foreach($arrayToDecode["results"] as $row)
            {
                $movie = new Movie();
                $movie->setId($row["id"]);
                $movie->setTitle($row["title"]);

                if($row["poster_path"] != NULL) {
                    $posterPath = "https://image.tmdb.org/t/p/w500".$row["poster_path"];
                }else{
                    $posterPath = FRONT_ROOT.IMG_PATH."noImage.jpg";
                }

                if($row["backdrop_path"] != NULL) {
                    $backdropPath = "https://image.tmdb.org/t/p/w500".$row["backdrop_path"];
                }else{
                    $backdropPath = FRONT_ROOT.IMG_PATH."noImage.jpg";
                }

                $movie->setImage($posterPath);
                $movie->setPoster($backdropPath);
                $movie->setDescription($row["overview"]);
                $genres = array();

                foreach ($row["genre_ids"] as $row) {
                   array_push($genres, $row);
                }
                $movie->setGenres($genres);                
                array_push($movieList, $movie);
            }
            return $movieList;
        }
    

    public function getGenresApi()
    {
        $genresList = array();
        $response = file_get_contents("https://api.themoviedb.org/3/genre/movie/list?api_key=a7580011981ddc91268a6ad5022a8ec7&language=en-US");
        $genreDao = new GenreDAO();

        $arrayToDecode = ($response) ? json_decode($response, true) : array();

            foreach($arrayToDecode["genres"] as $row)
            {
                $genre = new genre();
                $genre->setId($row["id"]);
                $genre->setName($row["name"]);
                $genreDao->Add($genre);
    
            }

    }
}

?>