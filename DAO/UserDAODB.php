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
        try
        {
            $query = "INSERT INTO users (name,email,pass,is_active) VALUES (:name,:email,:pass,:is_active)";

            $parameters["name"] =$user->getName();
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
        try
        {

            $query = "SELECT * FROM users WHERE email=:email AND pass=:pass";

            $parameters["email"] =$email;
            $parameters["pass"] =$pass;

            $this->connection = Connection::GetInstance();
         
            $result = $this->connection->Execute($query, $parameters ,QueryType::Query);

            $user=null;

            foreach($result as $row)
            {
                $user= new User();
                $user->setId($row["id_user"]);
                $user->setName($row["name"]);
                $user->setEmail($row["email"]);
                $user->setPass($row["pass"]);
            }

        }catch(Exception $exception)
            {
            echo "Email o contraseña incorrecta";
            }

        return $user;
    }

    function validEmail($email)
    {
        try
        {
            
            $query = "SELECT email FROM users WHERE email=:email";

            $parameters["email"] =$email;

            $this->connection = Connection::GetInstance();
         
            $result = $this->connection->Execute($query, $parameters ,QueryType::Query);

        }catch(Exception $exception)
            {
            echo "No se pudo verificar el mail";
            }

        return $result;
    }
}
?>