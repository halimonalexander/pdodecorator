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

namespace HalimonAlexander\PDODecorator\Statements;

use PDO;
use PDOStatement;
use HalimonAlexander\PDODecorator\Interfaces\Statement;

abstract class AbstractStatement /*implements Statement*/
{
    /**
     * @var PDOStatement|null
     */
    protected $statement;
    
    /**
     * Get the amount of rows affected by the executed query
     */
    abstract public function getAffectedRows(): int;
    
    /**
     * Get count of rows in result statement
     */
    abstract public function getNumRows(): int;
    
    public function __construct(PDOStatement $statement = null)
    {
        $this->statement = $statement;
    }
    
    
    // new style
    
    /** @inheritdoc */
    abstract public function fetchAll($style = PDO::FETCH_ASSOC);
    
    /** @inheritdoc */
    abstract public function fetchAssoc($fields, $unique = false);
    
    /** @inheritdoc */
    abstract public function fetchClass();
    
    /** @inheritdoc */
    abstract public function fetchColumn($column = null);
    
    /** @inheritdoc */
    abstract public function fetchObject();
    
    /** @inheritdoc */
    abstract public function fetchOne($column = null);
    
    /** @inheritdoc */
    abstract public function fetchPair($leading_empty_val = false);
    
    /** @inheritdoc */
    abstract public function fetchRow($style = PDO::FETCH_ASSOC);
    
    // Silver-style
  
    /**
     * @inheritdoc
     * @deprecated
     */
    abstract public function as_array($style = PDO::FETCH_ASSOC);
  
    /**
     * @inheritdoc
     * @deprecated
     */
    abstract public function row($column = null, $style = PDO::FETCH_ASSOC);
  
    /**
     * @inheritdoc
     * @deprecated
     */
    public function as_array_by_field($field)
    {
        $rs = $this->as_array(PDO::FETCH_ASSOC);
        
        $result = [];
        foreach ($rs as $row)
            $result[$row[$field]][] = $row;
        
        return $result;
    }
  
    /**
     * @inheritdoc
     * @deprecated
     */
    public function as_list($leading_empty_val = false)
    {
        $result = $this->as_array(PDO::FETCH_KEY_PAIR);
        
        if ($leading_empty_val)
            array_unshift($result, ["" => ""]);
        
        return $result;
    }
}