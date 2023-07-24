<?php


class UserDAO extends Dao
{

    public function getAll()
    {
        try {
            $q = $this->BDD->prepare("SELECT * FROM users");
            $q->execute();
            $users = [];

            while ($data = $q->fetch()) {
                $users[] = new User($data['id'], $data['username'], $data['email'], $data['password']);
            }
        } catch (Exception $err) {
            return "ERROR : " . $err->getMessage();
        }
        return ($users);
    }

    public function add($user)
    {

        try {
            // Préaration des valeurs à stocker dans la requête, qui sortira un booléen qui indiquera si la requête s'est bien exécutée.
            $hashPW = password_hash($user->getPassword(), PASSWORD_DEFAULT);
            $values = [':email' => $user->getEmail(), ':password' => $hashPW];
            $q = "INSERT INTO users (email, password) VALUES (:email, :password)";
            $insert = $this->BDD->prepare($q);
            if (!$insert->execute($values)) {
                return false;
            } else {
                return true;
            }
        } catch (Exception $err) {
            return "ERROR : " . $err->getMessage();
        }
    }

    // Vérifier l'inscription d'un user via son email
    public function checkNew($newUser)
    {
        try {
            $q = $this->BDD->prepare("SELECT email FROM users WHERE email = :email");
            $q->execute([':email' => $newUser->getEmail()]);


            if ($q->fetch() != false) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $err) {
            return "ERROR : " . $err->getMessage();
        }
    }

    //Vérifier l'email et le mdp de l'user POUR LA CONNEXION
    public function getOne($user)
    {
        try {
            $q = $this->BDD->prepare("SELECT * FROM users WHERE email = :email");
            $q->execute([':email' => $user->getEmail()]);

            $user = $q->fetch();

            if ($q->rowCount() > 0) {
                if (password_verify($user['password'], $_POST['pw'])) {
                    $user = new User($user['id'], $user['username'], $user['email'], $user['password']);
                }
            } else {
                $user = 0;
            }
        } catch (Exception $err) {
            return "ERROR : " . $err->getMessage();
        }
        return $user;
    }
