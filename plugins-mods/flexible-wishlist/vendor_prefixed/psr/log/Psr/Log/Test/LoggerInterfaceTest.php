<?php

namespace FlexibleWishlistVendor\Psr\Log\Test;

use FlexibleWishlistVendor\Psr\Log\LoggerInterface;
use FlexibleWishlistVendor\Psr\Log\LogLevel;
use FlexibleWishlistVendor\PHPUnit\Framework\TestCase;
/**
 * Provides a base test class for ensuring compliance with the LoggerInterface.
 *
 * Implementors can extend the class and implement abstract methods to run this
 * as part of their test suite.
 */
abstract class LoggerInterfaceTest extends \FlexibleWishlistVendor\PHPUnit\Framework\TestCase
{
    /**
     * @return LoggerInterface
     */
    public abstract function getLogger();
    /**
     * This must return the log messages in order.
     *
     * The simple formatting of the messages is: "<LOG LEVEL> <MESSAGE>".
     *
     * Example ->error('Foo') would yield "error Foo".
     *
     * @return string[]
     */
    public abstract function getLogs();
    public function testImplements()
    {
        $this->assertInstanceOf('FlexibleWishlistVendor\\Psr\\Log\\LoggerInterface', $this->getLogger());
    }
    /**
     * @dataProvider provideLevelsAndMessages
     */
    public function testLogsAtAllLevels($level, $message)
    {
        $logger = $this->getLogger();
        $logger->{$level}($message, array('user' => 'Bob'));
        $logger->log($level, $message, array('user' => 'Bob'));
        $expected = array($level . ' message of level ' . $level . ' with context: Bob', $level . ' message of level ' . $level . ' with context: Bob');
        $this->assertEquals($expected, $this->getLogs());
    }
    public function provideLevelsAndMessages()
    {
        return array(\FlexibleWishlistVendor\Psr\Log\LogLevel::EMERGENCY => array(\FlexibleWishlistVendor\Psr\Log\LogLevel::EMERGENCY, 'message of level emergency with context: {user}'), \FlexibleWishlistVendor\Psr\Log\LogLevel::ALERT => array(\FlexibleWishlistVendor\Psr\Log\LogLevel::ALERT, 'message of level alert with context: {user}'), \FlexibleWishlistVendor\Psr\Log\LogLevel::CRITICAL => array(\FlexibleWishlistVendor\Psr\Log\LogLevel::CRITICAL, 'message of level critical with context: {user}'), \FlexibleWishlistVendor\Psr\Log\LogLevel::ERROR => array(\FlexibleWishlistVendor\Psr\Log\LogLevel::ERROR, 'message of level error with context: {user}'), \FlexibleWishlistVendor\Psr\Log\LogLevel::WARNING => array(\FlexibleWishlistVendor\Psr\Log\LogLevel::WARNING, 'message of level warning with context: {user}'), \FlexibleWishlistVendor\Psr\Log\LogLevel::NOTICE => array(\FlexibleWishlistVendor\Psr\Log\LogLevel::NOTICE, 'message of level notice with context: {user}'), \FlexibleWishlistVendor\Psr\Log\LogLevel::INFO => array(\FlexibleWishlistVendor\Psr\Log\LogLevel::INFO, 'message of level info with context: {user}'), \FlexibleWishlistVendor\Psr\Log\LogLevel::DEBUG => array(\FlexibleWishlistVendor\Psr\Log\LogLevel::DEBUG, 'message of level debug with context: {user}'));
    }
    /**
     * @expectedException \Psr\Log\InvalidArgumentException
     */
    public function testThrowsOnInvalidLevel()
    {
        $logger = $this->getLogger();
        $logger->log('invalid level', 'Foo');
    }
    public function testContextReplacement()
    {
        $logger = $this->getLogger();
        $logger->info('{Message {nothing} {user} {foo.bar} a}', array('user' => 'Bob', 'foo.bar' => 'Bar'));
        $expected = array('info {Message {nothing} Bob Bar a}');
        $this->assertEquals($expected, $this->getLogs());
    }
    public function testObjectCastToString()
    {
        if (\method_exists($this, 'createPartialMock')) {
            $dummy = $this->createPartialMock('FlexibleWishlistVendor\\Psr\\Log\\Test\\DummyTest', array('__toString'));
        } else {
            $dummy = $this->getMock('FlexibleWishlistVendor\\Psr\\Log\\Test\\DummyTest', array('__toString'));
        }
        $dummy->expects($this->once())->method('__toString')->will($this->returnValue('DUMMY'));
        $this->getLogger()->warning($dummy);
        $expected = array('warning DUMMY');
        $this->assertEquals($expected, $this->getLogs());
    }
    public function testContextCanContainAnything()
    {
        $closed = \fopen('php://memory', 'r');
        \fclose($closed);
        $context = array('bool' => \true, 'null' => null, 'string' => 'Foo', 'int' => 0, 'float' => 0.5, 'nested' => array('with object' => new \FlexibleWishlistVendor\Psr\Log\Test\DummyTest()), 'object' => new \DateTime(), 'resource' => \fopen('php://memory', 'r'), 'closed' => $closed);
        $this->getLogger()->warning('Crazy context data', $context);
        $expected = array('warning Crazy context data');
        $this->assertEquals($expected, $this->getLogs());
    }
    public function testContextExceptionKeyCanBeExceptionOrOtherValues()
    {
        $logger = $this->getLogger();
        $logger->warning('Random message', array('exception' => 'oops'));
        $logger->critical('Uncaught Exception!', array('exception' => new \LogicException('Fail')));
        $expected = array('warning Random message', 'critical Uncaught Exception!');
        $this->assertEquals($expected, $this->getLogs());
    }
}
