<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;

/**
 * @ApiResource(
 *    normalizationContext={"groups" : {"user_read_produit"}}
 * )
 * @ApiFilter(RangeFilter::class, properties={"prix"})
 * @ApiFilter(SearchFilter::class, properties={"nom": "ipartial"})
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
 */
class Produit extends AbstractEntity
{
  /**
   * @ORM\Id()
   * @ORM\GeneratedValue()
   * @ORM\Column(type="integer")
   * @Groups({"user_read_produit"})
   * @Groups({"user_read_category"})
   */
    private $id;

  /**
   * @ORM\Column(type="string", length=255)
   * @Groups({"user_read_produit"})
   * @Groups({"user_read_category"})
   */
    private $nom;

  /**
   * @ORM\Column(type="text")
   * @Groups({"user_read_produit"})
   * @Groups({"user_read_category"})
   */
    private $description;

  /**
   * @ORM\ManyToMany(targetEntity="App\Entity\Category", inversedBy="produits")
   * @Groups({"user_read_produit"})
   */
    private $category;

  /**
   * @ORM\Column(type="float")
   * @Groups({"user_read_produit"})
   * @Groups({"user_read_category"})
   */
    private $prix;

    public function __construct()
    {
        $this->category = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

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

    /**
     * @return Collection|Category[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->category->contains($category)) {
            $this->category->removeElement($category);
        }

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }
}
