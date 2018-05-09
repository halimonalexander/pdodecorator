<?php
/*
 * This file is part of PDODecorator.
 *
 * (c) Halimon Alexander <vvthanatos@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace HalimonAlexander\PDODecorator;
    
    // https://github.com/jlake/EasyPDO
    // https://github.com/neerajsinghsonu/PDO_Class_Wrapper

use Exception;
use PDO;
use PDOException;
    
/**
 * Class PDODecorator
 */
class PDODecorator
{
    use Classes\ArrayDecoratorTrait;

    /** @var bool */
    protected $errorReporting;

    /** @var array */
    protected $queries = [];

    /** @var array */
    protected $queriesTimes = [];

    /** @var Classes\Helper */
    public $helper;

    /** @var Classes\Transaction */
    public $transaction;
  
    /** @var PDO */
    private $PDO;
  
    public function connect()
    {
        try {
            $this->PDO = new PDO(DSN::getStringDSN(), DSN::get('username'), DSN::get('password'));
            
            $driver = DSN::get('driver');
            if ($driver == 'pgsql') {
                $shema = DSN::get('shema');
            }
        } catch (PDOException $e) {
            echo 'Unable to connect: ' . $e->getMessage();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }

        if ($driver == 'pgsql' && empty($shema)) {
            $this->query("SET search_path TO {$shema};");
        }
    }
  
    /**
     * Database connection init
     *
     * @param $host
     * @param $user
     * @param $password
     * @param $database
     * @param $shema
     */
    public function __construct()
    {
        $this->connect();
        
        $this->helper = new Classes\Helper();
        $this->transaction = new Classes\Transaction();
    }

    /** @inheritdoc */
    public function query($sql)
    {
        $this->queries[] = $sql;
    
        $start = microtime(true);
        $rs = $this->PDO->query($sql);
        $stop = microtime(true);
        $this->queriesTimes[] = $stop - $start;
    
        if (!$rs) {
            if ($this->errorReporting) {
            }
            return new Classes\EmptyStatement();
        }

        return new Classes\FilledStatement($rs);
    }

    public function enableReporting()
    {
        $this->errorReporting = true;
    }
    public function disableReporting()
    {
        $this->errorReporting = false;
    }

    /** @inheritdoc */
    public function __destruct()
    {
        $this->PDO = null;
    }
}
