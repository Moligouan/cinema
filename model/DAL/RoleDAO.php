<?php

class RoleDAO extends FilmDao
{

    //Récupérer toutes les offres
    public function getAll()
    {

        $query = $this->BDD->prepare("SELECT idActeur, idFilm, personnage, idRole  FROM roles");
        $query->execute();
        $offers = array();

        while ($data = $query->fetch()) {
            $role[] = new Role($data['idRole'], $data['personnage'], $data['idActeur'], $data['idFilm']);
        }
        return ($role);
    }

    //Récupére le premier id non utilisé
    public function fillid()
    {
        $query = $this->BDD->prepare("SELECT idRole FROM roles");
        $query->execute();
        $countid = 1;
        while ($data = $query->fetch()) {
            $test = $this->BDD->prepare('SELECT * FROM roles WHERE roles.idRole = :id_role');
            $test->execute(array(':id_role' => $countid));
            $data = $test->fetch();
            if ($data != NULL){
                $countid = $countid + 1;
            }
            else{
                return ($countid);
            }
        }
        return ($countid + 1);
    }

    //Ajouter une offre
    public function add($data)
    {

        $valeurs = ['id' => $data->getId(),'personnage' => $data->getPersonnage(), 'idAct' => $data->getIdAct(), 'idFilm' => $data->getIdFilm()];
        $requete = 'INSERT INTO roles (idActeur, idFilm, personnage, idRole) VALUES (:idAct, :idFilm , :personnage, :id)';
        $insert = $this->BDD->prepare($requete);
        if (!$insert->execute($valeurs)) {
            return false;
        } else {
            return true;
        }
    }

    //Récupérer plus d'info sur 1 offre
    public function getOne($id)
    {
        $query = $this->BDD->prepare('SELECT * FROM roles WHERE roles.idRole = :id_role');
        $query->execute(array(':id_role' => $id));
        $data = $query->fetch();
        $role = new Role($data['idRole'], $data['personnage'], $data['idActeur'], $data['idFilm']);
        return ($role);
    }

    //Récupére les roles d'un film spécifique
    public function getRole($idFilm)
    {
        $query = $this->BDD->prepare("SELECT idActeur, idFilm, personnage, idRole FROM roles WHERE idFilm = :id_Film");
        $query->execute(array(':id_Film' => $idFilm));
        $roles = array();
    
        while ($data = $query->fetch()) {
            $roles[] = new Role($data['idRole'], $data['personnage'], $data['idActeur'], $data['idFilm']);
        }
    
        return ($roles);
    }

    public function delete($id)
    {
    }
}
