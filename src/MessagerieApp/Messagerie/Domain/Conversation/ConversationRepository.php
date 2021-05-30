<?php


namespace MessagerieApp\Messagerie\Domain\Conversation;


interface ConversationRepository
{
	public function retrouveConversation(ConversationId $conversationId): ?Conversation;
	public function enregistre(ConversationId $conversationId): void;
	public function listeDesConversationsDuParticipant(string $participantId): array;
}