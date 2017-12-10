<?
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

/**
 * Class PDODecorator
 */
class PDODecorator{
  
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
  
  /** @var \PDO */
  private $PDO;
  
  public function connect()
  {
    try {
      $this->PDO = new \PDO(DNS::getParsed(), DNS::get('username'), DNS::get('password'));
    } catch (\PDOException $e) {
      echo 'Unable to connect: ' . $e->getMessage();
    }

    if (DNS::get('driver') == 'pgsql') {
      $shema = DNS::get('shema');
      if ($shema)
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
  function __construct(){
    $this->connect();
    $this->helper = new Classes\Helper();
    $this->transaction = new Classes\Transaction();
  }

  /** @inheritdoc */
  function query($sql)
  {
    $this->queries[] = $sql;
    
    $start = microtime(true);
    $rs = $this->PDO->query($sql);
    $stop = microtime(true);
    $this->queriesTimes[] = $stop - $start;
    
    if (!$rs){
      if ($this->errorReporting) {
      }
      return new Classes\EmptyStatement();
    }

    return new Classes\Statement($rs);
  }

  function enableReporting(){
    $this->errorReporting = true;
  }
  function disableReporting(){
    $this->errorReporting = false;
  }

  /** @inheritdoc */
  function __destruct()
  {
    $this->PDO = null;
  }
}
