<?php

namespace DAO;
use Models\Movie as Movie;

class MovieDAO implements IMovieDAO
{
    private $movieList = array();

    public function Add(Movie $movie)
    {
        $this->RetrieveData();

        //$movie->setId($this->GetNextId());

        array_push($this->movieList, $movie);

        $this->SaveData();
    }

    public function GetAll()
    {
        $this->RetrieveData();

        return $this->movieList;
    }

    public function SaveData()
    {
        $arrayToEncode = array();

             foreach($this->movieList as $movie)
            {
                $valuesArray["id"] = $movie->getId();
                $valuesArray["title"] = $movie->getTitle();
                $valuesArray["image"] = $movie->getImage();
                $valuesArray["description"] = $movie->getDescription();
                $valuesArray["genres"] = $movie->getGenres();
                $valuesArray["poster"] = $movie->getPoster();
    
                array_push($arrayToEncode, $valuesArray);
            }
    
            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            file_put_contents("Data/movies.json", $jsonContent);
        }

    public function Remove($id)
        {            
            $this->RetrieveData();
            
            $this->movieList = array_filter($this->movieList, function($movie) use($id){                
                return $movie->getId() != $id;
            });
            
            $this->SaveData();
    }


    private function RetrieveData()
    {
        $this->movieList = array();

        if(file_exists("Data/movies.json"))
        {
            $jsonContent = file_get_contents("Data/movies.json");

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode as $valuesArray)
            {
                $movie = new Movie();
                $movie->setId($valuesArray["id"]);
                $movie->setTitle($valuesArray["title"]);
                $movie->setImage($valuesArray["image"]);
                $movie->setDescription($valuesArray["description"]);
                $movie->setGenres($valuesArray["genres"]);
                $movie->setPoster($valuesArray["poster"]);

                array_push($this->movieList, $movie);
            }
        }
    }

    private function GetNextId()
    {
        $id = 0;

        foreach($this->movieList as $movie)
        {
            $id = ($movie->getId() > $id) ? $movie->getId() : $id;
        }

        return $id + 1;
    }
}

?>