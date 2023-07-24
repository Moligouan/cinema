<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Offres
 *
 * @author Vince
 */
class Role
{

    private $id;
    private $personnage;
    private $idAct;
    private $idFilm;
    private array $acteur = [];


    public function __construct(int $id, string $personnage, int $idAct, int $idFilm, array $acteur = [])
    {
        $this->setId($id);
        $this->setPersonnage($personnage);
        $this->setIdAct($idAct);
        $this->setIdFilm($idFilm);
        $this->setNom($acteur);
    }

    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of personnage
     */ 
    public function getPersonnage()
    {
        return $this->personnage;
    }

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
     * Set the value of personnage
     *
     * @return  self
     */ 
    public function setPersonnage($personnage)
    {
        $this->personnage = $personnage;

        return $this;
    }

    /**
     * Get the value of acteur
     */ 
    public function getActeur()
    {
        return $this->acteur;
    }

    /**
     * Set the value of acteur
     *
     * @return  self
     */ 
    public function setActeur($acteur)
    {
        $this->acteur = $acteur;

        return $this;
    }

    /**
     * Get the value of idAct
     */ 
    public function getIdAct()
    {
        return $this->idAct;
    }

    /**
     * Set the value of idAct
     *
     * @return  self
     */ 
    public function setIdAct($idAct)
    {
        $this->idAct = $idAct;

        return $this;
    }

    /**
     * Get the value of idFilm
     */ 
    public function getIdFilm()
    {
        return $this->idFilm;
    }

    /**
     * Set the value of idFilm
     *
     * @return  self
     */ 
    public function setIdFilm($idFilm)
    {
        $this->idFilm = $idFilm;

        return $this;
    }
}
