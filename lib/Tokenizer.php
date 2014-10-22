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

class Tokenizer
{
    const DATA_STATE = 1;
    const CHARACTER_REFERENCE_IN_DATA_STATE = 2;
    const RCDATA_STATE = 3;
    const CHARACTER_REFERENCE_IN_RCDATA_STATE = 4;
    const RAWTEXT_STATE = 5;
    const SCRIPT_DATA_STATE = 6;
    const PLAINTEXT_STATE = 7;
    const TAG_OPEN_STATE = 8;
    const END_TAG_OPEN_STATE = 9;
    const TAG_NAME_STATE = 10;
    const RCDATA_LESS_THEN_SIGN_STATE = 11;
    const RCDATA_END_TAG_OPEN_STATE = 12;
    const RCDATA_END_TAG_NAME_STATE = 13;
    const RAWTEXT_LESS_THAN_SIGN_STATE = 14;
    const RAWTEXT_END_TAG_OPEN_STATE = 15;
    const RAWTEXT_END_TAG_NAME_STATE = 16;
    const SCRIPT_DATA_LESS_THAN_SIGN_STATE = 17;
    const SCRIPT_DATA_END_TAG_OPEN_STATE = 18;
    const SCRIPT_DATA_END_TAG_NAME_STATE = 19;
    const SCRIPT_DATA_ESCAPE_START_STATE = 20;
    const SCRIPT_DATA_ESCAPE_START_DASH_STATE = 21;
    const SCRIPT_DATA_ESCAPED_STATE = 22;
    const SCRIPT_DATA_ESCAPED_DASH_STATE = 23;
    const SCRIPT_DATA_ESCAPED_DASH_DASH_STATE = 24;
    const SCRIPT_DATA_ESCAPED_LESS_THAN_SIGN_STATE = 25;
    const SCRIPT_DATA_ESCAPED_END_TAG_OPEN_STATE = 26;
    const SCRIPT_DATA_ESCAPED_END_TAG_NAME_STATE = 27;
    const SCRIPT_DATA_DOUBLE_ESCAPE_START_STATE = 28;
    const SCRIPT_DATA_DOUBLE_ESCAPED_STATE = 29;
    const SCRIPT_DATA_DOUBLE_ESCAPED_DASH_STATE = 30;
    const SCRIPT_DATA_DOUBLE_ESCAPED_DASH_DASH_STATE = 31;
    const SCRIPT_DATA_DOUBLE_ESCAPED_LESS_THAN_SIGN_STATE = 32;
    const SCRIPT_DATA_DOUBLE_ESCAPE_END_STATE = 33;
    const BEFORE_ATTRIBUTE_NAME_STATE = 34;
    const ATTRIBUTE_NAME_STATE = 35;
    const AFTER_ATTRIBUTE_NAME_STATE = 36;
    const BEFORE_ATTRIBUTE_VALUE_STATE = 37;
    const ATTRIBUTE_VALUE_DOUBLE_QUOTED_STATE = 38;
    const ATTRIBUTE_VALUE_SINGLE_QUOTED_STATE = 39;
    const ATTRIBUTE_VALUE_UNQUOTED_STATE = 40;
    const CHARACTER_REFERENCE_IN_ATTRIBUTE_VALUE_STATE = 41;
    const AFTER_ATTRIBUTE_VALUE_QUOTED_STATE = 42;
    const SELF_CLOSING_START_TAG_STATE = 43;
    const BOGUS_COMMENT_STATE = 44;
    const MARKUP_DECLARATION_OPEN_STATE = 45;
    const COMMENT_START_STATE = 46;
    const COMMENT_START_DASH_STATE = 47;
    const COMMENT_STATE = 48;
    const COMMENT_END_DASH_STATE = 49;
    const COMMENT_END_STATE = 50;
    const COMMENT_END_BANG_STATE = 51;
    const DOCTYPE_STATE = 52;
    const BEFORE_DOCTYPE_NAME_STATE = 53;
    const DOCTYPE_NAME_STATE = 54;
    const AFTER_DOCTYPE_NAME_STATE = 55;
    const AFTER_DOCTYPE_PUBLIC_KEYWORD_STATE = 56;
    const BEFORE_DOCTYPE_PUBLIC_IDENTIFIER_STATE = 57;
    const DOCTYPE_PUBLIC_IDENTIFIER_DOUBLE_QUOTED_STATE = 58;
    const DOCTYPE_PUBLIC_IDENTIFIER_SINGLE_QUOTED_STATE = 59;
    const AFTER_DOCTYPE_PUBLIC_IDENTIFIER_STATE = 60;
    const BETWEEN_DOCTYPE_PUBLIC_AND_SYSTEM_IDENTIFIERS_STATE = 61;
    const AFTER_DOCTYPE_SYSTEM_KEYWORD_STATE = 62;
    const BEFORE_DOCTYPE_SYSTEM_IDENTIFIER_STATE = 63;
    const DOCTYPE_SYSTEM_IDENTIFIER_DOUBLE_QUOTED_STATE = 64;
    const DOCTYPE_SYSTEM_IDENTIFIER_SINGLE_QUOTED_STATE = 65;
    const AFTER_DOCTYPE_SYSTEM_IDENTIFIER_STATE = 66;
    const BOGUS_DOCTYPE_STATE = 67;
    const CDATA_SECTION_STATE = 68;
    
    protected $tempBuffer;
    protected $dataBuffer;
    
}

