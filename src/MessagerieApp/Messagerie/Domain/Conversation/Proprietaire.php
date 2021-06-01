<?php

namespace MessagerieApp\Messagerie\Domain\Conversation;


class Proprietaire
{
	protected $username;
	protected $id;

	private function __construct(string $username,
															 string $id)
	{
		$this->username = $username;
		$this->id = $id;
	}

	/**
	 * @param string $username
	 * @param string $id
	 * @return Proprietaire
	 */
	public static function create(string $username,
																string $id)
	{
		return new self($username,$id);
	}

	public function getUsername():string
	{
		return $this->username;
	}

	public function getUserid():string
	{
		return $this->id;
	}
}