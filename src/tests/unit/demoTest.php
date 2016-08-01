<?php

class demoTest extends \PHPUnit_Framework_TestCase
{
	private $CI;
    protected function setUp()
    {
		$CI =& get_instance();
		$CI->load->helper('email');
    }

    protected function tearDown()
    {
    }

    // tests
    public function testMe()
    {
		$this->assertTrue(valid_email('test@test.com'));
		$this->assertFalse(valid_email('test#test.com'));
    }
}
