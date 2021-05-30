<?php


namespace App\Tests\MessagerieApp\Messagerie\Domain\Conversation;


use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Tests de l'aggrégat de conversation.
 * Class ConversationTest
 * @package App\Tests\MessagerieApp\Messagerie\Domain\Conversation
 */
class ConversationTest extends KernelTestCase
{

	/** @test */
	public function test_uneNouvelleConversationPeutEtreCree():void
	{
		$conversationId = ConversationId::generate();
		$proprietaire = Participant::create(
			'username',
			'user-uuid'
		);
		$dateCreation = new \DateTimeImmutable();
		$conversation = Conversation::create(
			$conversationId,
			$proprietaire,
			$dateCreation
		);

		$this->assertSame($conversationId,$conversation->getId());
		$this->assertSame($proprietaire,$conversation->getProprietaire());
		$this->assertSame($dateCreation,$conversation->getDateCreation());
	}

	/** @test */
	public function test_unMessagePeutEtreAjouteParUnParticipant():void
	{

	}

	/** @test */
	public function test_duContenuPeutEtreAjouteParUnParticipant():void
	{

	}

}