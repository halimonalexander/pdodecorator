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

namespace HalimonAlexander\PDODecorator\Interfaces;

interface FastStatement
{
    /**
     * Get all records as assoc arrays
     * 
     * @return array
     */
    public function getAll();
    
    /**
     * Get the first column
     * 
     * @return array
     */
    public function getCol();
    
    /**
     * Get the value
     * 
     * @return mixed
     */
    public function getOne();
    
    /**
     * Gets one row as assoc array
     * 
     * @return array
     */
    public function getRow();
}
