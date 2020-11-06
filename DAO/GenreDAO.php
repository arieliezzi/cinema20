<?php

namespace DAO;
use Models\Genre as Genre;

class GenreDAO implements IGenreDAO
{
    private $genreList = array();

    public function Add(Genre $genre)
    {
        $this->RetrieveData();

        array_push($this->genreList, $genre);

        $this->SaveData();
    }

    public function Add( $genre)
    {
        $this->RetrieveData();

        array_push($this->genreList, $genre);

        $this->SaveData();
    }

    public function GetAll()
    {
        $this->RetrieveData();

        return $this->genreList;
    }

    public function SaveData()
    {
        $arrayToEncode = array();

             foreach($this->genreList as $genre)
            {
                $valuesArray["id"] = $genre->getId();
                $valuesArray["name"] = $genre->getName();
                array_push($arrayToEncode, $valuesArray);
            }
    
            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            file_put_contents("Data/genres.json", $jsonContent);
        }

    public function Remove($id)
        {            
            $this->RetrieveData();
            
            $this->genreList = array_filter($this->genreList, function($genre) use($id){                
                return $genre->getId() != $id;
            });
            
            $this->SaveData();
    }


    private function RetrieveData()
    {
        $this->genreList = array();

        if(file_exists("Data/genres.json"))
        {
            $jsonContent = file_get_contents("Data/genres.json");

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode as $valuesArray)
            {
                $genre = new Genre();
                $genre->setId($valuesArray["id"]);
                $genre->setName($valuesArray["name"]);
                array_push($this->genreList, $genre);
            }
        }
    }

    private function GetNextId()
    {
        $id = 0;

        foreach($this->genreList as $genre)
        {
            $id = ($genre->getId() > $id) ? $genre->getId() : $id;
        }

        return $id + 1;
    }
}

?>