<?php
namespace DAO;
use Models\Show as Show;

    interface IShowDAO
    {
        function Add(Show $show);
        function Remove ($id);
        function GetAll();
    }
    
?>