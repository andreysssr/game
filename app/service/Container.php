<?php

namespace app\service;

class Container
{
    private $dependency;
    private $services = [];

    public function __construct(array $dependency = [])
    {
        $this->dependency = $dependency;
    }

    public function get($id)
    {
        if (array_key_exists($id, $this->services)) {
            return $this->services[$id];
        }

        if (!array_key_exists($id, $this->dependency)) {
            if (class_exists($id)) {
                return $this->services[$id] = $this->resolveDependency($id);
            }
            throw new \Exception('Unknown service (' . $id . ')');
        }

        $depend = $this->dependency[$id];

        if ($depend instanceof \Closure) {
            $this->services[$id] = $depend($this);
        } elseif(is_string($depend)){
            $this->services[$id] = $this->get($depend);
        }elseif(is_array($depend)){
            $this->services[$id] = new $id($this->parseArray($depend));
        }

        return $this->services[$id];
    }

    public function parseArray($depend)
    {
        $arr = [];
        foreach ($depend as $service) {
            $arr[] = $this->get($service);
        }
        return $arr;
    }

    public function set($id, $value): void
    {
        if ($id === 'config'){
            empty($this->services[$id]) ? $this->services[$id] = $value :
                $this->services[$id] = array_merge($this->services[$id], $value);
        }else{
            if (array_key_exists($id, $this->services)) {
                unset($this->services[$id]);
            }
            $this->dependency[$id] = $value;
        }
    }

    private function resolveDependency($item)
    {
        if(is_callable($item)) {
            return $item($this);
        }

        $reflectionItem = new \ReflectionClass($item);
        return $this->getInstance($reflectionItem);
    }

    private function getInstance(\ReflectionClass $item)
    {
        $constructor = $item->getConstructor();
        if (is_null($constructor) || $constructor->getNumberOfRequiredParameters() == 0) {
            return $item->newInstance();
        }
        $params = [];
        foreach ($constructor->getParameters() as $param) {
            if ($type = $param->getType()) {
                $params[] = $this->get($type->getName());
            }
        }
        return $item->newInstanceArgs($params);
    }
}



