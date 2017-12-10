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
 * Class Statement
 */
class Statement
{
  function __construct(\PDOStatement $statement)
  {
    $this->statement = $statement;
    $this->numRows = $statement->rowCount();
  }

  /** @inheritdoc */
  public function fetchAll($style = \PDO::FETCH_ASSOC)
  {
    return $this->statement->fetchAll($style);
  }

  /** @inheritdoc */
  public function fetchAssoc($fields, $unique = false)
  {
    $rs = $this->fetchAll();
    $result = [];
    foreach ($rs as $row)
      if ($unique)
        if (!is_array($fields))
          $result[$row[$fields]] = $row;
        else
          $result[ $row[$fields[0]] ][ $row[$fields[1]] ] = $row;
      else
        if (!is_array($fields))
          $result[$row[$fields]][] = $row;
        else
          $result[ $row[$fields[0]] ][ $row[$fields[1]] ][] = $row;

    return $result;
  }

  /** @inheritdoc */
  public function fetchClass()
  {
    return $this->statement->fetch(\PDO::FETCH_CLASS);
  }

  /** @inheritdoc */
  public function fetchCol($column = null)
  {
    if ($column === null){
      $style = \PDO::FETCH_NUM;
      $column = 0;
    }
    else
      $style = \PDO::FETCH_ASSOC;

    $result = [];
    $rs = $this->fetchAll($style);
    foreach ($rs as $row)
      $result[] = $row[$column];

    return $result;
  }

  /** @inheritdoc */
  public function fetchObject()
  {
    return $this->statement->fetchAll(\PDO::FETCH_OBJ);
  }

  /** @inheritdoc */
  public function fetchOne($column = null)
  {
    $rs = $this->statement->fetch(\PDO::FETCH_ASSOC);
    if ($column == null)
      return array_shift($rs);
    elseif ( isset($rs[$column]) )
      return $rs[$column];
    else
      return null;
  }

  /** @inheritdoc */
  public function fetchPair($leading_empty_val = false)
  {
    $rs = $this->fetchAll(\PDO::FETCH_NUM);
    $result = [];
    foreach ($rs as $row)
      $result[$row[0]] = $row[1];

    if ($leading_empty_val)
      array_unshift($result, ["" => ""]);

    return $result;
  }

  /** @inheritdoc */
  public function fetchRow($style = \PDO::FETCH_ASSOC)
  {
    return $this->statement->fetch($style);
  }
}
