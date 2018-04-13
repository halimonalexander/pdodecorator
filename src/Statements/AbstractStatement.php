<?php
namespace HalimonAlexander\PDODecorator\Statements;

abstract class AbstractStatement
{
    protected $statement;
    protected $numRows;
    
    /** Get count of rows in result statement */
    abstract protected function getNumRows(): int;
    
    public function __construct(PDOStatement $statement = null)
    {
        $this->statement = $statement;
        $this->numRows = $this->getNumRows();
    }
    
    
    
    
    
    // Silver-style
    
    /** @inheritdoc */
    abstract public function as_array($style = PDO::FETCH_ASSOC);
    
    /** @inheritdoc */
    abstract public function as_object();
    
    /** @inheritdoc */
    abstract public function row($column = null, $style = PDO::FETCH_ASSOC);
    
    abstract public function getOne();
    
    /** @inheritdoc */
    public function as_array_by_field($field)
    {
        $rs = $this->as_array(PDO::FETCH_ASSOC);
        
        $result = [];
        foreach ($rs as $row)
            $result[$row[$field]][] = $row;
        
        return $result;
    }
    
    /** @inheritdoc */
    public function as_array_by_field_uniq($field)
    {
        $rs = $this->as_array(PDO::FETCH_ASSOC);
        
        $result = [];
        foreach ($rs as $row)
            $result[$row[$field]] = $row;
        
        return $result;
    }
    
    /** @inheritdoc */
    public function column($column = null)
    {
        if ($column === null){
            $style = PDO::FETCH_NUM;
            $column = 0;
        }
        else
            $style = PDO::FETCH_ASSOC;
        
        $rs = $this->as_array($style);
        
        $result = [];
        foreach ($rs as $row)
            $result[] = $row[$column];
        
        return $result;
    }
    
    /** @inheritdoc */
    public function as_list($leading_empty_val = false)
    {
        $result = $this->as_array(PDO::FETCH_KEY_PAIR);
        
        if ($leading_empty_val)
            array_unshift($result, ["" => ""]);
        
        return $result;
    }
}