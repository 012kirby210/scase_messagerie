<?php


namespace App\Tests\MessagerieApp\Messagerie\Domain\Conversation;

use MessagerieApp\Messagerie\Domain\conversation\Conversation;
use MessagerieApp\Messagerie\Domain\conversation\ConversationId;
use MessagerieApp\Messagerie\Domain\Conversation\Proprietaire;
use MessagerieApp\Messagerie\Domain\Conversation\Participant;
use MessagerieApp\Messagerie\Domain\Conversation\ServiceDePublipostage;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class serviceDePublipostageTest extends KernelTestCase
{

	public function test_unMessagePeutEtreAjouteDansUneConversation():void
	{
		$conversation = Conversation::create(ConversationId::generate(),
			Proprietaire::create('proprietaire','idProprietaire'),
			new \DateTimeImmutable());
		$participant = Participant::create('utilisateur1','identifiant');
		$conversation->ajouteParticipant($participant);

		$conversationRepository = new ConversationRepositoryMemoire();
		$conversationRepository->enregistre($conversation);

		$service = new ServiceDePublipostage($conversationRepository);
		$contenuDuMessage = "je suis un message";

		$service->envoieUnMessage($participant,$conversation,$contenuDuMessage);
		$messages = $conversationRepository->retrouveConversation($conversation)->listeMessages();

		// !TODO ça ne me plaît pas : le message devrait pouvoir se tester lui-même
		// !TODO le responsable du créateur du message devrait tester la cohérence du message

		$contenuDesMessages = [];
		foreach ($messages as $message){
			$contenuDesMessages[] = $message->getContenu();
		}
		$this->assertTrue(in_array($contenuDuMessage,$contenuDesMessages));
	}

}