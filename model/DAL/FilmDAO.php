<?php

class FilmDAO extends Dao
{

    //Récupérer toutes les offres
    public function getAll()
    {

        $query = $this->BDD->prepare("SELECT id, titre, realisateur, affiche, annee  FROM films");
        $query->execute();
        $offers = array();

        while ($data = $query->fetch()) {
            $film[] = new Film($data['id'], $data['titre'], $data['realisateur'], $data['affiche'], $data['annee']);
        }
        return ($film);
    }

    //Ajouter une offre
    public function add($data)
    {

        $valeurs = ['titre' => $data->getTitre(), 'realisateur' => $data->getRealisateur(), 'affiche' => $data->getAffiche(), 'annee' => $data->getAnnee()];
        $requete = 'INSERT INTO films (titre, realisateur, affiche, annee) VALUES (:titre , :realisateur, :affiche, :annee)';
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

        $query = $this->BDD->prepare('SELECT * FROM films WHERE films.id = :id_film');
        $query->execute(array(':id_film' => $id));
        $data = $query->fetch();
        $offer = new Film($data['id'], $data['titre'], $data['realisateur'], $data['affiche'], $data['annee']);
        return ($offer);
    }

    public function delete($id)
    {
    }
}
