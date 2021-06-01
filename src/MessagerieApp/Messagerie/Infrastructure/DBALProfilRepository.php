<?php


namespace MessagerieApp\Messagerie\Infrastructure;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Driver\Exception;
use MessagerieApp\Messagerie\Domain\Conversation\ConversationId;
use MessagerieApp\Messagerie\Domain\Conversation\Participant;
use MessagerieApp\Messagerie\Domain\Conversation\ProfilRepository;

class DBALProfilRepository extends AbstractRepository implements ProfilRepository
{
	/**
	 *
	 * @param ConversationId $conversationId
	 * @return Participant[]
	 */
	public function retrouveLesParticipantsDuneConversation(ConversationId $conversationId): array
	{
		$DBQUERY = "SELECT p.id, p.username FROM profile as p ".
			"INNER JOIN message as m ".
			"ON m.profil_id = p.id ".
			"WHERE m.conversation_id = ? ".
			"GROUP BY p.id";

		$rowParticipantsArray = [];
		$participants = [];

		try {
			$statement = $this->connection->executeQuery($DBQUERY,[$conversationId->toString()]);
			$rowParticipantsArray = $statement->fetchAllAssociative();
		}catch(\Doctrine\DBAL\Driver\Exception $e){
			// @see MessageRepository
			error_log("Doctrine driving exception : " . $e->getMessage());
		}catch(\Doctrine\DBAL\Exception $e){
			error_log("Doctrine global exception : " . $e->getMessage());
		}
		foreach ($rowParticipantsArray as $rowParticipantRaw){
			$participants[] = Participant::create(
				$rowParticipantRaw['username'],
				$rowParticipantRaw['id']);
		}

		return $participants;
	}

	/**
	 * Trouve un profil participant à une conversation en fonction de son identifiant.
	 * @param string $participantId
	 * @return Participant|null
	 */
	public function trouveParticipant(string $participantId): ?Participant
	{
		$DBQUERY = "SELECT * from profil WHERE id=:participantId LIMIT 1";

		$participant = null;

		try {
			$statement = $this->connection->executeQuery($DBQUERY);
			$rawParticipant = $statement->fetchAssociative();
			if (!empty($rawParticipant)){
				$participant = Participant::create($rawParticipant['username'],$rawParticipant['id']);
			}
		}catch(\Doctrine\DBAL\Driver\Exception $e){
			error_log("Doctrine driving exception : " . $e->getMessage());
		}catch(\Doctrine\DBAL\Exception $e){
			error_log("Doctrine global exception : " . $e->getMessage());
		}
		return $participant;
	}

}