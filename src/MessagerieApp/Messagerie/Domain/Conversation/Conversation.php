<?php


namespace MessagerieApp\Messagerie\Domain\Conversation;

/**
 * Class représentant une conversation.
 *
 * On utilise un constructeur nommé pour l'instanciation.
 *
 * Class Conversation
 * @package Messagerie\Messagerie\Domain\Conversation
 */
class Conversation
{
	private function __construct(
		ConversationId $conversationId,
		Proprietaire $proprietaire,
		\DateTimeImmutable $dateDeCreation,
		array $messages = [],
		array $participants = []
	)
	{
		$this->conversationId = $conversationId;
		$this->proprietaire = $proprietaire;
		$this->dateDeCreation = $dateDeCreation;
		$this->messages = $messages;
		$this->participants = $participants;
	}

	public static function create(
		ConversationId $conversationId,
		Proprietaire $proprietaire,
		\DateTimeImmutable $dateDeCreation = null,
		array $messages,
		array $participants
	) :self
	{
		// s'il y a des règles inhérentes à l'aggrégation, les définir ici
		// et générer des exceptions spécifiques pour traitements particuliers.

		return new self($conversationId,$proprietaire,
			$dateDeCreation?? new \DateTimeImmutable(),$messages,$participants);
	}

	public function getParticipants():array
	{
		return $this->participants;
	}

	public function getProprietaire():Proprietaire
	{
		return $this->proprietaire;
	}

	public function getId(): string
	{
		return $this->conversationId->toString();
	}


}