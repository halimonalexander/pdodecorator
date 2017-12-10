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

namespace HalimonAlexander\PDODecorator\Classes;

/**
 * Class AbstractStatement
 */
abstract class AbstractStatement implements \HalimonAlexander\PDODecorator\Interfaces\Statement
{
  /**
   * @var int
   */
  protected $affectedRows = 0;

  /**
   * @var int
   */
  protected $numRows = 0;

  /** @var \PDOStatement|null */
  protected $statement = null;

  function affectedRows()
  {
    return $this->numRows ?: $this->affectedRows;
  }
}