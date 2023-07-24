<?php

class FilmDAO extends Dao
{

    //Récupérer toutes les offres
    public function getAll()
    {

        $query = $this->BDD->prepare("SELECT idFilm, titre, realisateur, affiche, annee  FROM films");
        $query->execute();
        $offers = array();

        while ($data = $query->fetch()) {
            $film[] = new Film($data['idFilm'], $data['titre'], $data['realisateur'], $data['affiche'], $data['annee']);
        }
        return ($film);
    }

    //Ajouter une offre
    public function add($data)
    {

        $valeurs = ['id' => $data->getId(),'titre' => $data->getTitre(), 'realisateur' => $data->getRealisateur(), 'affiche' => $data->getAffiche(), 'annee' => $data->getAnnee()];
        $requete = 'INSERT INTO films (idFilm, titre, realisateur, affiche, annee) VALUES (:id, :titre , :realisateur, :affiche, :annee)';
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

        $query = $this->BDD->prepare('SELECT * FROM films WHERE films.idFilm = :id_film');
        $query->execute(array(':id_film' => $id));
        $data = $query->fetch();
        $offer = new Film($data['idFilm'], $data['titre'], $data['realisateur'], $data['affiche'], $data['annee']);
        return ($offer);
    }

    public function delete($id)
    {
    }
}
