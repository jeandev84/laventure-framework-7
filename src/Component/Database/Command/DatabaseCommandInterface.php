<?php
namespace Laventure\Component\Database\Command;

interface DatabaseCommandInterface
{
    public function createDatabase();
    public function dropDatabase();
}