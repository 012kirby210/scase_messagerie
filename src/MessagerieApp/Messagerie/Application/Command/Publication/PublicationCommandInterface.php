<?php


namespace MessagerieApp\Messagerie\Application\Command\Publication;


interface PublicationCommandInterface
{
	public function getParticipantId():string;
	public function getConversationId():string;
	public function getMessageContent():string;
}