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
        { 
          try{
              $query = "INSERT INTO cinemas(name, address, capacity, imageUrl, is_active) VALUES (:name,:address,:capacity,:imageUrl,:is_active)";

              $parameters["name"] = $cinema->getName();
              $parameters["address"] = $cinema->getAddress();
              $parameters["capacity"] = $cinema->getCapacity();
              $parameters["imageUrl"] = $cinema->getImageUrl();
              $parameters["is_active"]=$cinema->getIsActive();

              $this->connection = Connection::GetInstance();

              $this->connection->ExecuteNonQuery($query, $parameters, QueryType::Query);
             }catch(Exception $exception)
              {
               echo "no se pudo agregar pelicula";
              }

        }

        public function GetRoomsByCinemaId($idCinema)
        {
         try{
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
           }catch(Exception $exception)
           {
               echo"No se pudo traer ninguna sala con de ese cinema";
           }
        }

        public function GetAll()
        {
          try{
            $cinemaList = array();

            $query = "SELECT id_cinema,name,address,capacity,imageUrl FROM cinemas WHERE is_active = 1";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, array(), QueryType::Query);

            foreach($result as $row)
            {
                $cinema = new Cinema();
                $cinema->setId($row["id_cinema"]);
                $cinema->setName($row["name"]);
                $cinema->setAddress($row["address"]);
                $cinema->setCapacity($row["capacity"]);
                $cinema->setImageUrl($row["imageUrl"]);
                $cinema->setRooms($this->GetRoomsByCinemaId($row["id_cinema"]));
                
                array_push($cinemaList, $cinema);
            }
            
            return $cinemaList;
           }catch(Exception $exception)
            {
              echo "No se pudo traer ningun cine de la base de datos";
            }
        }

        public function Remove($id)
        {     
            try{   
            $query = "UPDATE cinemas SET is_active = 0 WHERE id_cinema = :id_cinema";

            $parameters["id_cinema"] =  $id;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::Query);
            }catch(Exception $exception)
            {
                echo "No se pudo borrar la pelicula seleccionada";
            }
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
                $cinema->setImageUrl($row["imageUrl"]);
              }
             $cinema->setRooms($roomList);

             return $cinema;
        }


        public function update($updatedCinema)
        {  
            try{         
            $query = "UPDATE cinemas SET  name= :name, address= :address, capacity= :capacity, imageUrl= :imageUrl WHERE id_cinema = :id_cinema";
            
            $parameters["id_cinema"] = $updatedCinema->getId();
            $parameters["name"] = $updatedCinema->getName();
            $parameters["address"] = $updatedCinema->getAddress();
            $parameters["capacity"] = $updatedCinema->getCapacity();
            $parameters["imageUrl"] = $updatedCinema->getImageUrl();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::Query);
            }catch(Exception $exception)
            {
               echo "no se pudo modificar la pelicula";
            }
        }
        
        public function updateCapacity ($idCinema,$capacity)
		    {
		    	$updatedCinema = new Cinema();
		    	$updatedCinema = $this->getById($idCinema);
		    	$updatedCinema->setCapacity($updatedCinema->getCapacity()+$capacity);
		    	$this->update($updatedCinema);
        }
        
        public function exist($nameCinema)
        {
            $query = "SELECT name FROM cinemas WHERE name = :name";
            $parameters["name"] = $nameCinema;
    
            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query, $parameters, QueryType::Query);
    
            return $result;
        }

    }
?>