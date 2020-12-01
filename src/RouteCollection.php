<?php 
    namespace Src;
 
    class RouteCollection 
    {
         protected $routes_post   = [];
         protected $routes_get    = [];
         protected $routes_put    = [];
         protected $routes_delete = [];

         public function add($request_type, $pattern, $callback) 
         {
             switch($request_type)
             {
                 case 'post':
                    return $this->addPost($pattern, $callback);
                 break;
                 case 'get':
                    return $this->addGet($pattern, $callback);
                 break;
                 case 'put':
                    return $this->addPut($pattern, $callback);
                 break;
                 case 'delete':
                    return $this->addDelete($pattern, $callback);
                 break;

                 default:
                    throw new Exception('Sistema de requisição não implementado');
             }
         }
         
         // vai servi para obter a rota
         public function where($request_type, $pattern)
         {

         }

         protected function definePattern($pattern)
         {
             $pattern = implode('/', array_filter(explode('/', $pattern)));
             return '/^' . str_replace('/', '\/', $pattern) . '$/';
         }

        protected function addPost($pattern, $callback)
        {
            $this->routes_post[$this->definePattern($pattern)] = $callback;
            return $this;
 
        }
     
        protected function addGet($pattern, $callback)
        {
            $this->routes_get[$this->definePattern($pattern)] = $callback;
            return $this;
        }
     
        protected function addPut($pattern, $callback)
        {
            $this->routes_put[$this->definePattern($pattern)] = $callback;
            return $this;
        }
     
        protected function addDelete($pattern, $callback)
        {
            $this->routes_delete[$this->definePattern($pattern)] = $callback;
            return $this;
        }
    }

?>