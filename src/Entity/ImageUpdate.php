<?php

namespace App\Entity;




class ImageUpdate
{



    private $oldImage;


    private $newImage;


    public function getOldImage(): ?string
    {
        return $this->oldImage;
    }

    public function setOldImage(string $oldImage): self
    {
        $this->oldImage = $oldImage;

        return $this;
    }

    public function getNewImage()
    {
        return $this->newImage;
    }

    public function setNewImage($newImage)
    {
        $this->newImage = $newImage;

        return $this;
    }
}
