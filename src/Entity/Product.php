<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $ProductName = null;

    #[ORM\Column]
    private ?int $SupplierId = null;

    #[ORM\Column]
    private ?int $CategoryId = null;

    #[ORM\Column(length: 255)]
    private ?string $QuantityPerUnit = null;

    #[ORM\Column(length: 255)]
    private ?string $UnitPrice = null;

    #[ORM\Column(length: 255)]
    private ?string $UnitsInStock = null;

    #[ORM\Column(length: 255)]
    private ?string $UnitsOnOrder = null;

    #[ORM\Column(length: 255)]
    private ?string $RedorderLevel = null;

    #[ORM\Column(length: 255)]
    private ?string $Discontinued = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?Supplier $supplier = null;

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

    public function getSupplierId(): ?int
    {
        return $this->SupplierId;
    }

    public function setSupplierId(int $SupplierId): self
    {
        $this->SupplierId = $SupplierId;

        return $this;
    }

    public function getCategoryId(): ?int
    {
        return $this->CategoryId;
    }

    public function setCategoryId(int $CategoryId): self
    {
        $this->CategoryId = $CategoryId;

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

    public function getUnitsInStock(): ?string
    {
        return $this->UnitsInStock;
    }

    public function setUnitsInStock(string $UnitsInStock): self
    {
        $this->UnitsInStock = $UnitsInStock;

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

    public function getRedorderLevel(): ?string
    {
        return $this->RedorderLevel;
    }

    public function setRedorderLevel(string $RedorderLevel): self
    {
        $this->RedorderLevel = $RedorderLevel;

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

    public function getSupplier(): ?Supplier
    {
        return $this->supplier;
    }

    public function setSupplier(?Supplier $supplier): self
    {
        $this->supplier = $supplier;

        return $this;
    }
}
