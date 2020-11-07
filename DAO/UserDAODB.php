<?php

namespace DAO;

use DAO\IUserDAO as IUserDAO;
use DAO\Connection as Connection;
use DAO\QueryType as QueryType;
use Models\User as User;


class UserDAO implements IUserDAO
{

    function Add(User $user)
    {
        try{
            $query = "INSERT INTO users(email,pass,is_active) VALUES (:email,:pass:is_active)";

            $parameters["email"] =$user->getEmail();
            $parameters["pass"] =$user->getPass();
            $parameters["is_active"] =$user->getIs_active();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::Query);
           }catch(Exception $exception)
             {
              echo "no se pudo agregar el usuario";
             }
    }

    function Remove ($id)
    {
        try{
            $query = "UPDATE users SET is_actice=:is_active WHERE id_user=:id_user";

            $parameters["is_active"] =$user->getIs_active();
            $parameters["id_user"] =$user->getId();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::Query);
           }catch(Exception $exception)
             {
              echo "no se pudo eliminar el usuario";
             }

    }


}
?>