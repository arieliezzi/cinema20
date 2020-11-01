<?php

    namespace DAO;

    interface IMovieGenreDAO 
    {
        function Add(int $movieId, int $genreId);
        function Remove(int $movieId);
        function GetGenres(int $movieId);
    }

?>