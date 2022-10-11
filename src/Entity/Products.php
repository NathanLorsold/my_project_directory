<?php

namespace App\Entity;

use App\Repository\ProductsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductsRepository::class)]
class Products
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $ProductName = null;

    #[ORM\Column(length: 255)]
    private ?string $QuantityPerUnit = null;

    #[ORM\Column(length: 255)]
    private ?string $UnitPrice = null;

    #[ORM\Column(length: 255)]
    private ?string $UnitsOnStock = null;

    #[ORM\Column(length: 255)]
    private ?string $UnitsOnOrder = null;

    #[ORM\Column(length: 255)]
    private ?string $ReorderLevel = null;

    #[ORM\Column(length: 255)]
    private ?string $Discontinued = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?Suppliers $suppliers = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->ProductName;
    }

    public function setProductName(string $ProductName): self
    {
        $this->ProductName = $ProductName;

        return $this;
    }

    public function getQuantityPerUnit(): ?string
    {
        return $this->QuantityPerUnit;
    }

    public function setQuantityPerUnit(string $QuantityPerUnit): self
    {
        $this->QuantityPerUnit = $QuantityPerUnit;

        return $this;
    }

    public function getUnitPrice(): ?string
    {
        return $this->UnitPrice;
    }

    public function setUnitPrice(string $UnitPrice): self
    {
        $this->UnitPrice = $UnitPrice;

        return $this;
    }

    public function getUnitsOnStock(): ?string
    {
        return $this->UnitsOnStock;
    }

    public function setUnitsOnStock(string $UnitsOnStock): self
    {
        $this->UnitsOnStock = $UnitsOnStock;

        return $this;
    }

    public function getUnitsOnOrder(): ?string
    {
        return $this->UnitsOnOrder;
    }

    public function setUnitsOnOrder(string $UnitsOnOrder): self
    {
        $this->UnitsOnOrder = $UnitsOnOrder;

        return $this;
    }

    public function getReorderLevel(): ?string
    {
        return $this->ReorderLevel;
    }

    public function setReorderLevel(string $ReorderLevel): self
    {
        $this->ReorderLevel = $ReorderLevel;

        return $this;
    }

    public function getDiscontinued(): ?string
    {
        return $this->Discontinued;
    }

    public function setDiscontinued(string $Discontinued): self
    {
        $this->Discontinued = $Discontinued;

        return $this;
    }

    public function getSuppliers(): ?Suppliers
    {
        return $this->suppliers;
    }

    public function setSuppliers(?Suppliers $suppliers): self
    {
        $this->suppliers = $suppliers;

        return $this;
    }
}
