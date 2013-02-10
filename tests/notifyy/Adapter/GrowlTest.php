<?php

/**
 * Test class for Growl.
 * Generated by PHPUnit on 2011-10-22 at 23:00:50.
 */
namespace notifyy\Adapter;

class GrowlTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Growl
     */
    protected $_object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    public function setUp() {
        $this->_object = new Growl();
    }

    /**
     * Test simple notify
     */
    public function testNotify() {
        $sText = md5(time());
        $this->assertInstanceOf('\notifyy\AbstractAdapter', $this->_object->notify(
            \notifyy\Notifyable::SUCCESS,
            $sText
        ));
    }

    /**
     * Test text formatting
     */
    public function testformatMessage() {
        $this->assertEquals(\notifyy\Notifyable::SUCCESS, $this->_object->formatMessage(\notifyy\Notifyable::SUCCESS));

        $sTest = implode(array_fill(0, 1024, 'A'));
        $this->assertEquals(256, strlen($this->_object->formatMessage($sTest)));

        //$sTest = 'Test \033[32mdone\033[0m Test \033[32;12mdone\033[0m';
        //$this->assertEquals('Test done Test done', $this->_object->formatMessage($sTest));
    }
}
