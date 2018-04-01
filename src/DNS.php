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

class DNS
{
  private static $dns = [
    "driver" => null,
    "host" => null,
    "port" => null,
    "username" => null,
    "password" => null,
    "database" => null,
    "shema" => null,
  ];
  
  private static $required = ["driver", "host", "database"];

  private static $stringDNS = null;

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
   * @throws \Exception
   */
  public static function get(string $field):string
  {
    if (self::isRequired($field) && empty(self::$dns[$field]))
      throw new \Exception('Fill the DNS');

    return self::$dns[$field];
  }

  /**
   * @param array|string $dns
   */
  public static function set($dns)
  {
    self::$dns = $dns;
  }

  /**
   * @return string
   * @throws \Exception
   */
  public static function getParsed(): string
  {
    self::$stringDNS = sprintf(
      "%s:host=%s;dbname=%s",
      self::get('driver'),
      self::get('host'),
      self::get('database')
    );
    if (!empty(self::get('port')))
      self::$stringDNS .= ";port=".self::get('port');

    return self::$stringDNS;
  }
}
