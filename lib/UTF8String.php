<?php
/* ===========================================================================
 * Opis Project
 * http://opis.io
 * ===========================================================================
 * Copyright 2014 Marius Sarca
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ============================================================================ */

namespace Opis\HTML5;

class UTF8String implements ArrayAccess
{
    protected $chars;
    protected $codepoints;
    protected $length;
    protected $str;
    protected static $codes;
   
    public function __construct($bytes)
    {
        if($bytes === null)
        {
            return;
        }
       
        $codes = &static::getCodes();
       
        $utf8 = array();
        $l = strlen($bytes);
        $p = 0;
        $hasErrors = false;
        
        do{
            $cu1 = $codes[$bytes[$p++]];
           
            if($cu1 < 0x80)
            {
                $utf8[] = $cu1;
            }
            elseif($cu1 < 0xC2)
            {
                $utf8[] = $cu1 + 0xDC00;
            }
            elseif($cu1 < 0xE0)
            {
                $cu2 = $codes[$bytes[$p++]];
               
                if(($cu2 & 0xC0) != 0x80)
                {
                    $p--;
                    $utf8[] = $cp1 + 0xDC00;
                    $hasErrors = true;
                    continue;
                }
               
                $utf8[] = ($cu1 << 6) + $cu2 - 0x3080;
            }
            elseif($cu1 < 0xF0)
            {
                $cu2 = $codes[$bytes[$p++]];
               
                if((($cu2 & 0xC0) != 0x80) || ($cu1 == 0xE0 && $cu2 < 0xA0))
                {
                    $p--;
                    $utf8[] = $cu1 + 0xDC00;
                    $hasErrors = true;
                    continue;
                }
               
                $cu3 = $codes[$bytes[$p++]];
               
                if(($cu3 & 0xC0) != 0x80)
                {
                    $p -= 2;
                    $utf8[] = $cu1 + 0xDC00;
                    $hasErrors = true;
                    continue;
                }
               
                $utf8[] = ($cu1 << 12) + ($cu2 << 6) + $cu3 - 0xE2080;
               
            }
            elseif($cu1 < 0xF5)
            {
                $cu2 = $codes[$bytes[$p++]];
               
                if((($cu2 & 0xC0) != 0x80) || ($cu1 == 0xF0 && $cu2 < 0x90) || ($cu1 == 0xF4 && $cu2 >= 0x90))
                {
                    $p--;
                    $utf8[] = $cu1 + 0xDC00;
                    $hasErrors = true;
                    continue;
                }
               
                $cu3 = $codes[$bytes[$p++]];
               
                if(($cu3 & 0xC0) != 0x80)
                {
                    $p -= 2;
                    $utf8[] = $cu1 + 0xDC00;
                    $hasErrors = true;
                    continue;
                }
               
                $cu4 = $codes[$bytes[$p++]];
               
                if(($cu4 & 0xC0) != 0x80)
                {
                    $p -= 3;
                    $utf8[] = $cu1 + 0xDC00;
                    $hasErrors = true;
                    continue;
                }
               
                $utf8[] = ($cu1 << 18) + ($cu2 << 12) + ($cu3 << 6) + $cu4 - 0x3C82080;
               
            }
            else
            {
                $utf8[] = $cu1 + 0xDC00;
                $hasErrors = true;
            }
           
        }while($p < $l);
       
        $this->codepoints = &$utf8;
        $this->length = count($utf8);
        if(!$hasErrors){
            $this->str = $bytes;
        }
       
    }
   
    public function length()
    {       
        return $this->length;
    }
   
    public function offsetExists($index)
    {
        return isset($this->codepoints[$index]);
    }
   
    public function offsetGet($index)
    {
        $chars = &$this->chars;
       
        if(!isset($chars[$index]))
        {
            $cp = $this->codepoints[$index];
           
            if($cp < 0x80)
            {
                $chars[$index] = chr($cp);
            }
            elseif($cp <= 0x7FF)
            {
                $chars[$index] = chr(($cp >> 6) + 0xC0) . chr(($cp & 0x3F) + 0x80);
            }
            elseif($cp <= 0xFFFF)
            {
                $chars[$index] = chr(($cp >> 12) + 0xE0) . chr((($cp >> 6) & 0x3F) + 0x80) . chr(($cp & 0x3F) + 0x80);
            }
            elseif($cp <= 0x10FFFF)
            {
                $chars[$index] = chr(($cp >> 18) + 0xF0) . chr((($cp >> 12) & 0x3F) + 0x80)
                                     . chr((($cp >> 6) & 0x3F) + 0x80) . chr(($cp & 0x3F) + 0x80);
            }
            else
            {
                throw new Exception("Invalid UTF-8");
            }
           
        }
       
        return $chars[$index];
    }
   
    public function offsetSet($index, $value)
    {
       
    }
   
    public function offsetUnset($index)
    {
       
    }
    
    public function __invoke($index)
    {
        return $this->codepoints[$index];
    }
   
    public function __toString()
    {
        if($this->str === null)
        {
            $this->str = '';
           
            for($i = 0, $l = $this->length; $i < $l; $i++)
            {
                $this->str .= $this->offsetGet($i);
            }
        }
       
        return $this->str;
    }
    
    protected static function &getCodes()
    {
        if(static::$codes === null)
        {
            static::$codes = array();
            $codes = &static::$codes;
            
            for($i = 0; $i < 256; $i++){
                $codes[chr($i)] = $i;
            }
        }
        
        return static::$codes;
    }
   
}
