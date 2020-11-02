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

            $query = "INSERT INTO rooms(name,capacity,price,is_active, id_cinema) VALUES(:name,:capacity,:price,:is_active,:id_cinema)";
           
            $parameters["name"] = $room->getName();
            $parameters["capacity"] = $room->getCapacity();
            $parameters["price"] = $room->getPrice();
            $parameters["is_active"]=$room->getIsActive();
            $parameters["id_cinema"]=$room->getIdCinema();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::Query);
            }catch(Exception $exception)
            {
            echo "no se pudo agregar la sala";
            }
        }

        public function GetAll()
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
                $cinema->setIdCinema($row["id_cinema"]);

                array_push($roomList, $room);
            }

            return $roomList;
        }


        public function Remove($id)
        {            
            $query="UPDATE rooms SET (is_active = 0) WHERE (id_room = :id_room)";

            $parameters["id_room"] =  $id;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::Query);
        }

        

    }
?>