<?php

class PreviewProvider {

    private $con;
    private $username;


    public function __construct($con, $username) {
        $this->con = $con;
        $this->username = $username;

    }

    public function createPreviewVideo($entity) {

        if($entity == null) {
            $entity = $this->getRandomEntity();
        } // was missing this bracket

        $id = $entity->getId();
        $name = $entity->getName();
        $preview = $entity->getPreview();
        $thumbnail = $entity->getThumbnail();
            
            // to do: add subtitle

        return "<div class='previewContainer'>

                    <img src='$thumbnail' class='previewImage' hidden>

                    <video autoplay muted class='previewVideo' onended='previewEnded()'>
                        <source src='$preview' type='video/mp4'>
                    </video>

                    <div class='previewOverlay'>

                        <div class='mainDetails'>

                            <h3>$name</h3>

                            <div class='buttons'>

                                <button><i class='fa-solid fa-play'></i></button>
                                <button onclick='volumeToggle(this)'><i class='fa-solid fa-volume-xmark'></i></button>
                            </div>
                        </div>
                    </div>
                </div>";
    }

    public function createEntityPreviewSquare($entity) {
        $id = $entity->getId();
        $thumbnail = $entity->getThumbnail(); // function in entity class
        $name = $entity->getName();

        return "<a href='entity.php?id=$id'>
                    <div class='previewContainer small'>
                        <img src='$thumbnail' title='$name'>
                    </div>
                </a>";
    }

    private function getRandomEntity() {
        $entity = EntityProvider::getEntities($this->con, null, 1);
        return $entity[0];
    }

}

/* redundant bit of code
private function getRandomEntity() {

    $query=$this->con->prepare("SELECT * FROM entities ORDER BY RAND() LIMIT 1");
    $query->execute();
    // created an object for an entity for every row
    $row = $query->fetch(PDO::FETCH_ASSOC); // get data and store into key value object
    return new Entity($this->con, $row);
}
*/

?>

