<?php


namespace MessagerieApp\Messagerie\Domain\Conversation;

/**
 * DDD Repository pattern
 *
 * Interface MessageRepository
 * @package MessagerieApp\Messagerie\Domain\Conversation
 */

interface MessageRepository
{
	/**
	 * @param ConversationId $conversationId
	 * @return Message[]
	 */
	public function retrouveLesMessagesDuneConversation(ConversationId $conversationId):array;
}