<?php

class Film
{

    private $id;
    private $titre;
    private $realisateur;
    private $affiche;
    private $annee;
    private array $role = [];

    public function __construct(int $id, string $titre, string $realisateur, string $affiche, int $annee, array $role = [])
    {
        $this->setId($id);
        $this->setTitre($titre);
        $this->setRealisateur($realisateur);
        $this->setAffiche($affiche);
        $this->setAnnee($annee);
        $this->setRole($role);
    }



    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of titre
     */ 
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Get the value of realisateur
     */ 
    public function getRealisateur()
    {
        return $this->realisateur;
    }

    /**
     * Get the value of affiche
     */ 
    public function getAffiche()
    {
        return $this->affiche;
    }

    /**
     * Get the value of annee
     */ 
    public function getAnnee()
    {
        return $this->annee;
    }

    // --------------------------------------

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */ 
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Set the value of realisateur
     *
     * @return  self
     */ 
    public function setRealisateur($realisateur)
    {
        $this->realisateur = $realisateur;

        return $this;
    }

    /**
     * Set the value of affiche
     *
     * @return  self
     */ 
    public function setAffiche($affiche)
    {
        $this->affiche = $affiche;

        return $this;
    }

    /**
     * Set the value of annee
     *
     * @return  self
     */ 
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

// -----------------------------------

    //Récupére un role spécifique
    public function getRole($a)
    {
            return $this->role[$a];
    }

    //Récupére tout les roles
    public function getRoles()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    //Ajoute un role à une position spécifique
    public function addRole($role,int $pos)
    {
        $this->role[$pos] = $role;
    }
}
