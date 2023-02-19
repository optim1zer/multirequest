<?php

namespace MultiRequest;


/**
 * @see https://github.com/barbushin/multirequest
 * @author Barbushin Sergey http://linkedin.com/in/barbushin
 *
 */
class Defaults
{

    protected array $properties = [];
    protected array $methods = [];

    public function applyToRequest(Request $request)
    {
        foreach ($this->properties as $property => $value) {
            $request->$property = $value;
        }
        foreach ($this->methods as $method => $calls) {
            foreach ($calls as $arguments) {
                call_user_func_array([$request, $method], $arguments);
            }
        }
    }

    public function __set($property, $value)
    {
        $this->properties[$property] = $value;
    }

    public function __call($method, $arguments = [])
    {
        $this->methods[$method][] = $arguments;
    }
}
