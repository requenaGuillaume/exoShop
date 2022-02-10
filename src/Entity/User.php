<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity("email", message="Un utilisateur existe déja pour cette adresse mail.")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank(message="Le champ doit être complété.")
     * @Assert\Email( message = "'{{ value }}' n'est pas une adresse mail valide.")
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Le champ doit être complété.")
     * @Assert\Length(
     *                  min=2, 
     *                  max=255, 
     *                  minMessage="Le champ doit être supérieur ou égal à {{ limit }} caractères.", 
     *                  maxMessage="Le champ doit être inférieur ou égal à {{ limit }} caractères."
     *              )
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Les mots de passe ne correspondent pas.")
     */
    private $confirmPassword;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le champ doit être complété.")
     * @Assert\Length(
     *                  min=2, 
     *                  max=255, 
     *                  minMessage="Le champ doit être supérieur ou égal à {{ limit }} caractères.", 
     *                  maxMessage="Le champ doit être inférieur ou égal à {{ limit }} caractères."
     *              )
     * @Assert\Regex("/^[^<>{}][^<>{}]+[^<>{}]$/", message="Le champ ne doit pas contenir les caractères suivants : < > { }")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le champ doit être complété.")
     * @Assert\Length(
     *                  min=2, 
     *                  max=255, 
     *                  minMessage="Le champ doit être supérieur ou égal à {{ limit }} caractères.", 
     *                  maxMessage="Le champ doit être inférieur ou égal à {{ limit }} caractères."
     *              )
     * @Assert\Regex("/^[^<>{}][^<>{}]+[^<>{}]$/", message="Le champ ne doit pas contenir les caractères suivants : < > { }")
     */
    private $lastName;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Le champ doit être complété.")
     * @Assert\Length(
     *                  min=10, 
     *                  max=12, 
     *                  minMessage="Le champ doit être supérieur ou égal à {{ limit }} caractères.", 
     *                  maxMessage="Le champ doit être inférieur ou égal à {{ limit }} caractères."
     *              )
     * @Assert\Regex("/^[+0-9]{1,3}[0-9]{9}$/", message="Formats acceptés : 0101010101 ou +33101010101")
     */
    private $phone;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Le champ doit être complété.")
     * @Assert\Length(
     *                  min=5, 
     *                  max=7, 
     *                  minMessage="Le champ doit être supérieur ou égal à {{ limit }} caractères.", 
     *                  maxMessage="Le champ doit être inférieur ou égal à {{ limit }} caractères."
     *              )
     * @Assert\Regex("/^[A-Z(^<>)]{0,2}[0-9]{3,5}$/", message="Formats acceptés : AA934 ou 93400")
     */
    private $postalCode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le champ doit être complété.")
     * @Assert\Length(
     *                  min=2, 
     *                  max=255, 
     *                  minMessage="Le champ doit être supérieur ou égal à {{ limit }} caractères.", 
     *                  maxMessage="Le champ doit être inférieur ou égal à {{ limit }} caractères."
     *              )
     * @Assert\Regex("/^[^<>{}][^<>{}]+[^<>{}]$/", message="Le champ ne doit pas contenir les caractères suivants : < > { }")
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le champ doit être complété.")
     * @Assert\Length(
     *                  min=2, 
     *                  max=255, 
     *                  minMessage="Le champ doit être supérieur ou égal à {{ limit }} caractères.", 
     *                  maxMessage="Le champ doit être inférieur ou égal à {{ limit }} caractères."
     *              )
     * @Assert\Regex("/^[^<>{}][^<>{}]+[^<>{}]$/", message="Le champ ne doit pas contenir les caractères suivants : < > { }")
     */
    private $country;

    /**
     * @ORM\Column(type="date")
     */
    private $birthDate;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le champ doit être complété.")
     * @Assert\Length(
     *                  min=2, 
     *                  max=255, 
     *                  minMessage="Le champ doit être supérieur ou égal à {{ limit }} caractères.", 
     *                  maxMessage="Le champ doit être inférieur ou égal à {{ limit }} caractères."
     *              )
     * @Assert\Regex("/^[^<>{}][^<>{}]+[^<>{}]$/", message="Le champ ne doit pas contenir les caractères suivants : < > { }")
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity=Purchase::class, mappedBy="user")
     */
    private $purchases;

    public function __construct()
    {
        $this->purchases = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }


    public function getConfirmPassword(): string
    {
        return $this->confirmPassword;
    }

    public function setConfirmPassword(string $confirmPassword): self
    {
        $this->confirmPassword = $confirmPassword;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection|Purchase[]
     */
    public function getPurchases(): Collection
    {
        return $this->purchases;
    }

    public function addPurchase(Purchase $purchase): self
    {
        if (!$this->purchases->contains($purchase)) {
            $this->purchases[] = $purchase;
            $purchase->setUser($this);
        }

        return $this;
    }

    public function removePurchase(Purchase $purchase): self
    {
        if ($this->purchases->removeElement($purchase)) {
            // set the owning side to null (unless already changed)
            if ($purchase->getUser() === $this) {
                $purchase->setUser(null);
            }
        }

        return $this;
    }
}
