<?php
    /**
     * Find the path relative to the root document
     *
     * @param string $path
     * @return string
     */
    function basePath ($path = '') {
        return( __DIR__ . '/' . $path);
    }

    /**
     * Load specific view (if exists)
     *
     * @param string $name
     * @return void
     */
    function loadView($name){
        $viewPath = basePath("views/{$name}.view.php");
        if(file_exists($viewPath)){
            require($viewPath);
        }else {
            echo "View {$name} doesn't exist";
        }
    }

    /**
     * Load specific view (if exists)
     *
     * @param string $name
     * @return void
     */
    function loadPartial($name){
        $partialPath = basePath("views/partials/{$name}.php");
        if(file_exists($partialPath)){
            require($partialPath);
        }else {
            echo "View {$name} doesn't exist";
        }
    }

    /**
     * Inspect a specific value
     *
     * @param any $value
     * @return void
     */
    function inspect ($value) {
        echo '<pre>';
        var_dump($value);
        echo '</pre>';
    }
    /**
     * Inspect a specific value and terminate script execution
     *
     * @param any $value
     * @return void
     */
    function inspectAndDie ($value) {
        echo '<pre>';
        die(var_dump($value));
        echo '</pre>';
    }