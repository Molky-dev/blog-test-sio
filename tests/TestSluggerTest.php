<?php

namespace App\Tests;

use App\services\BlogSlugger;
use PHPUnit\Framework\TestCase;

class TestSluggerTest extends TestCase
{
    public function testEmptyStringReturnsNA()
    {
        $result = BlogSlugger::slugify('');
        $this->assertEquals('n-a', $result);
    }

    public function testNullInputReturnsNA()
    {
        $result = BlogSlugger::slugify(null);
        $this->assertEquals('n-a', $result);
    }

    public function testSlugifyWithSpecialCharacters()
    {
        $input = 'Hello World! This is a Test';
        $result = BlogSlugger::slugify($input);
        $this->assertEquals('hello-world-this-is-a-test', $result);
    }

    public function testSlugifyWithAccents()
    {
        $input = 'Café au Lait';
        $result = BlogSlugger::slugify($input);
        $this->assertEquals('cafe-au-lait', $result);
    }

    public function testSlugifyWithMultipleSpaces()
    {
        $input = '   Multiple    Spaces   ';
        $result = BlogSlugger::slugify($input);
        $this->assertEquals('multiple-spaces', $result);
    }

    public function testSlugifyWithSpecialCharactersAndSpaces()
    {
        $input = 'Hello World! This is a Test with $pecial Characters';
        $result = BlogSlugger::slugify($input);
        $this->assertEquals('hello-world-this-is-a-test-with-pecial-characters', $result);
    }

    public function testSlugifyWithEmptyStringInside()
    {
        $input = 'Hello   World! This is a Test   with Empty  String   Inside';
        $result = BlogSlugger::slugify($input);
        $this->assertEquals('hello-world-this-is-a-test-with-empty-string-inside', $result);
    }

    public function testSlugifyWithCustomFontAndSpaces()
    {
        $input = 'ℌ𝔢𝔩𝔩𝔬 𝔴𝔬𝔯𝔩𝔡, 𝔱𝔥𝔦𝔰 𝔦𝔰 𝔞 𝔱𝔢𝔰𝔱 𝔴𝔦𝔱𝔥 𝔠𝔲𝔰𝔱𝔬𝔪 𝔣𝔬𝔫𝔱';
        $result = BlogSlugger::slugify($input);
        $this->assertEquals('hello-world-this-is-a-test-with-custom-font', $result);
    }






}
