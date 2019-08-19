<?php


class Controller {
    public static function CreateView($viewName, $object) {
        if(file_exists("./includes/views/$viewName.php")){
            $pageCss = $viewName;
            $pageJs = $viewName;
            $data = $object;
            require_once "./static/components/header.php";
            require "./includes/views/$viewName.php";
            require_once "./static/components/footer.php";
        }else{
            self::NotExistingPage();
        }

    }

    public static function NotExistingPage(){
        // Let's make a nice 404 page :)
        require_once "./includes/views/error.php";
        die();
    }
}