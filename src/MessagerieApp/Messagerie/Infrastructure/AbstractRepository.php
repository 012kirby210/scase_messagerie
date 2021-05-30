<?php


namespace MessagerieApp\Messagerie\Infrastructure;

use Doctrine\DBAL\Connection;

class AbstractRepository
{

	protected $connection;

	protected const DATE_FORMAT = 'Y-m-d H:m:i';

	public function __construct(Connection $connection)
	{
		$this->connection = $connection;
	}

}