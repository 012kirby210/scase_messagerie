<?php


namespace MessagerieApp\Messagerie\Domain\Conversation;

use Ramsey\Uuid\Uuid;

/**
 * Générateur d'identifiant unique de message
 * Class MessageId
 * @package MessagerieApp\Messagerie\Domain\Conversation
 */
class MessageId
{
	/** @var string Identifiant unique universel */
	private $id;

	private function __construct(string $id)
	{
		$this->id;
	}

	/**
	 * Use RFC4122 version 4
	 * @return static
	 */
	public static function generate(): self
	{
		return new self(Uuid::uuid4()->toString());
	}

	public static function fromString(string $id):self
	{
		if (false === Uuid::isValid($id)){
			// @see ConversationId
			throw new \DomainException(
				sprintf("Identifiant de message '%s' invalide.",$id)
			);
		}
		return new self($id);
	}

	public function toString(): string
	{
		return $this->id;
	}
}