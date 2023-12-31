<?php

class FilmDAO extends Dao
{

    //Récupérer toutes les offres
    public function getAll()
    {
        
        $query = $this->BDD->prepare("SELECT idFilm, titre, realisateur, affiche, annee  FROM films");
        $query->execute();
        $film = array();
        
        while ($data = $query->fetch()) {
            $film[] = new Film($data['idFilm'], $data['titre'], $data['realisateur'], $data['affiche'], $data['annee']);
        }
        return ($film);
    }
    
    //Récupére le premier id non utilisé
    public function fillid()
    {
        $query = $this->BDD->prepare("SELECT idFilm FROM films");
        $query->execute();
        $countid = 1;
        while ($data = $query->fetch()) {
            $test = $this->BDD->prepare('SELECT * FROM films WHERE films.idFilm = :id_film');
            $test->execute(array(':id_film' => $countid));
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
        $film = array();
        $film = new Film($data['idFilm'], $data['titre'], $data['realisateur'], $data['affiche'], $data['annee']);
        return ($film);
    }

    //Récupérer les films basé sur un text donné (fonction recherche)
    public function search($text){
        $query = $this->BDD->prepare("SELECT *  FROM films WHERE titre LIKE :text");
        $query->execute(array(':text' => '%'.$text.'%'));
        $film = array();
        
        while ($data = $query->fetch()) {
            $film[] = new Film($data['idFilm'], $data['titre'], $data['realisateur'], $data['affiche'], $data['annee']);
        }
        return ($film);
    }

    //Vérifie si un film est déjà existant
    public function checkfilm($titre, $realisateur, $annee){
        $query = $this->BDD->prepare('SELECT * FROM films WHERE films.titre = :titre AND films.realisateur = :realisateur AND films.annee = :annee');
        $query->execute(array(':titre' => $titre, ':realisateur' => $realisateur, ':annee' => $annee));
        $data = $query->fetch();
        if ($data != NULL){
            return 0;
        }
        else {
            return 1;
        }
    }

    public function delete($id)
    {
    }

// Non utilisé (test requete pour création table avec toutes les infos (trop de doublon)

private $pdo;

    public function getAllFilms()
    {
        // Requête pour récupérer tous les films et leurs informations
        $query = "SELECT f.idFilm, f.titre, f.realisateur, f.affiche, f.annee, a.nom, a.prenom, r.personnage
                  FROM films f
                  LEFT JOIN roles r ON f.idFilm = r.idFilm
                  LEFT JOIN acteurs a ON r.idActeur = a.idActeur";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
