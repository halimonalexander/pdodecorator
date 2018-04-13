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

namespace HalimonAlexander\PDODecorator\Classes;

trait ArrayDecoratorTrait
{
    /**
     *
     */
    public function arrayToXml($array)
    {
        $xml = '<?xml version=\"1.0\" encoding=\"UTF-8\"?><root>';
        foreach ($array as $key => $value) {
            $xml .= "<xml_data>";
      
            if (is_array($value)) {
                foreach ($value as $k => $v) {
                    $xml .= "<$k><![CDATA[$v]]></$k>";
                }
            } else {
                $xml .= "<$key><![CDATA[$value]]></$key>";
            }
      
            $xml .= "</xml_data>";
        }
        $xml .= "</root>";
    
        return $xml;
    }

    /**
     * 
     */
    public function printArray($array): void
    {
        echo '<pre style="text-align: left">'.print_r($array, true).'</pre>';
    }
    
    /**
     * Checks if array is assoc
     * 
     * @param array $array
     * @return bool
     */
    public function isAssoc(array $array): bool
    {
        if (empty($array))
            return false;
        
        return array_keys($array) !== range(0, count($array) - 1);
    }
}
