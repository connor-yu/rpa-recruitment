<?php
use PHPUnit\Framework\TestCase;
use MyGreeter\Client;

class MyGreeter_Client_Test extends TestCase
{
    public function test_Instance()
    {
        $greeter = new Client();
        $this->assertEquals(
            get_class($greeter),
            'MyGreeter\Client'
        );
    }

    public function test_getGreeting()
    {
        $greeter = new Client();
        $this->assertTrue(
            strlen($greeter->getGreeting()) > 0
        );
    }

    public function test_greetMorning()
    {
        $greeter = new Client('00:00:00');
        $this->assertEquals(
            'Good morning', $greeter->getGreeting()
        );
    }

    public function test_greetAfternoon()
    {
        $greeter = new Client('12:00:01');
        $this->assertEquals(
            'Good afternoon', $greeter->getGreeting()
        );
    }

    public function test_greetEvening()
    {
        $greeter = new Client('18:00:01');
        $this->assertEquals(
            'Good evening', $greeter->getGreeting()
        );
    }

    public function test_error()
    {
        $greeter = new Client('24:00:00');
        $this->assertArrayHasKey(
            'construct', $greeter->getGreeting()
        );
    }
}
