<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;



/**
 * @ORM\Entity(repositoryClass="App\Repository\BukuRepository")
 * @ApiResource(normalizationContext={"groups"={"book"}})
 */
class Buku
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 5,
     *      minMessage = "Buku minimal 5 karakter",
     * )
     * @ApiFilter(SearchFilter::class)
     * @Groups({"book"})
     */
    private $judul;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $halaman;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $abc;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Kategori", inversedBy="daftarbuku")
     * @Groups({"book"})
     */
    private $kategori;

    public function __toString()
    {
        return $this->judul;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJudul(): ?string
    {
        return $this->judul;
    }

    public function setJudul(string $judul): self
    {
        $this->judul = $judul;

        return $this;
    }

    public function getHalaman(): ?int
    {
        return $this->halaman;
    }

    public function setHalaman(?int $halaman): self
    {
        $this->halaman = $halaman;

        return $this;
    }

    public function getKategori(): ?Kategori
    {
        return $this->kategori;
    }

    public function setKategori(?Kategori $kategori): self
    {
        $this->kategori = $kategori;

        return $this;
    }

    public function getAbc(): ?int
    {
        return $this->abc;
    }

    public function setAbc(?int $abc): self
    {
        $this->abc = $abc;

        return $this;
    }
}
