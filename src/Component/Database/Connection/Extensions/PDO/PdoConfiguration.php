<?php
namespace Laventure\Component\Database\Connection\Extensions\PDO;

use Laventure\Component\Database\Connection\Configuration\Configuration;
use Laventure\Component\Database\Connection\Configuration\ConfigurationException;
use PDO;


/**
 * @PdoConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Connection\Extensions\PDO
*/
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
     * @return string
    */
    public function getDriverName(): string
    {
        $driver =  parent::getDriverName();

        if (! in_array($driver, PDO::getAvailableDrivers())) {
             $this->abortIf();
        }
    }




    /**
     * @return string
    */
    public function getDsn(): string
    {
         if ($this->has('dsn')) {
             return $this->get('dsn');
         }

         return '';
    }





    /**
     * @return void
    */
    public function refreshDsn(): void
    {
         $this->merge(['dsn' => $this->getDsn()]);
    }






    /**
     * @return array
    */
    public function getOptions(): array
    {
         $this->merge(['options' => $this->options]);

         return $this->get('options');
    }




    /**
     * @return array
    */
    public function toArray(): array
    {
        return [
           'dsn'      => $this->getDsn(),
           'username' => $this->getUsername(),
           'password' => $this->getPassword(),
           'options'  => $this->getOptions()
        ];
    }





    private function buildDsnFromParams(): string
    {
         return '';
    }
}