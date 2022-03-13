<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

 #[ORM\Entity(repositoryClass: ProductRepository::class)] 
          #[Vich\Uploadable]
          
         class Product
         {
             #[ORM\Id]
             #[ORM\GeneratedValue]
             #[ORM\Column(type: 'integer')]
             private $id;
         
             #[ORM\Column(type: 'string', length: 255)]
             private $name;
         
             #[ORM\Column(type: 'string', length: 255)]
             private $slug;
         
             #[ORM\Column(type: 'string', length: 255)]
             private $illustration;
         
             
             
               /**
                *  @var File
                */
              
                #[Vich\UploadableField(mapping:"product", fileNameProperty:"illustration")]
             private $imageFile;
         
             /**
              * @ORM\Column( type="datetime")
              * @var \DateTime
              */
             private $updatedAt;
         
             public function __construct()
             {
                 $this->updatedAt = new \DateTime();
             }
         
             #[ORM\Column(type: 'string', length: 255)]
             private $subtitle;
         
             #[ORM\Column(type: 'text')]
             private $description;
         
             #[ORM\Column(type: 'float')]
             private $price;
         
             #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'products')]
             #[ORM\JoinColumn(nullable: false)]
             private $category;
      
             #[ORM\Column(type: 'boolean')]
             private $isBest;
         
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
         
             public function getSlug(): ?string
             {
                 return $this->slug;
             }
         
             public function setSlug(string $slug): self
             {
                 $this->slug = $slug;
         
                 return $this;
             }
         
             public function getIllustration(): ?string
             {
                 return $this->illustration;
             }
         
             public function setIllustration(?string $illustration): self
             {
                 $this->illustration = $illustration;
         
                 return $this;
             }
         
             /**
              * @return File
              */
             public function getImageFile(): ?File
             {
                 return $this->imageFile;
             }
             public function setImageFile(?File $imageFile = null)
             {
                 $this->imageFile = $imageFile;
                 if (null !== $imageFile) {
                     // It is required that at least one field changes if you are using doctrine
                     // otherwise the event listeners won't be called and the file is lost
                     $this->updatedAt = new \DateTimeImmutable();
                 }
         
         
                 
             }
         
             public function getSubtitle(): ?string
             {
                 return $this->subtitle;
             }
         
             public function setSubtitle(string $subtitle): self
             {
                 $this->subtitle = $subtitle;
         
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
         
             public function getPrice(): ?float
             {
                 return $this->price;
             }
         
             public function setPrice(float $price): self
             {
                 $this->price = $price;
         
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
   
             public function getIsBest(): ?bool
             {
                 return $this->isBest;
             }

             public function setIsBest(bool $isBest): self
             {
                 $this->isBest = $isBest;

                 return $this;
             }
         }
