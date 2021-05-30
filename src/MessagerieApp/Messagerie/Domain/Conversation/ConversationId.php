<?php


namespace MessagerieApp\Messagerie\Domain\Conversation;

use Ramsey\Uuid\Uuid;

/**
 * Class de génération d'identifiants de conversation uniques
 * Class ConversationId
 *
 * !TODO vérifier besoin métier-domaine
 *
 * @package Messagerie\Messagerie\Domain\Conversation
 */
class ConversationId
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
			// PHP : https://www.php.net/manual/fr/class.domainexception.php

			//  sprintf <=> /sprintf
			// PHP : https://www.php.net/language.namespaces.rules
			// https://youtrack.jetbrains.com/issue/WI-21705
			// https://www.php.net/releases/8.0/fr.php !TODO JIT
			throw new \DomainException(
				sprintf("Identifiant de conversation '%s' invalide.",$id)
			);
		}
		return new self($id);
	}

	public function toString(): string
	{
		return $this->id;
	}
}