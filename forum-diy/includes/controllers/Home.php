<?php

class Home extends Controller {

    /*
     * Michal: Just to make sure that it works
     * I made a function that is called in the routes.php
     * I should return something at the bottom of the page
     */
    public function DatabaseTest() {
        $modeltest = new Model;
        print_r( $modeltest->db);
    }
}