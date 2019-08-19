<?php

class Route {
    // ACHTUNG !!! Declare all routes in the array below otherwise it you won't be able to load the routes
    // An array with all existing routes which will be checked on autoload
    public static $validRoutes = array('index.php', 'category', 'sign-up', 'verify', 'create-user', 'login', 'topic', 'error', 'logout', 'create-topic', 'api-create-topic', 'edit-topic', 'api-edit-topic', 'reply', 'api-reply');

    public static function set($route, $function) {

        //self::$validRoutes[] = $route;


        if ($_GET['url'] === $route) {
           //echo $_GET['url'];
            $pageExist = true;
            $function->__invoke();
        }

    }


   public static  function check_route_exist(){
        // declaring $route_exist to false and loop though valid routes
       // once we if the routes we assign $route_exist to be false and then return the value to the function
        $route_exist = false;
        $route_length = count(self::$validRoutes);
        for($i= 0 ; $i < $route_length ; $i++){
            // we create an array of the
            $uri_element = explode('/', $_SERVER['REQUEST_URI']);
            $uri_element_length = count($uri_element);

            if($_GET['url'] === self::$validRoutes[$i]){

                if($uri_element_length > 3){
                    $route_exist = false;
                }else{
                    $route_exist = true;

                }
            }

        }
        //echo $route_exist;
        return $route_exist;
    }
}