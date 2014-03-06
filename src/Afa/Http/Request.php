<?php

namespace Afa\Http;

class Request implements IRequest
{
    
    /**
     *
     * @var array
     */
    protected $server = array();

    /**
     * @var string
     */
    protected $basePath = null;

    /**
     *
     * @param array $server
     * @param $basePath
     */
    public function __construct(array $server, $basePath)
    {
        $this->server = $server;
        $this->basePath = $basePath;
    }

    /**
     * 
     * @return IResource
     */
    public function mapToResource()
    {
        $urlParts = parse_url($this->server['REQUEST_URI']);
        $path = trim($urlParts['path'], '/');
        $pathParts = explode('/', $path);
        $resourceName = array_shift($pathParts);
        $actionName = array_shift($pathParts);
        
        $queryParameters = array();
        if (isset($urlParts['query']))
        {
            parse_str($urlParts['query'], $queryParameters);
        }
        
        if (is_numeric($actionName))
        {
            $queryParameters['id'] = $actionName;
            $actionName = array_shift($pathParts);
            
            if (!$actionName)
            {
                $actionName = 'detail';
            }
        }
        
        return new Resource($resourceName, $actionName, $queryParameters);
    }

}