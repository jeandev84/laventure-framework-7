<?php
namespace Laventure\Component\Database\Connection\Extensions\PDO;

use Laventure\Component\Database\Connection\Configuration\Configuration;
use Laventure\Component\Database\Connection\Configuration\ConfigurationException;
use PDO;


class PdoConfiguration extends Configuration
{
    /**
     * @var array
    */
    protected array $options = [
        PDO::ATTR_PERSISTENT          => true,
        PDO::ATTR_EMULATE_PREPARES    => 0,
        PDO::ATTR_DEFAULT_FETCH_MODE  => PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE             => PDO::ERRMODE_EXCEPTION,
    ];



    /**
     * @param array $params
    */
    public function __construct(array $params)
    {
        parent::__construct($params);
    }






    /**
     * @return bool
     *
     * @throws ConfigurationException
    */
    public function driverExists(): bool
    {
         return in_array($this->getDriverName(), PDO::getAvailableDrivers());
    }





    /**
     * @return string
    */
    public function getDsn(): string
    {
         return '';
    }





    /**
     * @return array
    */
    public function getOptions(): array
    {
         $this->merge(['options' => $this->options]);

         return $this->get('options');
    }
}