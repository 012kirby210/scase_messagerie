<?php


namespace MessagerieApp\Messagerie\Application\Command\Publication;

use MessagerieApp\Messagerie\Domain\Conversation\Message;
use MessagerieApp\Messagerie\Domain\Conversation\ProfilRepository;
use MessagerieApp\Messagerie\Domain\Conversation\ServiceDePublipostage;

/**
 * Gestionnaire des messages de publication
 * Class PublicationHandler
 * @package MessagerieApp\Messagerie\Application
 */
class PublicationHandler implements PublicationHandlerInterface
{
	/**  @var ServiceDePublipostage serviceDePublipostage */

	private $serviceDePublipostage;

	/** @var  ProfilRepository */
	private $profilRepository;

	public function __construct(ServiceDePublipostage $serviceDePublipostage,
															ProfilRepository $profilRepository)
	{
		$this->serviceDePublipostage = $serviceDePublipostage;
		$this->profilRepository = $profilRepository;
	}

	public function __invoke(PublicationCommandInterface $publicationCommand)
	{
		$participant = $this->profilRepository->trouveParticipant(
			$publicationCommand->getParticipantId());

		// !TODO Déterminer comment l'aggrégat se mettre à jour
		$participant && $this->serviceDePublipostage->envoieUnMessage();
	}
}