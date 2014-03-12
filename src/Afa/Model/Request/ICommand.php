<?php

namespace Model\Request;

interface ICommand
{

    /**
     * @param \Afa\Database\IRepository $repository
     */
    public function execute(\Afa\Database\IRepository $repository);

}