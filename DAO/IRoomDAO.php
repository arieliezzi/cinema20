<?php
namespace DAO;
use Models\Room as Room;

    interface IRoomDAO
    {
        function Add(Room $room);
        function Remove ($id);
        function GetAll();
    }
    
?>