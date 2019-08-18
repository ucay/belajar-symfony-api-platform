<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\KategoriRepository")
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get",
 *       "post_publication"={
 *         "method"="POST",
 *         "path"="/kategori/{id}/test",
 *         "controller"=App\Controller\KategoriApiTestController::class,
 *       }
 *     },
 *     routePrefix="/kat",
 * )
 */
class Kategori
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"book"})
     */
    private $nama;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Buku", mappedBy="kategori")
     * @ApiSubresource
     * 
     */
    private $daftarbuku;

    public function __construct()
    {
        $this->daftarbuku = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nama;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNama(): ?string
    {
        return $this->nama;
    }

    public function setNama(string $nama): self
    {
        $this->nama = $nama;

        return $this;
    }

    /**
     * @return Collection|Buku[]
     */
    public function getDaftarbuku(): Collection
    {
        return $this->daftarbuku;
    }

    public function addDaftarbuku(Buku $daftarbuku): self
    {
        if (!$this->daftarbuku->contains($daftarbuku)) {
            $this->daftarbuku[] = $daftarbuku;
            $daftarbuku->setKategori($this);
        }

        return $this;
    }

    public function removeDaftarbuku(Buku $daftarbuku): self
    {
        if ($this->daftarbuku->contains($daftarbuku)) {
            $this->daftarbuku->removeElement($daftarbuku);
            // set the owning side to null (unless already changed)
            if ($daftarbuku->getKategori() === $this) {
                $daftarbuku->setKategori(null);
            }
        }

        return $this;
    }
}
