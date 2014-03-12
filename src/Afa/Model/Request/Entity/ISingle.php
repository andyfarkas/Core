<?php

namespace Afa\Model\Request\Entity;

interface ISingle
{

    /**
     * @param \Afa\Database\IRepository $repository
     * @return \Afa\Database\IEntity
     */
    public function findEntity(\Afa\Database\IRepository $repository);

}