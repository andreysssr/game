<?php

namespace core\Container;


class Container
{
    private $definitions = [];
    private $results = [];

    public function __construct(array $definitions = [])
    {
        $this->definitions = $definitions;
    }

    public function get($id)
    {
        if (array_key_exists($id, $this->results)) {
            return $this->results[$id];
        }

        if (!array_key_exists($id, $this->definitions)) {
            if (class_exists($id)) {
                $reflection = new \ReflectionClass($id);
                $arguments = [];
                if (($constructor = $reflection->getConstructor()) !== null) {
                    foreach ($constructor->getParameters() as $parameter) {
                        if ('array' != (string) $parameter->getType()){
                            $arguments[] = $this->get((string)$parameter->getType());
                        }
                    }

                    $this->results[$id] = $reflection->newInstanceArgs($arguments);
                    return $this->results[$id];
                }
            }

            throw new \Exception('Unknown service "' . $id . '"');
        }

        $definition = $this->definitions[$id];

        if ($definition instanceof \Closure) {
            $this->results[$id] = $definition($this);
        } else {
            $this->results[$id] = $definition;
        }

        return $this->results[$id];
    }

    public function has($id): bool
    {
        return array_key_exists($id, $this->definitions) || class_exists($id);
    }

    public function set($id, $value): void
    {
        if ($id === 'config'){
            empty($this->results[$id]) ? $this->results[$id] = $value :
                $this->results[$id] = array_merge($this->results[$id], $value);
        }else{
            if (array_key_exists($id, $this->results)) {
                unset($this->results[$id]);
            }
            $this->definitions[$id] = $value;
        }
    }
}

