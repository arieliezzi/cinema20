<?php
    namespace DAO;

    use DAO\IRoomDAO as IRoomDAO;
    use DAO\Connection as Connection;
    use DAO\QueryType as QueryType;
    use Models\Room as Room;

    class RoomDAODB implements IRoomDAO
    {
        private $connection;
        
        public function Add(Room $room)
        { 
            try{

            $query = "CALL Rooms_Add(?, ?, ?, ?, ?)";
           
            $parameters["name"] = $room->getName();
            $parameters["capacity"] = $room->getCapacity();
            $parameters["price"] = $room->getPrice();
            $parameters["is_active"]=$room->getIsActive();
            $parameters["id_cinema"]=$room->getIdCinema();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
        }catch(Exception $exception)
        {
            echo "no se pudo agregar la sala";
        }
    }


        public function Remove($id)
        {            
            $query = "CALL Rooms_Delete(?)";

            $parameters["id_rooms"] =  $id;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
        }

        

    }
?>