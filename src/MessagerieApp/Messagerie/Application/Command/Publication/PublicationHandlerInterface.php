<?php


namespace MessagerieApp\Messagerie\Application\Command\Publication;


interface PublicationHandlerInterface
{
	public function __invoke(PublicationCommandInterface $command);
}