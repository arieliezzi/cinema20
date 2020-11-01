<?php
namespace DAO;
use Models\Genre as Genre;

    interface IGenreDAO
    {
        function Add(Genre $genre, $name);
        function Remove ($id);
        function GetAll();
    }
    
?>