<?php
namespace App\Controller;

use App\Entity\Kategori;

class KategoriApiTestController
{
    
    public function __invoke(Kategori $kategori): Kategori
    {
        $kategori->setNama('coba-coba');

        return $kategori;
    }
}