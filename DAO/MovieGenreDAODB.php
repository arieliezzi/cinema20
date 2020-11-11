<?php

namespace DAO;

use DAO\IMovieGenreDAO as IMovieGenreDAO;
use DAO\Connection as Connection;
use DAO\QueryType as QueryType;
use DAO\GenreDAODB as GenreDAODB;

class MovieGenreDAODB implements IMovieGenreDAO
{
    private $connection;
    private $genreDao;

    public function Add(int $movieId, int $genreId)
    {
        try {
            $query = "INSERT INTO movieGenre (id_genre, id_movie) VALUES (:idGenre,:idMovie)";
            $parameters["idGenre"] = $genreId;
            $parameters["idMovie"] =  $movieId;
            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::Query);
        } catch (Exception $exception) {
            echo "No se pudo agregar pelicula por genero";
        }
    }

    ///Esta bien este id?
    public function Remove(int $movieId)
    {
        try {
            $query = "DELETE FROM movieGenre WHERE id_movie = :id";
            $parameters["id"] =  $movieId;
            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::Query);
        } catch (Exception $exception) {
            echo "No es posible remover movie genre";
        }
    }

    public function getGenres(int $movieId)
    {
        try {
            $genres = array();
            $query = "SELECT * FROM movieGenre WHERE id_movie = :id_movie";
            $this->connection = Connection::GetInstance();
            $parameters["id_movie"] = $movieId;

            $result = $this->connection->Execute($query, $parameters, QueryType::Query);
            $this->genreDao = new GenreDAODB();
            foreach ($result as $row) {
                $genre = $this->genreDao->getGenre($row["id_genre"]);
                array_push($genres, $genre);
            }
            return $genres;
        } catch (Exception $exception) {
            echo "No es posible obtener peliculas por genero";
        }
    }
}
?>