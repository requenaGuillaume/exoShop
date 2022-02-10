<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

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
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Le champ doit être complété.")
     * @Assert\Regex("/^[^<>{}][^<>{}]+[^<>{}]$/", message="Le champ ne doit pas contenir les caractères suivants : < > { }")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le champ doit être complété.")
     * @Assert\Positive(message="La valeur doit être positive.")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Url(message="Ce champ doit recevoir une URL")
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="products")
     * @Assert\NotBlank(message="Vous devez choisir une cétégorie.")
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity=Purchaseitem::class, mappedBy="product")
     */
    private $purchaseitems;

    public function __construct()
    {
        $this->purchaseitems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

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
            $purchaseitem->setProduct($this);
        }

        return $this;
    }

    public function removePurchaseitem(Purchaseitem $purchaseitem): self
    {
        if ($this->purchaseitems->removeElement($purchaseitem)) {
            // set the owning side to null (unless already changed)
            if ($purchaseitem->getProduct() === $this) {
                $purchaseitem->setProduct(null);
            }
        }

        return $this;
    }
}
