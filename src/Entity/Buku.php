<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\BukuRepository")
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
     */
    private $judul;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $halaman;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Kategori", inversedBy="daftarbuku")
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
}
