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
// https://github.com/neerajsinghsonu/PDO_Class_Wrapper
interface Helper
{
  public function displayHtmlTable(array $data);

  public function formatSql(string $sql);

  public function highlightSql(string $sql);
  
  public function setErrorLog();

  public function showError();
}
