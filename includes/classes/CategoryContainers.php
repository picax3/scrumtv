<?php

class CategoryContainers { // class names with capital letter

    private $con;
    private $username;

    public function __construct($con, $username) {
        $this->con = $con;
        $this->username = $username;
    }

    public function showAllCategories() {

        $query = $this->con->prepare("SELECT * FROM categories");
        $query->execute();

        $html = "<div class = 'previewCategories'>"; // add html to each category before we close it off
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $html .= $this->getCategoryHtml($row, null, true, true);
        }
        return $html . "</div>";        
    }

    public function showCategory($categoryId, $title = null) {
        $query = $this->con->prepare("SELECT * FROM categories WHERE id=:id");
        $query->bindValue(":id", $categoryId);
        $query->execute();
        
        $html = "<div class = 'previewCategories noScroll'>"; // add html to each category before we close it off
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $html .= $this->getCategoryHtml($row, $title, true, true);
        }
        return $html . "</div>";        
    }

    private function getCategoryHtml($sqlData, $title, $tvShows, $movies) {
        $categoryId = $sqlData["id"];
        $title = $title == null ? $sqlData["name"] : $title; // if no title use the name in category

        if($tvShows && $movies) {
            $entities = EntityProvider::getEntities($this->con, $categoryId, 30);
        }
        else if($tvShows) {
            // get tvshow entities
        }
        else {
            // get movi entities
        }

        if(sizeof($entities) == 0) {
            return;
        }

        $entitiesHtml = "";
        $previewProvider = new PreviewProvider($this->con, $this->username);
        // foreach loop - loop for every item in array
        foreach($entities as $entity) { // for every time this loop itirrates the current item will be in the $entity
            $entitiesHtml .= $previewProvider->createEntityPreviewSquare($entity);

        }

        // class used to retrieve all types of entities all entities u searh
        //return $entitiesHtml . "<br>";
        return "<div class='category'>
                    <a href='category.php?id=$categoryId'>
                        <h3>$title</h3>
                    </a>

                    <div class='entities'>$entitiesHtml</div>
                </div> ";
    }

}
?>