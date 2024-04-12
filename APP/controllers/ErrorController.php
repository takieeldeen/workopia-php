<?php
    namespace App\Controllers;

    class ErrorController {
        /**
         * Resource Not found error (404)
         *
         * @param string $message
         * @return void
         */
        public static function notFound($message = 'Resource Not found'){
            http_response_code(404);
            loadView('Error',[
                'status' => 404,
                'message' => $message
            ]);
        }

        /**
         * Resource Not found error (404)
         *
         * @param string $message
         * @return void
         */
        public static function unauthorized($message = 'You are not authorized to access this resource'){
            http_response_code(403);
            loadView('Error',[
                'status' => 403 ,
                'message' => $message
            ]);
        }

        
    }