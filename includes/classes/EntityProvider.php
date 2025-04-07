<?php

class EntityProvider {

    // only use static function no need for constructor
    // can call without creating an instance of the class

    public static function getEntities($con, $categoryId, $limit) {

        $sql = "SELECT * FROM entities "; // make sure have space after categories
        if($categoryId != null) {
            // .= join clause with another clause
            $sql .= "WHERE categoryId=:categoryId ";
        }

        $sql .= "ORDER BY RAND() LIMIT :limit";

        $query=$con->prepare($sql); 

        if($categoryId != null) {
            $query->bindValue(":categoryId", $categoryId); // if there is a categoryId it will bind it to the placeholder
        }

        $query->bindValue(":limit", $limit, PDO::PARAM_INT); // might have problem binding integer
        $query->execute();

        $result = array();
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new Entity($con, $row); // using empty brackets. put available item into the next available space
        }
    return $result;
    }
   
}

?>