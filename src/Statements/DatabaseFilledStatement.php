<?

namespace Core\Classes;

use PDO;

class DatabaseFilledStatement extends AbstractStatement
{
    /** @inheritdoc */
    protected function getNumRows(): int
    {
        return $this->statement->rowCount();
    }
    
    
    // Silver-style
    
    /** @inheritdoc */
    public function as_array($style = PDO::FETCH_ASSOC)
    {
        return $this->statement->fetchAll($style);
    }
    
    /** @inheritdoc */
    function as_object()
    {
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }
    
    /** @inheritdoc */
    function row($column = null, $style = PDO::FETCH_ASSOC)
    {
        if ($column === null)
            return $this->statement->fetch($style);
        
        $rs = $this->statement->fetch(PDO::FETCH_OBJ);
        
        return isset($rs->{$column}) ? $rs->{$column} : null;
    }
    
    /** @inheritdoc */
    public function getOne()
    {
        return $this->statement->fetch(PDO::FETCH_COLUMN);
    }
}