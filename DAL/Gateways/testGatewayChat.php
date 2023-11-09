<?php
use PHPUnit\Framework\TestCase;
require 'ChatGateway.php';

class ChatGatewayTest extends TestCase
{
    private $gateway;
    private $con;

    protected function setUp(): void
    {
        $this->con = $this->createMock(Connection::class);
        $this->gateway = new ChatGateway($this->con);
    }

    public function testInsertMessage()
    {
        // Assuming the executeQuery method returns true when successful
        $this->con
             ->method('executeQuery')
             ->willReturn(true);

        $result = $this->gateway->insertMessage('User', 'Hello World');
        $this->assertTrue($result);
    }

    public function testGetLastNMessages()
    {
        // Assuming the getResults method returns an array of messages
        $this->con
             ->method('executeQuery')
             ->willReturn(true);
        $this->con
             ->method('getResults')
             ->willReturn([['pseudo' => 'User', 'content' => 'Hello World']]);

        $result = $this->gateway->getLastNMessages(10);
        $this->assertIsArray($result);
        $this->assertCount(1, $result);
    }

    public function testGetMessagesByUser()
    {
        // Assuming the getResults method returns an array of messages for a given user
        $this->con
             ->method('executeQuery')
             ->willReturn(true);
        $this->con
             ->method('getResults')
             ->willReturn([['pseudo' => 'User', 'content' => 'Hello World']]);

        $result = $this->gateway->getMessagesByUser('User');
        $this->assertIsArray($result);
        $this->assertCount(1, $result);
    }

    public function testReplyTo()
    {
        // Assuming the executeQuery method returns true when successful
        $this->con
             ->method('executeQuery')
             ->willReturn(true);

        $result = $this->gateway->replyTo('UserFrom', 'UserTo', 'Reply Content');
        $this->assertTrue($result);
    }

    public function testFindAllMessageForAnArticle()
    {
        // Assuming the executeQuery method returns true and getResults returns an array of messages
        $this->con
             ->method('executeQuery')
             ->willReturn(true);
        $this->con
             ->method('getResults')
             ->willReturn([['pseudoRedac' => 'Editor', 'message' => 'Article Message']]);

        $result = $this->gateway->findAllMessageForAnArticle(1);
        $this->assertIsArray($result);
        $this->assertCount(1, $result);
    }
}
