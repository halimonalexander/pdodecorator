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

namespace HalimonAlexander\PDODecorator;

use Exception;

class DSN
{
    private static $dsn = [
        "driver"   => null,
        "host"     => null,
        "port"     => null,
        "username" => null,
        "password" => null,
        "database" => null,
        "schema"   => null,
    ];
  
    private static $required = ["driver", "host", "database"];

    private static $stringDsn = null;

    /**
     * @param string $field
     * @return string
     * @throws Exception
     */
    public static function get(string $field): string
    {
        if (self::isRequired($field) && empty(self::$dsn[$field])) {
            throw new Exception('Fill the DSN');
        }

        return self::$dsn[$field];
    }

    /**
     * @param array|string $dsn
     */
    public static function set($dsn)
    {
        self::$dsn = $dsn;
    }

    /**
     * @return string
     * @throws Exception
     */
    public static function getStringDSN(): string
    {
        self::$stringDsn = sprintf(
            "%s:host=%s;dbname=%s",
            self::get('driver'),
            self::get('host'),
            self::get('database')
        );
        if (!empty(self::get('port'))) {
            self::$stringDsn .= ";port=".self::get('port');
        }

        return self::$stringDsn;
    }
  
    /**
     * @param string $field
     * @return bool
     */
    private static function isRequired(string $field): bool
    {
        return in_array($field, self::$required);
    }
}
