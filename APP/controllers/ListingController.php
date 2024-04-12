<?php
    namespace App\Controllers;
    use Framework\Database;

    class ListingController {
        protected $database;

        /**
         * Instantiate the database
         */
        public function __construct()
        {
            $config = require basePath('config.php');
            $this->database = new Database($config);
        }
        /**
         * Show all Listings
         *
         * @return void
         */
        public function index(){
            $listings = $this->database->query('SELECT * FROM listings')->fetchAll();
            loadView('listings/index',[
                'listings'=> $listings
            ]);
        }

        /**
         * Show all Job posts
         *
         * @return void
         */
        public function show($params){
            // Get the id from the request
            $id = $params['id'] ?? '';
            $params = [
                'id' => $id
            ];
            // Fetch the post from the database
            $listing = $this->database->query('SELECT * FROM listings WHERE id = :id',$params)->fetch();
            // Check if listing exists
            if(!$listing){
                ErrorController::notFound('Listing was not found');
                return;
            }
            // Inject the data into the view
            loadView('listings/show',['listing'=>$listing]);
        }

        public function create(){
            // Temp. Implementation
            loadView('listings/create');
        }

    }