<?php


namespace MessagerieApp\Messagerie\Domain\Conversation;

/**
 * Un message publiable/publié dans une conversation
 * Class Message
 * @package MessagerieApp\Messagerie\Domain\Conversation
 */
class Message
{
	/**
	 * !TODO remplacer l'atomisation ($partipantId, $username) par un value object Participant
	 *
	 * Message constructor.
	 * @param MessageId $messageId
	 *
	 * // !TODO déterminer utilité redondance/cohésion/couplage
	 * @param string $participantId
	 * @param string $username
	 * //
	 * @param string $contenuMessage
	 * @param \DateTimeImmutable $dateCreation
	 */
	private function __construct(MessageId $messageId,
															 string $participantId,
															 string $username,
															 string $contenuMessage,
															 \DateTimeImmutable $dateCreation)
	{
		$this->messageId = $messageId;
		$this->participantId = $participantId;
		$this->username = $username;
		$this->contenuMessage = $contenuMessage;
		$this->dateCreation = $dateCreation;
	}

	public function create(MessageId $messageId,
												 string $participantId,
												 string $username,
												 string $contenuMessage) :self
	{
		// !TODO définir les règles sur les aggrégats message.

		return new self($messageId,
			$participantId,
			$username,
			$contenuMessage,
			new \DateTimeImmutable());
	}

	public function getContenuMessage():string
	{
		return $this->contenuMessage;
	}
}