<?php
    namespace DAO;

    use DAO\IRoomDAO as IRoomDAO;
    use DAO\Connection as Connection;
    use DAO\QueryType as QueryType;
    use Models\Room as Room;

    class RoomDAODB implements IRoomDAO
    {
        private $connection;
        
        public function Add(Room $room,$idCinema)
        { 
         try{

            $query = "INSERT INTO rooms(name,capacity,price,is_active, id_cinema) VALUES(:name,:capacity,:price,:is_active,:id_cinema)";
           
            $parameters["name"] = $room->getName();
            $parameters["capacity"] = $room->getCapacity();
            $parameters["price"] = $room->getPrice();
            $parameters["is_active"]=$room->getIsActive();
            $parameters["id_cinema"]=$idCinema;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::Query);
            }catch(Exception $exception)
            {
            echo "No se pudo agregar la sala";
            }
        }

        public function GetAll($idCinema)
        {
            $roomList = array();

            $query = "SELECT * FROM rooms WHERE (is_active = 1)";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, array(), QueryType::Query);

            foreach($result as $row)
            {
                $room = new Room();
                $room->setId($row["id_room"]);
                $room->setName($row["name"]);
                $room->setCapacity($row["capacity"]);
                $room->setPrice($row["price"]);
                $room->setIsActive($row["is_active"]);

                array_push($roomList, $room);
            }

            return $roomList;
        }


        public function Remove($id)
        {       
            try{    
            $query="UPDATE rooms SET is_active = :is_active WHERE id_room = :id_room";

            $parameters["is_active"]=0;
            $parameters["id_room"] =  $id;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::Query);
            }catch(Exception $exception)
            {
                echo"No se pudo eliminar la sala";
            }
        }

        public function GetById($id)
        {            
            $query = "SELECT * FROM rooms WHERE id_room = :id_room";

            $parameters["id_room"] = $id;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, $parameters, QueryType::Query);

            foreach($result as $row)
            {
                $room = new room();
                $room->setId($row["id_room"]);
                $room->setName($row["name"]);
                $room->setCapacity($row["capacity"]);
                $room->setPrice($row["price"]);
            }

            return $room;
        }

        public function update($updatedRoom)
        {  
            try{         
            $query = "UPDATE rooms SET name= :name, capacity= :capacity, price = :price WHERE (id_room = :id_room)";
            
            $parameters["id_room"] = $updatedRoom->getId();
            $parameters["name"] = $updatedRoom->getName();
            $parameters["capacity"] = $updatedRoom->getCapacity();
            $parameters["price"] = $updatedRoom->getPrice();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::Query);
            }catch(Exception $exception)
            {
               echo "No se pudo modificar la sala";
            }
        }
        
    }
?>