<?php

abstract class DomainObject{

    abstract protected function getFieldNames();

    public function __construct(array $data){
        if (!empty($data)) {
            foreach ($data as $name => $value) {
                __set($this->$name, $value);
            }
        }
    }

    public function __get($name){
        if(isset($this->$name)){
            return $this->$name;
        }
        return null;
    }
    public function __set($name, $value){
        $mutator = 'set' . ucfirst($name);
        if(method_exists($this, $mutator) && is_callable(array($this, $mutator))){
            $this->$mutator($value);
        }
        else{
            $this->$name = $value;
        }

    }
    public function __isset($name){
        return isset($this->$name);
    }
    public function __unset($name){
        unset($name);
    }
    public function doesFieldExist($name){
        return property_exists($this, $name);
    }
}

?>