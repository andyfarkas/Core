<?php

namespace Afa\Database;

interface IRepository
{
    /**
     *
     * @param ICriteria $criteria
     * @return IEntity
     */
    function findOne(ICriteria $criteria);
    
    /**
     *
     * @param ICriteria $criteria
     * @return IEntity[]
     */
    function findMany(ICriteria $criteria);

    /**
     *
     * @param ICommand $command
     */
    function execute(ICommand $command);
}