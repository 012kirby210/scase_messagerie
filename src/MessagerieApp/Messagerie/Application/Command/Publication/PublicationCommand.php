<?php


namespace MessagerieApp\Messagerie\Application\Command\Publication;


/**
 * Commande de publication de message dans le service
 * de publipostage.
 * Class PublicationCommand
 * @package MessagerieApp\Messagerie\Application
 */
class PublicationCommand implements PublicationCommandInterface
{
	private $participantId;
	private $conversationId;
	private $messageContent;

	public function __construct(string $participantId,
															string $conversationId,
															string $messageContent)
	{
		$this->participantId = $participantId;
		$this->conversationId = $conversationId;
		$this->messageContent = $messageContent;
	}

	/**
	 * @return string
	 */
	public function getParticipantId(): string
	{
		return $this->participantId;
	}

	/**
	 * @return string
	 */
	public function getConversationId(): string
	{
		return $this->conversationId;
	}

	/**
	 * @return string
	 */
	public function getMessageContent(): string
	{
		return $this->messageContent;
	}

}