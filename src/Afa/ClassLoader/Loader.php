<?php

namespace Afa\ClassLoader;

class Loader
{
    
    /**
     *
     * @var string[]
     */
    protected $registeredPaths = array();
    
    /**
     * 
     * @param string $path
     */
    public function addClasspath($path)
    {
        $this->registeredPaths[] = rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    }
    
    /**
     * 
     * @param string $classname     
     */
    public function load($classname)
    {
        $filename = str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
        foreach ($this->registeredPaths as $path)
        {
            $filePath = $path . $filename;
            if (is_file($filePath))
            {
                require_once($filePath);
                return;
            }
        }
    }
    
    public function register()
    {
        spl_autoload_register(array($this, 'load'));
    }
    
}