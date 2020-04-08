<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;


/**
 * @ApiResource(
 *    normalizationContext={"groups" : {"user_read_category"}}
 * )
 * @ApiFilter(SearchFilter::class, properties={"nom" : "exact"})
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category extends AbstractEntity
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
   * @ORM\ManyToMany(targetEntity="App\Entity\Produit", mappedBy="category")
   * @Groups({"user_read_category"})
   */
    private $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
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

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->addCategory($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->contains($produit)) {
            $this->produits->removeElement($produit);
            $produit->removeCategory($this);
        }

        return $this;
    }
}
