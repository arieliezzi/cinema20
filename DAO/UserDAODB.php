<?php

namespace DAO;

use DAO\IUserDAO as IUserDAO;
use DAO\Connection as Connection;
use DAO\QueryType as QueryType;
use Models\User as User;


class UserDAODB implements IUserDAO
{

    function Add(User $user)
    {
        try{
            $query = "INSERT INTO users(email,pass,is_active) VALUES (:email,:pass:is_active)";

            $parameters["email"] =$user->getEmail();
            $parameters["pass"] =$user->getPass();
            $parameters["is_active"] =$user->getIsActive();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::Query);
           }catch(Exception $exception)
             {
              echo "no se pudo agregar el usuario";
             }
    }

    ///Devuelve un usuario de la base de datos si el nombre de usuario y contraseña son los correctos
    function validUser($email,$pass)
    {
        try{

            $query = "SELECT *FROM users WHERE email=:email AND pass=:pass";

            $parameters["email"] =$email;
            $parameters["pass"] =$pass;

            $this->connection = Connection::GetInstance();
            $user= new User();
            $user = $this->connection->Execute($query, $parameters ,QueryType::Query);
            
        }catch(Exception $exception)
         {
          echo "email o contraseña incorrecta";
         }
     return $user;
    }


    function Remove ($id)
    {
        try{
            $query = "UPDATE users SET is_actice=:is_active WHERE id_user=:id_user";

            $parameters["is_active"] =$user->getIsActive();
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