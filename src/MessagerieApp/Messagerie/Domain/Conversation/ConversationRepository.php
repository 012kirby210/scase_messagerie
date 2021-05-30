<?php


namespace MessagerieApp\Messagerie\Domain\Conversation;


interface ConversationRepository
{
	public function retrouveConversation($conversation): ?Conversation;
	public function enregistre($conversation): void;
	public function listeDesConversationsDuParticipant($participant): array;
}