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

interface Crud
{
    public function select();
  
    public function insert($table, $data);
  
    public function update();
  
    public function delete();
  
    public function truncate($table);
  
    public function drop();

    public function save();
  
    public function bulkInsert();
  
    public function count();
}
