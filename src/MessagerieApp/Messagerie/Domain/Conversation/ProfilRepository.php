<?php


namespace MessagerieApp\Messagerie\Domain\Conversation;

use MessagerieApp\Messagerie\Domain\Conversation\Participant;

interface ProfilRepository
{
	/**
	 * @param ConversationId $conversationId
	 * @return Participant[]
	 */
	public function retrouveLesParticipantsDuneConversation(ConversationId $conversationId):array;

	/**
	 * @param string $participantId
	 * @return \MessagerieApp\Messagerie\Domain\Conversation\Participant | null
	 */
	public function trouveParticipant(string $participantId):?Participant;
}