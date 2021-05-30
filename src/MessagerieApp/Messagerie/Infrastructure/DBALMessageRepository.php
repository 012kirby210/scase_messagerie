<?php


namespace MessagerieApp\Messagerie\Infrastructure;


use MessagerieApp\Messagerie\Domain\Conversation\ConversationId;
use MessagerieApp\Messagerie\Domain\Conversation\Message;
use MessagerieApp\Messagerie\Domain\Conversation\MessageId;
use MessagerieApp\Messagerie\Domain\Conversation\MessageRepository;

class DBALMessageRepository extends AbstractRepository implements MessageRepository
{

	/**
	 * @param ConversationId $conversationId
	 * @return Message[]
	 */
	public function retrouveLesMessagesDuneConversation(ConversationId $conversationId): array
	{
		$DBQUERY = "SELECT * FROM message WHERE conversation_id = ?";
		$rowMessageArray = [];
		try {
			$statement = $this->connection->executeQuery($DBQUERY,[$conversationId->toString()]);
			$rowMessageArray = $statement->fetchAllAssociative();
		}catch(\Doctrine\DBAL\Driver\Exception $e){
			// !TODO utiliser le monitoring pour ré-envoyer une commande de coupure de service.
			error_log("Doctrine : no driver. " . $e->getMessage());
		}catch(\Doctrine\DBAL\Exception $e){
			// !TODO utiliser le monitoring pour ré-envoyer une commande de coupure de service.
			error_log("Doctrine : global DBAL exception : " . $e->getMessage());
		}

		$messages = [];
		foreach ($rowMessageArray as $rowMessageRaw){
			$messages[] = Message::create(MessageId::fromString($rowMessageRaw['id']),
				$rowMessageRaw['profile_id'],
				$rowMessageRaw['username'],
				$rowMessageRaw['contenu'],
				$rowMessageRaw['date_creation']);
		}
		return $messages;
	}


}