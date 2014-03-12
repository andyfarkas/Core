<?php

namespace Afa\Model\Request\Entity;

interface IMultiple
{

    /**
     * @param \Afa\Database\IRepository $repository
     * @return \Afa\Database\IEntity[]
     */
    public function findEntities(\Afa\Database\IRepository $repository);

}