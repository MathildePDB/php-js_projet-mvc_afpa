<?php

// l'interface permet de bloquer les fonctions obligatoires 
// s'instancie avec implements (ici dans ArticleManager etc)

interface InterfaceManager {
    function findById($id);
    function findOne();
    function findAll();
}