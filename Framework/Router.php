<?php
 
    namespace Framework;
    use App\Controllers\ErrorController;

    class Router {
        protected $routes = [];
        
        /**
         * Add Routes to the router
         *
         * @param string $uri
         * @param string $method
         * @param string $controller
         * @return void
         */
        protected function registerRoute($uri,$method,$action){
            // Extracting the method and controller out of the action
            list($controller,$controllerMethod) = explode('@',$action);
            $this->routes[] = [
                'uri'=> $uri,
                'method' => $method,
                'controller' => $controller,
                'controllerMethod' => $controllerMethod
            ];
        }

        /**
         * Register get routes
         *
         * @param string $uri
         * @param string $controller
         * @return void
         */
        public function get($uri,$controller){
            $this->registerRoute($uri,'GET',$controller);
        }

        /**
         * Register post routes
         *
         * @param string $uri
         * @param string $controller
         * @return void
         */
        public function post($uri,$controller){
            $this->registerRoute($uri,'POST',$controller);
        }


        /**
         * Register delete routes
         *
         * @param string $uri
         * @param string $controller
         * @return void
         */
        public function delete($uri,$controller){
            $this->registerRoute($uri,'DELETE',$controller);
        }

        /**
         * Register put routes
         *
         * @param string $uri
         * @param string $controller
         * @return void
         */
        public function put($uri,$controller){
            $this->registerRoute($uri,'PUT',$controller);
        }


        public function route($uri){
            $requestMethod = $_SERVER['REQUEST_METHOD'];
            foreach($this->routes as $route) {
                // Separate the route into segments
                $routeSegments = explode('/',trim($route['uri'],'/'));
                // Separate the uri into segments
                $uriSegments  = explode('/',trim($uri,'/'));
                // A state condition to show whether the route match the uri or not
                $match = true;
                // Check if the number of segements are the same
                if(count($routeSegments) === count($uriSegments) && $requestMethod === $route['method']){
                    $params = [];
                    $match = true;

                    // Check the contents of the segments 
                    for($i = 0; $i < count($routeSegments); $i++) {
                        if($routeSegments[$i] !== $uriSegments[$i] && !preg_match('/\{(.+?)\}/',$routeSegments[$i])){
                            $match = false;
                            break;
                        }
    
                        if(preg_match('/\{(.+?)\}/',$routeSegments[$i],$matches)){
                            $params[$matches[1]] = $uriSegments[$i];
                            
                        }
                    }
                    // If there is a match go to the specified method
                    if($match){
                        //Assigning the controller class to variable EX (App\\Controllers\\HomeController)
                        $controller = 'App\\Controllers\\' . $route['controller'];
                        // Instantiating the controller
                        $controllerInstance = new $controller();
                        // Storing the route controller method 
                        $controllerMethod = $route['controllerMethod'];
                        // Calling this route specifc method
                        $controllerInstance->$controllerMethod($params);
                        return;
                    }
                }
                

            }
            

            ErrorController::notFound('This Page was not found');
            
        }
    }