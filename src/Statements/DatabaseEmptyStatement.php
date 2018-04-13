<?

namespace HalimonAlexander\PDODecorator\Statements;

use PDO;
use stdClass;

class DatabaseEmptyStatement extends AbstractStatement
{
    /** @inheritdoc */
    protected function getNumRows(): int
    {
        return 0;
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
    public function as_object()
    {
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
    
    /** @inheritdoc */
    public function getOne()
    {
        return null;
    }
}