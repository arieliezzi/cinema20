<?php
namespace DAO;
use Models\Room as Room;

    interface IRoomDAO
    {
        function Add(Room $room,$idCinema);
        function Remove ($id);
        function GetAll($idCinema);
    }
    
?>