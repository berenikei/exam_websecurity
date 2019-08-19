<?php

class Categories extends Model{
    public function get_categories(){
        try{
            $sQuery = $this->db->prepare('SELECT * FROM categories ');
            $sQuery->execute();
            $categories = $sQuery->fetchAll();
            if (count($categories)) {
                return $categories;
            }
        }catch (PDOException $e){
            LogSaver::save_the_log($e, 'category.txt');
        }

    }
}