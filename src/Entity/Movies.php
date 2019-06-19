<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MoviesRepository")
 */
class Movies
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Title;

    /**
     * @ORM\Column(type="integer")
     */
    private $Year;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Rated;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Released;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Runtime;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Genre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Director;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Writer;

    /**
     * @ORM\Column(type="text")
     */
    private $Actors;

    /**
     * @ORM\Column(type="text")
     */
    private $Plot;

    /**
     * @ORM\Column(type="text")
     */
    private $Language;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Country;

    /**
     * @ORM\Column(type="text")
     */
    private $Awards;

    /**
     * @ORM\Column(type="text")
     */
    private $Poster;

    /**
     * @ORM\Column(type="text")
     */
    private $Ratings;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $DVD;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $BoxOffice;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Production;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Website;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->Year;
    }

    public function setYear(int $Year): self
    {
        $this->Year = $Year;

        return $this;
    }

    public function getRated(): ?string
    {
        return $this->Rated;
    }

    public function setRated(string $Rated): self
    {
        $this->Rated = $Rated;

        return $this;
    }

    public function getReleased(): ?\DateTimeInterface
    {
        return $this->Released;
    }

    public function setReleased(\DateTimeInterface $Released): self
    {
        $this->Released = $Released;

        return $this;
    }

    public function getRuntime(): ?string
    {
        return $this->Runtime;
    }

    public function setRuntime(string $Runtime): self
    {
        $this->Runtime = $Runtime;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->Genre;
    }

    public function setGenre(string $Genre): self
    {
        $this->Genre = $Genre;

        return $this;
    }

    public function getDirector(): ?string
    {
        return $this->Director;
    }

    public function setDirector(string $Director): self
    {
        $this->Director = $Director;

        return $this;
    }

    public function getWriter(): ?string
    {
        return $this->Writer;
    }

    public function setWriter(string $Writer): self
    {
        $this->Writer = $Writer;

        return $this;
    }

    public function getActors(): ?string
    {
        return $this->Actors;
    }

    public function setActors(string $Actors): self
    {
        $this->Actors = $Actors;

        return $this;
    }

    public function getPlot(): ?string
    {
        return $this->Plot;
    }

    public function setPlot(string $Plot): self
    {
        $this->Plot = $Plot;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->Language;
    }

    public function setLanguage(string $Language): self
    {
        $this->Language = $Language;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->Country;
    }

    public function setCountry(string $Country): self
    {
        $this->Country = $Country;

        return $this;
    }

    public function getAwards(): ?string
    {
        return $this->Awards;
    }

    public function setAwards(string $Awards): self
    {
        $this->Awards = $Awards;

        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->Poster;
    }

    public function setPoster(string $Poster): self
    {
        $this->Poster = $Poster;

        return $this;
    }

    public function getRatings(): ?string
    {
        return $this->Ratings;
    }

    public function setRatings(string $Ratings): self
    {
        $this->Ratings = $Ratings;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getDVD(): ?string
    {
        return $this->DVD;
    }

    public function setDVD(string $DVD): self
    {
        $this->DVD = $DVD;

        return $this;
    }

    public function getBoxOffice(): ?string
    {
        return $this->BoxOffice;
    }

    public function setBoxOffice(string $BoxOffice): self
    {
        $this->BoxOffice = $BoxOffice;

        return $this;
    }

    public function getProduction(): ?string
    {
        return $this->Production;
    }

    public function setProduction(string $Production): self
    {
        $this->Production = $Production;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->Website;
    }

    public function setWebsite(string $Website): self
    {
        $this->Website = $Website;

        return $this;
    }
}
