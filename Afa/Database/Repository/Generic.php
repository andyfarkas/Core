<?php

namespace Afa\Database\Repository;

class Generic implements \Afa\Database\IRepository
{
    
    /**
     *
     * @var \Afa\Database\IConnection
     */
    protected $connection;
    
    /**
     * 
     * @param \Afa\Database\IConnection $connection
     */
    public function __construct(\Afa\Database\IConnection $connection)
    {
        $this->connection = $connection;
    }
    
    public function findMany(\Afa\Database\ICriteria $criteria)
    {
        
    }

    /**
     * 
     * @param \Afa\Database\ICriteria $criteria
     * @return \Afa\Database\IEntity
     * @throws Exception\ObjectNotFound
     */
    public function findOne(\Afa\Database\ICriteria $criteria)
    {
        $result = $criteria->query($this->connection);
        $rowData = $result->current();
        if ($rowData === false)
        {
            throw new Exception\ObjectNotFound('Requested object was not found');
        }
        
        return $criteria->createEntity($rowData);
    }

}