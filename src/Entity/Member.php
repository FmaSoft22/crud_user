<?php

namespace App\Entity;

use App\Repository\MemberRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table(name="member")
 * @ORM\Entity(repositoryClass=MemberRepository::class)
 */
class Member
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id_countries",type="integer",nullable=false)
     */
    private $id;
    /**
     * @ORM\Column(name="guid",type="string", nullable=true)
     */
    private $guid;

    /**
     * @ORM\Column(name="title",type="string", length = 50, nullable=true)
     */
    private $title;
    /**
     * @ORM\Column(name="firstname",type="string", length = 255, nullable=true)
     */
    private $firstname;
    /**
     * @ORM\Column(name="lastname",type="string", length = 255, nullable=true)
     */
    private $lastname;
    /**
     * @ORM\Column(name="emailAddress",type="string", length = 255, nullable=true)
     */
    private $emailAddress;
    /**
     * @ORM\Column(name="country",type="string", length = 255, nullable=true)
     */
    private $country;
    /**
     * @ORM\Column(name="town",type="string", length = 50, nullable=true)
     */
    private $town;
    /**
     * @ORM\Column(name="postalCode",type="string", length = 50, nullable=true)
     */
    private $postalCode;
    /**
     * @ORM\Column(name="address",type="string", length = 255, nullable=true)
     */
    private $address;
    /**
     * @ORM\Column(name="phone",type="integer", nullable=true)
     */
    private $phone;
    /**
     * @ORM\Column(name="date_of_birth",type="date", nullable=true)
     */
    private $dateOfBirth;
    /**
     * @ORM\Column(name="create_at",type="datetime", nullable=true)
     */
    private $createAt;
    /**
     * @ORM\Column(name="update_at",type="datetime", nullable=true)
     */
    private $updateAt;
    /**
     * @ORM\Column(name="photo",type="string", nullable=true)
     */
    private $photo;

    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo): void
    {
        $this->photo = $photo;
    }

    /**
     * @return mixed
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * @param mixed $updateAt
     */
    public function setUpdateAt($updateAt): void
    {
        $this->updateAt = $updateAt;
    }

    /**
     * @param mixed $createAt
     */
    public function setCreateAt($createAt): void
    {
        $this->createAt = $createAt;
    }


    /**
     * @param mixed $town
     */
    public function setTown($town): void
    {
        $this->town = $town;
    }

    public function getGuid(): ?string
    {
        return $this->guid;
    }

    public function setGuid(?string $guid): self
    {
        $this->guid = $guid;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmailAddress(): ?string
    {
        return $this->emailAddress;
    }

    public function setEmailAddress(?string $emailAddress): self
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    public function getTown(): ?string
    {
        return $this->town;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(?int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(?\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }


    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country): void
    {
        $this->country = $country;
    }


}
