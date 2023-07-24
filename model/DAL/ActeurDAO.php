<?php

class ActeurDAO extends RoleDao
{

    //Récupérer toutes les offres
    public function getAll()
    {

        $query = $this->BDD->prepare("SELECT idActeur, nom, prenom  FROM acteurs");
        $query->execute();
        $offers = array();

        while ($data = $query->fetch()) {
            $role[] = new Role($data['idActeur'], $data['nom'], $data['prenom']);
        }
        return ($role);
    }

    //Ajouter une offre
    public function add($data)
    {

        $valeurs = ['id' => $data->getId(),'nom' => $data->getNom(), 'prenom' => $data->getPrenom()];
        $requete = 'INSERT INTO acteurs (idActeur, nom, prenom) VALUES (:id, :nom, :prenom)';
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

        $query = $this->BDD->prepare('SELECT * FROM acteur WHERE acteur.idActeur = :id_acteur');
        $query->execute(array(':id_acteur' => $id));
        $data = $query->fetch();
        $offer = new Film($data['idActeur'], $data['nom'], $data['prenom']);
        return ($offer);
    }

    public function delete($id)
    {
    }
}