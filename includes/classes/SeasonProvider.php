<?php

    class SeasonProvider {
        private $con, $username;

        public function __construct($con, $username) {
            $this->con = $con;
            $this->username = $username;
                
        }

        public function create($entity) {
            $seasons = $entity->getSeasons();
            // finds only movie not seasons
            if(sizeof($seasons) == 0) {
                return;
            }
            $seasonsHtml = "";
            foreach($seasons as $season) {
                $seasonNumber=$season->getSeasonNumber();

                $seasonsHtml .= "<div class='season'>
                                <h3>Season $seasonNumber</h3>
                                </div>";
            }

            return $seasonsHtml;
        }

        private function createVideoSquare($video) {
            $id = $video->getId();
            $thumbnail = $video->getThumbnail();
            $name = $video->getName();
            $description = $video->getDescription();
            $episodeNUmber = $video->getEpisodeNumber();
        }
    }
?>