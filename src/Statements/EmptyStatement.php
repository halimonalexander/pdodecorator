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

namespace HalimonAlexander\PDODecorator\Statements;

use PDO;
use stdClass;

class EmptyStatement extends AbstractStatement
{
    /**
     * @inheritdoc
     */
    protected function getAffectedRows(): int
    {
        return 0;
    }
    
    /** @inheritdoc */
    protected function getNumRows(): int
    {
        return 0;
    }
    
    // new style
    
    /** @inheritdoc */
    public function fetchAll($style = PDO::FETCH_ASSOC)
    {
        return [];
    }
    
    /** @inheritdoc */
    public function fetchAssoc($fields, $unique = false)
    {
        return [];
    }
    
    /** @inheritdoc */
    public function fetchClass()
    {
        return null;
    }
    
    /** @inheritdoc */
    public function fetchCol($column = null)
    {
        return [];
    }
    
    /** @inheritdoc */
    public function fetchObject()
    {
        return new stdClass();
    }
    
    /** @inheritdoc */
    public function fetchOne()
    {
        return null;
    }
    
    /** @inheritdoc */
    public function fetchPair($leading_empty_val = false)
    {
        $result = [];
        
        if ($leading_empty_val) {
            $result[] = ["" => ""];
        }
        
        return $result;
    }
    
    /** @inheritdoc */
    public function fetchRow($style = PDO::FETCH_ASSOC)
    {
        switch ($style) {
            case PDO::FETCH_ASSOC:
                return [];
            case PDO::FETCH_OBJ:
                return new stdClass();
            default:
                return null;
        }
    }
    
    // Silver-style
    
    /** @inheritdoc */
    public function as_array($style = PDO::FETCH_ASSOC)
    {
        if ($style == PDO::FETCH_ASSOC)
            return [];
        else
            return new stdClass();
    }
    
    /** @inheritdoc */
    public function row($column = null, $style = PDO::FETCH_ASSOC)
    {
        if ($column !== null)
            return null;
        
        if ($style == PDO::FETCH_ASSOC)
            return [];
        
        return new stdClass();
    }
}