<?php

namespace App\Entity;

use App\Repository\PurchaseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PurchaseRepository::class)
 */
class Purchase
{
    public const STATUS_PENDING = 'Pending';
    public const STATUS_PAID = 'Paid';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="purchases")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le champ doit être complété.")
     * @Assert\Length(
     *                  min=2, 
     *                  max=255, 
     *                  minMessage="Le nom doit être supérieur à {{ limit }} caractères.", 
     *                  maxMessage="Le nom doit être inférieur à {{ limit }} caractères."
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
     *                  minMessage="Le nom doit être supérieur à {{ limit }} caractères.", 
     *                  maxMessage="Le nom doit être inférieur à {{ limit }} caractères."
     *              )
     * @Assert\Regex("/^[^<>{}][^<>{}]+[^<>{}]$/", message="Le champ ne doit pas contenir les caractères suivants : < > { }")
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le champ doit être complété.")
     * @Assert\Length(
     *                  min=2, 
     *                  max=255, 
     *                  minMessage="Le nom doit être supérieur à {{ limit }} caractères.", 
     *                  maxMessage="Le nom doit être inférieur à {{ limit }} caractères."
     *              )
     * @Assert\Regex("/^[^<>{}][^<>{}]+[^<>{}]$/", message="Le champ ne doit pas contenir les caractères suivants : < > { }")
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le champ doit être complété.")
     * @Assert\Length(
     *                  min=5, 
     *                  max=7, 
     *                  minMessage="Le nom doit être supérieur à {{ limit }} caractères.", 
     *                  maxMessage="Le nom doit être inférieur à {{ limit }} caractères."
     *              )
     * @Assert\Regex("/^[^<>{}][^<>{}]+[^<>{}]$/", message="Le champ ne doit pas contenir les caractères suivants : < > { }")
     */
    private $postalCode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le champ doit être complété.")
     * @Assert\Length(
     *                  min=2, 
     *                  max=255, 
     *                  minMessage="Le nom doit être supérieur à {{ limit }} caractères.", 
     *                  maxMessage="Le nom doit être inférieur à {{ limit }} caractères."
     *              )
     * @Assert\Regex("/^[^<>{}][^<>{}]+[^<>{}]$/", message="Le champ ne doit pas contenir les caractères suivants : < > { }")
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le champ doit être complété.")
     * @Assert\Length(
     *                  min=2, 
     *                  max=255, 
     *                  minMessage="Le nom doit être supérieur à {{ limit }} caractères.", 
     *                  maxMessage="Le nom doit être inférieur à {{ limit }} caractères."
     *              )
     * @Assert\Regex("/^[^<>{}][^<>{}]+[^<>{}]$/", message="Le champ ne doit pas contenir les caractères suivants : < > { }")
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=Purchaseitem::class, mappedBy="purchase", orphanRemoval=true)
     */
    private $purchaseitems;

    /**
     * @ORM\Column(type="integer")
     */
    private $totalPrice;

    public function __construct()
    {
        $this->purchaseitems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
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

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|Purchaseitem[]
     */
    public function getPurchaseitems(): Collection
    {
        return $this->purchaseitems;
    }

    public function addPurchaseitem(Purchaseitem $purchaseitem): self
    {
        if (!$this->purchaseitems->contains($purchaseitem)) {
            $this->purchaseitems[] = $purchaseitem;
            $purchaseitem->setPurchase($this);
        }

        return $this;
    }

    public function removePurchaseitem(Purchaseitem $purchaseitem): self
    {
        if ($this->purchaseitems->removeElement($purchaseitem)) {
            // set the owning side to null (unless already changed)
            if ($purchaseitem->getPurchase() === $this) {
                $purchaseitem->setPurchase(null);
            }
        }

        return $this;
    }

    public function getTotalPrice(): ?int
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(int $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }
}
