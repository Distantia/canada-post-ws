<?php
namespace Distantia\CanadaPostWs\Type\Messages;

class MessagesType
{
    /**
     * @var MessageType[]
     * name="message" minOccurs="0" maxOccurs="unbounded"
     */
    protected $messages = [];

    /**
     * @return MessageType[]
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @param MessageType[] $messages
     * @return MessagesType
     */
    public function setMessages($messages)
    {
        $this->messages = $messages;

        return $this;
    }

    /**
     * @param MessageType $message
     * @return MessagesType
     */
    public function addMessage($message)
    {
        $this->messages[] = $message;

        return $this;
    }
}