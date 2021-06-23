<?php

namespace App\Entity;

use App\Repository\BlogRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BlogRepository::class)
 */
class Blog
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $title;

	/**
	* @var string
	* @ORM\Column(type="text", length=65535)
*/
	private $description;

	/**
	 * @ORM\Column(type="date")
	 */
	private $datecreated;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $summary;

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getTitle(): ?string
	{
		return $this->title;
	}

	public function setTitle(string $title): self
	{
		$this->title = $title;

		return $this;
	}

	public function getDescription(): ?string
	{
		return $this->description;
	}

	public function setDescription(string $description): self
	{
		$this->description = $description;

		return $this;
	}

	public function getDatecreated(): ?\DateTimeInterface
	{
		return $this->datecreated;
	}

	public function setDatecreated(\DateTimeInterface $datecreated): self
	{
		$this->datecreated = $datecreated;

		return $this;
	}

	public function getSummary(): ?string
	{
		return $this->summary;
	}

	public function setSummary(string $summary): self
	{
		$this->summary = $summary;

		return $this;
	}
}
