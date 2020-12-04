<?php 

    namespace Src;
 
    class Dispacher 
    {
        public function dispach($callback, $params = [], $namespace = "App\\")
        {
            // verifica se é uma função
            if(is_callable($callback))
            {
                // chama uma função com os parametros de um array
                return call_user_func_array($callback, array_values($params));
            }
            //verifica se é uma string
            elseif(is_string($callback))
            {
                //vamos ver ser existe o @ na callback
                if(!strpos($callback, '@') !== false)
                {
                    $callback   = explode('@', $callback);
                    $controller = $namespace.$callback[0];
                    $method     = $callback[1];

                    // extrair informação do controller
                    $rc = new \ReflectionClass($controller);

                    if($rc->isInstance() && $rc->hasMethod($method))
                    {
                        return call_user_func_array(array(new $controller, $method), array_values($params));
                    }
                    else
                    {
                        throw new Exception("Erro ao despachar: controller não pode ser instanciado ou método não existe");             
                    }
                }
            }

            throw new Exception("Erro ao despachar: método não implementado");
            
        }
    }

?>