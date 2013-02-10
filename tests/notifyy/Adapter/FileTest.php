<?php
/**
 * Test class for File.
 * Generated by PHPUnit on 2011-10-22 at 23:00:50.
 */
namespace notifyy\Adapter;

class FileTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var File
     */
    protected $_object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    public function setUp() {
        $oConfig = new \stdClass();
        $oConfig->path = '/tmp';

        $this->_object = new File();
        $this->_object->setConfig($oConfig);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    public function tearDown() {
        unlink($this->_object->getFile());
        unset ($this->_object);
    }

    /**
     * Test simple notify call
     */
    public function testNotify() {
        $sText = md5(time());
        $this->assertInstanceOf('\notifyy\AbstractAdapter', $this->_object->notify(
            \notifyy\AbstractAdapter::SUCCESS,
            $sText
        ));

        $this->assertStringEndsWith($sText . PHP_EOL, file_get_contents($this->_object->getFile()));
    }
}
