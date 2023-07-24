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

    //Ajouter une offre
    public function add($data)
    {

        $valeurs = ['id' => $data->getId(),'personnage' => $data->getPersonnage(), 'idAct' => $data->getIdAct(), 'idFilm' => $data->getIdFilm()];
        $requete = 'INSERT INTO roles (idActeur, idFilm, personnage, idRole) VALUES (:idAct, :idFilm , :personnage, :idRole)';
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

        $query = $this->BDD->prepare('SELECT * FROM roles WHERE films.idRole = :id_role');
        $query->execute(array(':id_role' => $id));
        $data = $query->fetch();
        $offer = new Film($data['idRole'], $data['personnage'], $data['idActeur'], $data['idFilm']);
        return ($offer);
    }

    public function delete($id)
    {
    }
}