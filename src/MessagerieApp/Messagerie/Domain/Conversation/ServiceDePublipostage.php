<?php


namespace MessagerieApp\Messagerie\Domain\Conversation;

use MessagerieApp\Messagerie\Domain\Conversation\Exception\ParticipantInconnuALaConversation;

/**
 * Service de publipostage pour ajouter un message à une conversation.
 * Class serviceDePublipostage
 * @package MessagerieApp\Messagerie\Domain\Conversation
 */
class ServiceDePublipostage
{
	/**
	 * @var ConversationRepository $conversationRepository
	 */
	private $conversationRepository;

	public function __construct(ConversationRepository $conversationRepository)
	{
		$this->conversationRepository = $conversationRepository;
	}

	/**
	 * Un participant envoie un message dans une conversation auquel il participe.
	 * @param Participant participant
	 * @param Conversation $conversation
	 * @param string $contenuMessage
	 */
	public function envoieUnMessage(Participant $participant, Conversation $conversation, string $contenuMessage)
	{
		$this->verifieQueLUtilisateurParticipeALaConversation($participant,$conversation);

		$this->conversationRepository->trouveConversation($conversation)->ajouteMessage($participant,
			Message::create(MessageId::generate(),
			$participant->getUserid(),
			$participant->getUsername(),
			$contenuMessage));
	}

	private function verifieQueLUtilisateurParticipeALaConversation(Participant $participant,Conversation $conversation)
	{
		if (!in_array($participant,$conversation->getParticipants())){
			throw new ParticipantInconnuALaConversation();
		}
	}

}