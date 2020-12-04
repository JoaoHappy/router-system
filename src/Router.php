<?php 

    namespace Src;
 
    use Src\Request;
    use Src\Dispacher;
    use Src\RouteCollection;
 
    class Router 
    {
        protected $route_collection;

        public function __construct()
        {
            $this->route_collection = new RouteCollection();
            $this->dispacher        = new Dispacher();
        }

        public function get($pattern, $callback)
        {
            $this->route_collection->add('get', $pattern, $callback);
            return $this;
        }

        public function post($pattern, $callback)
        {
            $this->route_collection->add('post', $pattern, $callback);
            return $this;
        }

        public function put($pattern, $callback)
        {
            $this->route_collection->add('put', $pattern, $callback);
            return $this;
        }

        public function delete($pattern, $callback)
        {
            $this->route_collection->add('delete', $pattern, $callback);
            return $this;
        }

        public function find($request_type, $pattern)
        {
            return $this->route_collection->where($request_type, $pattern);
        }

        protected function dispach($route, $namespace = "App\\")
        {
            return $this->dispacher->dispach($route->callback, $route->uri, $namespace);
        }

        protected function notFound()
        {
            return header("HTTP/1.0 404 Not Found", true, 404);
        }

    
        public function resolve($request)
        {
            $route = $this->find($request->method(), $request->uri());

            if($route)
            {
                return $this->dispach($route);
            }

            return $this->notFound();
        }
    }

?>