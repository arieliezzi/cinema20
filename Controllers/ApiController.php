<?php
    namespace Controllers;

    use Models\Movie as Movie;
    use Models\Genre as Genre;
    use DAO\GenreDAODB as GenreDAODB;
    use DAO\MovieDAODB as MovieDAODB;

    class ApiController
    {
        public function index($message = "") {
			require_once(VIEWS_PATH."adm-list-api-movies.php");
		}


        public function showUserListView($message = "") {
            $movieList = $this->getMoviesApi();
            $this->genreDAO = new GenreDAODB();
            $genreList = $this->genreDAO->getAll();

			require_once(VIEWS_PATH."usr-list-show.php");
		}	

        public function showListView($message = "", $genreID = "")
        {
            $movieList = $this->getMoviesApi($genreID);
            $this->genreDAO = new GenreDAODB();
            $genreList = $this->genreDAO->getAll();

			require_once(VIEWS_PATH."adm-list-api-movies.php");
		}	

        public function getMoviesApi($genre = "")
        {
            $movieList = array();
            if ($genre==NULL )
            {
                $movieList = $this->getMovies("https://api.themoviedb.org/3/movie/now_playing?page=1&language=es-Ar&api_key=a7580011981ddc91268a6ad5022a8ec7", $movieList);     
            } 
            else
            {
                $movieList = $this->getMovies("https://api.themoviedb.org/3/movie/now_playing?page=1&language=es-Ar&with_genres=".$genre."&api_key=a7580011981ddc91268a6ad5022a8ec7", $movieList);  
            }
    
            return $movieList;
        }

        public function addMovie($id,$genreID)
        {
            //Se le pasa por parametro el ID de la pelicula a persistir junto con el genero el cual se uso como filtro.
            //Se le vuelve a pedir a la API la pagina y se busca la pelicula para posteriormente agregarla.
            //Tambien se verifica que en las peliculas ya persistentes no exista!!
            $movieList = $this->getMoviesApi();
            $this->movieDAO = new movieDAODB();
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
                        $this->movieDAO = new MovieDAODB();
                        $this->movieDAO->add($movie); 
                        $this->showListView("✔️ ¡Pelicula agregada con exito!",$genreID);
                    }
                    else
                    {
                        $this->showListView("❌ Error al agregar la pelicula, ya persiste.",$genreID);
                    }
                }
            }
        }

        private function getMovies($url, $movieList)
        {
            $response = file_get_contents($url);
        
            $movieDAO = new MovieDAODB();

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
        $genreDao = new GenreDAODB();

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