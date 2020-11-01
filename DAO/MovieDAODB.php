<?php
    namespace DAO;

    use DAO\IMovieDAO as IMovieDAO;
    use DAO\Connection as Connection;
    use DAO\QueryType as QueryType;
    use Models\Movie as Movie;
    use DAO\MovieGenreDAODB as MovieGenreDAODB;

    class MovieDAODB implements IMovieDAO  {

        private $connection;
        private $movieGenreDao;

        public function Add(Movie $movie) {
            try {
                $this->movieGenreDao = new MovieGenreDAODB();
                $query = "INSERT movies (id_movie, title, image, description,poster) VALUES (:id_movie, :title, :image, :description, :poster)";
                $parameters["id_movie"] =  $movie->getId();
                $parameters["title"] = $movie->getTitle();
                $parameters["image"] = $movie->getImage();
                $parameters["description"] = $movie->getDescription();
                $parameters["poster"] =$movie->getPoster();
                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters, QueryType::Query);
                foreach($movie->getGenres() as $genre) {
                    $this->movieGenreDao->Add($movie->getId(), $genre->getId());
                }
            } catch(Exception $exception) {
                    echo "no se puede agregar la pelicula";
            }
        }

        public function GetAll() {
            $query = "SELECT * FROM movies";
            
            return $this->getMovies($query);
        }

        public function getAllMovies() {
            $query = "SELECT * FROM movies";
            
            return $this->getMovies($query);
        }


        public function getByGenre($genreId) {
            $query = "SELECT * FROM movies M WHERE (SELECT S.id_movie FROM Screenings S WHERE S.id_movie = M.id_movie AND S.screening_date >= CURDATE() GROUP BY S.id_movie) IS NOT NULL 
            AND (SELECT MG.id_movie FROM MovieGenre MG WHERE MG.id_movie = M.id_movie AND MG.id_genre = :idGenre GROUP BY MG.id_movie) IS NOT NULL
            ORDER BY M.title ASC";
            $parameters["idGenre"]=$genreId;

            return $this->getMovies($query, $parameters);
        }

        public function getMovie(int $id) {
            $query = "SELECT * FROM movies WHERE id_movie = :id_movie";
            $parameters["id_movie"] = $id;

            $movie = $this->getMovies($query, $parameters);
            return array_pop($movie);
        }


        public function Remove($id) {    
            try {        
                $query = "UPDATE movies SET is_active=0 WHERE id_movie = :id";
                $parameters["id"] =  $id;
                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters, QueryType::Query);
                $this->movieGenreDao = new MovieGenreDAO();
                $this->$movieGenreDao->Remove($movie->getId()); 
            } catch(Exception $exception) {
                echo "No se pudo eliminar la pelicula";
            }             
        } 


        private function getMovies($query, $parameters = array()) {
            try {
                $movieList = array();
                $this->movieGenreDao = new MovieGenreDAODB();
                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, $parameters, QueryType::Query);
                foreach($result as $row)
                {
                    $movie = new Movie();
                    $movie->setId($row["id_movie"]);
                    $movie->setTitle($row["title"]);
                    $movie->setImage($row["image"]);
                    $movie->setDescription($row["description"]);
                    $genres = $this->movieGenreDao->getGenres($row["id_movie"]);
                    $movie->setGenres($genres);
                    $movie->setPoster($row["poster"]);
                    $movie->setIs_active($row["is_active"]);
                    array_push($movieList, $movie);
                }
                return $movieList;
            } catch(Exception $exception) {
                echo "No se pudo crear la pelicula";
            }
        }

    }
?>