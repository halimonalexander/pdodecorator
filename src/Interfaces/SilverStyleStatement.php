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

interface SilverStyleStatement
{
    public function as_array();
    public function as_object();
    public function as_array_by_field(string $field);
    public function as_array_by_field_unique();
    public function as_array_by_multifield(string $field1, string $field2);
    public function as_list();
    public function row();
    public function column();
}
