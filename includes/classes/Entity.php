<?php
class Entity {

    private $con, $sqlData; // either data from database or entity id
    public function __construct($con, $input) {
        $this->con = $con;

        if(is_array($input)) {
            $this->sqlData = $input;
        }

        else {
            $query = $this->con->prepare("SELECT * FROM entities WHERE id=:id");
            $query->bindValue(":id", $input);
            $query->execute();

            $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function getId() {
        return $this->sqlData["id"];
    }
    public function getName() {
        return $this->sqlData["name"];
    }
    public function getThumbnail() {
        return $this->sqlData["thumbnail"];
    }
    public function getPreview() {
        return $this->sqlData["preview"];
    }

    public function getSeasons() {
        $query = $this->con->prepare("SELECT * FROM videos WHERE entityId=:id
                                            AND isMovie=0 ORDER BY season, episode ASC"); // order by first property but if 2 rows have same value goes by second property
            $query->bindValue(":id", $this->getId());
            $query->execute();

            $seasons = array();
            $videos = array();
            // keep track of seasons we in
            $currentSeason = null;

            // loop around every video
            while($row = $query->fetch(PDO::FETCH_ASSOC)) {

                if($currentSeason != null && $currentSeason != $row["season"]){
                // we need != null to make sure this is the first time we going thru this loop
                // without it - it will split the array
                    $seasons[] = new Season($currentSeason, $videos);
                    $videos = array();
                }

                $currentSeason = $row["season"];
                $videos[] = new Video($this->con, $row);
            
            }
// if no videos in the season dont create object for that
            if(sizeof($videos) != 0) {
                $seasons[] = new Season($currentSeason, $videos);
            }

            return $seasons;
    }

}
?>