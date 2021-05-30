<?php


namespace App\Tests\MessagerieApp\Messagerie\Domain\Conversation;

use MessagerieApp\Messagerie\Domain\conversation\Conversation;
use MessagerieApp\Messagerie\Domain\conversation\ConversationId;
use MessagerieApp\Messagerie\Domain\Conversation\Proprietaire;
use MessagerieApp\Messagerie\Domain\Conversation\Partipant;
use MessagerieApp\Messagerie\Domain\Conversation\serviceDePublipostage;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class serviceDePublipostageTest extends KernelTestCase
{

	public function test_unMessagePeutEtreAjouteDansUneConversation():void
	{
		$conversation = Conversation::create(ConversationId::generate(),
			Proprietaire::create('proprietaire','idProprietaire'),
			new \DateTimeImmutable());
		$participant = Partipant::create('utilisateur1','identifiant');
		$conversation->ajouteParticipant($participant);

		$conversationRepository = new ConversationRepositoryMemoire();
		$conversationRepository->enregistre($conversation);

		$service = new serviceDePublipostage($conversationRepository);
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