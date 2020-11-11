<?php
namespace DAO;

use Models\Movie as Movie;
use Models\Genre as Genre;

class ApiDAODB implements IApiDAODB
{

    public function getGenresApi()
    {
        $genresList = array();
        $response = file_get_contents("https://api.themoviedb.org/3/genre/movie/list?api_key=" . API_KEY . "&language=en-US");

        $arrayToDecode = ($response) ? json_decode($response, true) : array();

        foreach ($arrayToDecode["genres"] as $row) {
            $genre = new genre();
            $genre->setId($row["id"]);
            $genre->setName($row["name"]);
            array_push($genresList, $genre);
            //    $genreDao->Add($genre->getID(),$genre->getName());
        }
        return $genresList;
    }

    private function getMovies($url, $movieList)
    {
        $response = file_get_contents($url);

        $movieDAO = new MovieDAODB();

        $arrayToDecode = ($response) ? json_decode($response, true) : array();

        foreach ($arrayToDecode["results"] as $row) {
            $movie = new Movie();
            $movie->setId($row["id"]);
            $movie->setTitle($row["title"]);

            if ($row["poster_path"] != NULL) {
                $posterPath = "https://image.tmdb.org/t/p/w500" . $row["poster_path"];
            } else {
                $posterPath = FRONT_ROOT . IMG_PATH . "noImage.jpg";
            }

            if ($row["backdrop_path"] != NULL) {
                $backdropPath = "https://image.tmdb.org/t/p/w500" . $row["backdrop_path"];
            } else {
                $backdropPath = FRONT_ROOT . IMG_PATH . "noImage.jpg";
            }

            $movie->setImage($posterPath);
            $movie->setPoster($backdropPath);
            $movie->setDescription($row["overview"]);
            $genres = array();

            foreach ($row["genre_ids"] as $row) {
                $genre = new Genre;
                $genre->setId($row);
                array_push($genres, $genre);
            }
            $movie->setGenres($genres);
            array_push($movieList, $movie);
        }
        return $movieList;
    }

    public function getMoviesApi($genre = "")
    {
        $movieList = array();
        if ($genre == NULL) {
            $movieList = $this->getMovies("https://api.themoviedb.org/3/movie/now_playing?page=1&language=es-Ar&api_key=" . API_KEY, $movieList);
        } else {
            $movieList = $this->getMovies("https://api.themoviedb.org/3/movie/now_playing?page=1&language=es-Ar&with_genres=" . $genre . "&api_key=" . API_KEY, $movieList);
        }

        return $movieList;
    }
}

?>