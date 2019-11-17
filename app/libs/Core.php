<?php

class Core
{
    //define vars
    protected $currentController = 'pages';
    protected $currentMethod = 'index';
    protected $parameters = [];

    public function __construct()
    {
        $url = $this->getUrl();

        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
            $this->currentController = ucwords($url[0]);

            //unset url 
            unset($url[0]);
        }

        //require the controller
        require_once '../app/controllers/' . $this->currentController . '.php';
        $this->currentController = new $this->currentController;

        //validate if exist url in the param 1
        if(isset($url[1])){
            if(method_exists($this->currentController , $url[1])){
                $this->currentMethod = $url[1];

                //unset url 
                unset($url[1]);
            }
        }

        //validate the parameter
        $this->parameters = $url ? array_values($url) : [];

        //get the parameters
        call_user_func_array([$this->currentController , $this->currentMethod] , $this->parameters);
    }

    public function getUrl()
    {
        //confirm if the url exist
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'] , '/');
            $url = filter_var($url , FILTER_SANITIZE_URL);
            $url = explode('/' , $url);
            return $url;
        }
    }
}