<?php
    namespace DAO;

    use DAO\ICinemaDAO as ICinemaDAO;
    use DAO\Connection as Connection;
    use DAO\QueryType as QueryType;
    use Models\Cinema as Cinema;
    use Models\Room as Room;

    class CinemaDAODB implements ICinemaDAO
    {
        private $connection;
        private $tableName = "cinemas";
        
        public function Add(Cinema $cinema)
        { try{
            $query = "CALL Cinemas_Add(?, ?, ?, ?, ?, ?)";

            $parameters["name"] = $cinema->getName();
            $parameters["address"] = $cinema->getAddress();
            $parameters["capacity"] = $cinema->getCapacity();
            $parameters["price"] = $cinema->getPrice();
            $parameters["imageUrl"] = $cinema->getImageUrl();
            $parameters["is_active"]=$cinema->getIsActive();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
        }catch(Exception $exception)
        {
            echo "no se pudo agregar pelicula";
        }
        }

        public function GetRoomsByCinemaId($idCinema)
        {
            $query="SELECT * FROM rooms WHERE id_cinema=:id_cinema AND is_active = :is_active";
            $parameters["id_cinema"] = $idCinema;
            $parameters["is_active"] = 1;
            
            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query, $parameters, QueryType::Query);

            $roomList=array();
            foreach($result as $row)
            {
                $room=new Room();
                $room->setId($row["id_room"]);
                $room->setName($row["name"]);
                $room->setCapacity($row["capacity"]);
                $room->setPrice($row["price"]);
                $room->setIdCinema($idCinema);

                array_push($roomList, $room);
            }
          return $roomList;
        }

        public function GetAll()
        {

            $cinemaList = array();

            $query = "CALL Cinemas_GetAll()";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, array(), QueryType::StoredProcedure);

            foreach($result as $row)
            {
                $cinema = new Cinema();
                $cinema->setId($row["id_cinema"]);
                $cinema->setName($row["name"]);
                $cinema->setAddress($row["address"]);
                $cinema->setCapacity($row["capacity"]);
                $cinema->setPrice($row["price"]);
                $cinema->setImageUrl($row["imageUrl"]);
                $cinema->setRooms($this->GetRoomsByCinemaId($row["id_cinema"]));
                
                array_push($cinemaList, $cinema);
            }
            
            return $cinemaList;
        }

        public function Remove($id)
        {            
            $query = "CALL Cinemas_Delete(?)";

            $parameters["id_cinema"] =  $id;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
        }

        public function GetById($id)
        {            
            $tableName="Cinemas";

            $query = "SELECT * FROM ".$this->tableName." WHERE id_cinema = :id_cinema";

            $parameters["id_cinema"] = $id;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, $parameters, QueryType::Query);

            $roomList=$this->GetRoomsByCinemaId($id);

            foreach($result as $row)
            {
                $cinema = new cinema();
                $cinema->setId($row["id_cinema"]);
                $cinema->setName($row["name"]);
                $cinema->setCapacity($row["capacity"]);
                $cinema->setAddress($row["address"]);
                $cinema->setPrice($row["price"]);
                $cinema->setImageUrl($row["imageUrl"]);
            }
            $cinema->setRooms($roomList);

            return $cinema;
        }


        public function update($updatedCinema)
        {  
            try{         
            $query = "CALL Cinemas_Update(? ,?, ?, ?, ?, ?)";
            
            $parameters["id_cinema"] = $updatedCinema->getId();
            $parameters["name"] = $updatedCinema->getName();
            $parameters["address"] = $updatedCinema->getAddress();
            $parameters["capacity"] = $updatedCinema->getCapacity();
            $parameters["price"] = $updatedCinema->getPrice();
            $parameters["imageUrl"] = $updatedCinema->getImageUrl();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
            }catch(Exception $exception)
            {
               echo "no se pudo modificar la pelicula";
            }
        }
        

    }
?>