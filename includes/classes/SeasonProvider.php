<?php

    class SeasonProvider {
        public function __construct($con, $username) {
            $this->con = $con;
            $this->username = $username;
                
        }

        public function create($entity) {
            $seasons = $entity->getSeasons();
        }
    }
?>