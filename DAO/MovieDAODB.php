<?php

namespace DAO;

use DAO\IMovieDAO as IMovieDAO;
use DAO\Connection as Connection;
use DAO\QueryType as QueryType;
use Models\Movie as Movie;
use DAO\MovieGenreDAODB as MovieGenreDAODB;

class MovieDAODB implements IMovieDAO
{

    private $connection;
    private $movieGenreDao;

    public function add(Movie $movie)
    {
        $this->movieGenreDao = new MovieGenreDAODB();
        try {
            $query = "INSERT movies (id_movie, title, image, description,poster,is_active) VALUES (:id_movie, :title, :image, :description, :poster, :is_active)";

            $parameters["id_movie"] =  $movie->getId();
            $parameters["title"] = $movie->getTitle();
            $parameters["image"] = $movie->getImage();
            $parameters["description"] = $movie->getDescription();
            $parameters["poster"] = $movie->getPoster();
            $parameters["is_active"] = 1;

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::Query);

            foreach ($movie->getGenres() as $genre) {
                $this->movieGenreDao->Add($movie->getId(), $genre->getId());
            }
        } catch (Exception $exception) {
            echo "no se puede agregar la pelicula";
        }
    }

    public function isActive($idMovie)
    {
        $query = "SELECT id_movie FROM movies WHERE (id_movie = :id_movie AND is_active = :is_active)";
        $parameters["id_movie"] = $idMovie;
        $parameters["is_active"] = 0;

        $this->connection = Connection::GetInstance();
        $result = $this->connection->Execute($query, $parameters, QueryType::Query);

        return empty($result);
    }

    public function exist($idMovie)
    {
        $query = "SELECT id_movie FROM movies WHERE id_movie = :id_movie";
        $parameters["id_movie"] = $idMovie;

        $this->connection = Connection::GetInstance();
        $result = $this->connection->Execute($query, $parameters, QueryType::Query);

        return !(empty($result));
    }

    public function getAll()
    {
        $query = " SELECT * FROM movies WHERE is_active = 1";

        return $this->getMovies($query);
    }

    public function getByGenre($genreId)
    {
        $query = "SELECT * FROM movies INNER JOIN movieGenre ON movies.id_movie=movieGenre.id_movie WHERE movieGenre.id_genre = :idGenre;";
        $parameters["idGenre"] = $genreId;

        return $this->getMovies($query, $parameters);
    }

    public function getMovie(int $id)
    {
        $query = "SELECT * FROM movies WHERE id_movie = :id_movie";
        $parameters["id_movie"] = $id;
        $movie = $this->getMovies($query, $parameters);

        return array_pop($movie);
    }

    public function remove($id)
    {
        try {
            $query = "UPDATE movies SET is_active = 0 WHERE id_movie = :id";
            $parameters["id"] =  $id;
            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::Query);
            $this->movieGenreDao = new MovieGenreDAODB();
            $this->movieGenreDao->Remove($id);
        } catch (Exception $exception) {
            echo "No se pudo eliminar la pelicula";
        }
    }

    public function restore($id)
    {
        try {
            $query = "UPDATE movies SET is_active = 1 WHERE id_movie = :id";
            $parameters["id"] =  $id;
            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::Query);
            $this->movieGenreDao = new MovieGenreDAODB();
            $this->movieGenreDao->Remove($id);
        } catch (Exception $exception) {
            echo "No se pudo restaurar la pelicula";
        }
    }


    private function getMovies($query, $parameters = array())
    {
        try {
            $movieList = array();
            $this->movieGenreDao = new MovieGenreDAODB();
            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, $parameters, QueryType::Query);
            foreach ($result as $row) {
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
        } catch (Exception $exception) {
            echo "No se pudo traer la pelicula";
        }
    }
}
