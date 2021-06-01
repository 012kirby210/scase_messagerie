<?php


namespace MessagerieApp\Messagerie\Domain\Conversation;

/**
 * Les participants aux conversations.
 * Override des méthodes du propriétaire : permet de renvoyer un objet du même type
 * et pas du type hérité.
 * Class Partipant
 * @package MessagerieApp\Messagerie\Domain\Conversation
 */
class Participant extends Proprietaire
{

	private function __construct(string $username,
															 string $id)
	{
		$this->username = $username;
		$this->id = $id;
	}

	/**
	 * @param string $username
	 * @param string $id
	 * @return Participant
	 */
	public static function create(string $username,
																string $id)
	{
		return new self($username,$id);
	}

}