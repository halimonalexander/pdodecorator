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

    private static $stringDSN = null;

    /**
     * @param string $field
     * @return bool
     */
    private static function isRequired(string $field): bool
    {
        return in_array($field, self::$required);
    }

    /**
     * @param string $field
     * @return string
     * @throws Exception
     */
    public static function get(string $field): string
    {
        if (self::isRequired($field) && empty(self::$dsn[$field])) {
            throw new Exception('Fill the DNS');
        }

        return self::$dsn[$field];
    }

    /**
     * @param array|string $dns
     */
    public static function set($dns)
    {
        self::$dsn = $dns;
    }

    /**
     * @return string
     * @throws Exception
     */
    public static function getStringDSN(): string
    {
        self::$stringDSN = sprintf(
            "%s:host=%s;dbname=%s",
            self::get('driver'),
            self::get('host'),
            self::get('database')
        );
        if (!empty(self::get('port'))) {
            self::$stringDSN .= ";port=".self::get('port');
        }

        return self::$stringDSN;
    }
}
