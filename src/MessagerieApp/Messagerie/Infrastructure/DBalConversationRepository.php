<?php


namespace MessagerieApp\Messagerie\Infrastructure;

use Doctrine\DBAL\Connection;

use MessagerieApp\Messagerie\Domain\Conversation\Conversation;
use MessagerieApp\Messagerie\Domain\Conversation\ConversationId;
use MessagerieApp\Messagerie\Domain\Conversation\ConversationRepository;
use MessagerieApp\Messagerie\Domain\Conversation\Participant;
use MessagerieApp\Messagerie\Domain\Conversation\MessageId;
use MessagerieApp\Messagerie\Domain\Conversation\Message;
use MessagerieApp\Messagerie\Domain\Conversation\Proprietaire;

class DBalConversationRepository extends AbstractRepository implements ConversationRepository
{
	/**
	 * @param ConversationId $conversation
	 * @return Conversation|null
	 * @throws \Doctrine\DBAL\Exception
	 */
	public function retrouveConversation(ConversationId $conversationId): ?Conversation
	{
		$DBQUERY = "SELECT c.date_de_creation as conversation_date_de_creation,".
			"c.nom as conversation_nom,".
			"c.proprietaire_id as conversation_proprietaire_id,".
			"c.proprietaire_nom as conversation_proprietaire_nom,".
			"m.id as message_id,".
			"m.contenu as message_contenu,".
			"m.date_de_creation as message_date_de_creation,".
			"p.username as profile_nom,".
			"p.picture as profile_image ".
			"p.id as profile_id ".
			"FROM conversation as c INNER JOIN message as m ".
			"ON c.id = m.conversation_id INNER JOIN profile as p ".
			"ON m.profile_id = p.id ".
			"WHERE c.id = ?";

		$returnedConversation = null;

		try {
			$statement = $this->connection->executeQuery($DBQUERY,[$conversationId->toString()]);
			$rowResults = $statement->fetchAllAssociative();

			$participants = [];
			$messages = [];

			foreach ($rowResults as $result){
				$participants[] = Participant::create(
					$result['profile_nom'],
					$result['profile_id']
				);
				$messages[] = Message::create(
					MessageId::fromString($result['message_id']),
					$result['profile_id'],
					$result['profile_nom'],
					$result['message_contenu'],
					$result['message_date_de_creation']
				);
			}

			// !TODO Benchmarker un LEFT JOIN pour éviter la double requête (messages vides)

			$DBQUERY_EMPTY_MESSAGES_CASE =
				"SELECT proprietaire_id,proprietaire_nom,date_de_creation FROM conversation WHERE id = ?";

			$statement_empty_messages_case = $this->connection->executeQuery($DBQUERY_EMPTY_MESSAGES_CASE,
					[$conversationId->toString()]);
			$row_conversation_empty_messages_case = $statement_empty_messages_case->fetchAssociative();
			$proprietaire = Proprietaire::create($row_conversation_empty_messages_case['proprietaire_nom'],
				$row_conversation_empty_messages_case['proprietaire_id']);
			$conversationDateCreation = $row_conversation_empty_messages_case['date_de_creation'];

			$returnedConversation = Conversation::create(
				$conversationId,
				$proprietaire,
				$conversationDateCreation,
				$messages,
				$participants
			);

		}catch(\Doctrine\DBAL\Driver\Exception $e){
			// @see MessageRepository
			error_log("Doctrine driver exception : " . $e->getMessage());
		}catch(\Doctrine\DBAL\Exception $e){
			error_log("Doctrine global exception : " . $e->getMessage());
		}

		return $returnedConversation;
	}

	public function enregistre($conversation): void
	{
		// TODO: Implement enregistre() method.
	}

	public function listeDesConversationsDuParticipant($participant): array
	{
		// TODO: Implement listeDesConversationsDuParticipant() method.
	}


}