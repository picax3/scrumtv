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

                $videosHtml = "";
                foreach($season->getVideos() as $video) // reference each element in array
                    $videosHtml .= $this->createVideoSquare($video);

                $seasonsHtml .= "<div class='season'>
                                    <h3>Season $seasonNumber</h3>
                                        <div class='videos'>
                                            $videosHtml
                                        </div>
                                </div>";
            }

            return $seasonsHtml;
        }

        private function createVideoSquare($video) {
            $id = $video->getId();
            $thumbnail = $video->getThumbnail();
            $name = $video->getTitle();
            $description = $video->getDescription();
            $episodeNumber = $video->getEpisodeNumber();

            return "<a href='watch.php?id=$id'>
                <div class='episodeContainer'>
                    <div class='contents'>
                        <img src='$thumbnail'>
                        <div class='videoInfo'>
                            <h4>$episodeNumber. $name</h4>
                            <span>$description</span>
                        </div>
                    </div>
                </div>
            </a>";
        }
    }
?>