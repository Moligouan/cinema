<?php

class ActeurDAO extends RoleDao
{

    //Récupérer toutes les offres
    public function getAll()
    {

        $query = $this->BDD->prepare("SELECT idActeur, nom, prenom  FROM acteurs");
        $query->execute();
        $acteur = array();

        while ($data = $query->fetch()) {
            $acteur[] = new Acteur($data['idActeur'], $data['nom'], $data['prenom']);
        }
        return ($acteur);
    }

    public function fillid()
    {
        $query = $this->BDD->prepare("SELECT idActeur FROM acteurs");
        $query->execute();
        $countid = 1;
        while ($data = $query->fetch()) {
            $test = $this->BDD->prepare('SELECT * FROM acteurs WHERE acteurs.idActeur = :id_acteur');
            $test->execute(array(':id_acteur' => $countid));
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
        $acteur = new Acteur($data['idActeur'], $data['nom'], $data['prenom']);
        return ($offer);
    }

    public function checkact($nom, $prenom){
        $query = $this->BDD->prepare('SELECT * FROM acteurs WHERE acteurs.nom = :nom AND acteurs.prenom = :prenom');
        $query->execute(array(':nom' => $nom, ':prenom' => $prenom));
        $data = $query->fetch();
        if ($data != NULL){
            $act = new Acteur($data['idActeur'], $data['nom'], $data['prenom']);
            return $act;
        }
        else {
            return NULL;
        }
    }

    public function delete($id)
    {
    }
}
