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

// https://github.com/jlake/EasyPDO
interface Statement
{
    /**
     * @param int $style
     * @return mixed
     */
    public function fetchAll($style = \PDO::FETCH_ASSOC);

    /**
     * @param string|array $fields
     * @param bool $unique
     * @return mixed
     */
    public function fetchAssoc($fields, $unique = false);

    /**
     * @return mixed
     */
    public function fetchClass();

    /**
     * Returns the first, or the specified column of the result as array.
     *
     * @param null $column
     * @return array
     */
    public function fetchCol($column = null);

    /**
     * Returns all rows as objects.
     * 
     * @return mixed
     */
    public function fetchObject();

    /**
     * @return mixed
     */
    public function fetchOne();

    /**
     * Returns result as: key => value. The first field would become a key, and the second will became a value.
     * The rest of fields will be ignored.
     *
     * @param bool $leadingEmptyValue
     * @return array
     */
    public function fetchPair($leadingEmptyValue = false);

    /**
     * Returns a single row as array or object.
     *
     * @param int  $style
     * @return null|array|\stdClass
     */
    public function fetchRow($style = \PDO::FETCH_ASSOC);
}
