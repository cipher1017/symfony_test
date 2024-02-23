<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Blogs::class)]
    private Collection $blogs;

    #[ORM\Column(length: 255)]
    private ?string $feed_url = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $feed_last_updated_at = null;

    #[ORM\Column(length: 255, options: ['default' => ''])]
    private ?string $description = '';

    public function __construct()
    {
        $this->blogs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Blogs>
     */
    public function getBlogs(): Collection
    {
        return $this->blogs;
    }

    public function addBlog(Blogs $blog): static
    {
        if (!$this->blogs->contains($blog)) {
            $this->blogs->add($blog);
            $blog->setCategory($this);
        }

        return $this;
    }

    public function removeBlog(Blogs $blog): static
    {
        if ($this->blogs->removeElement($blog)) {
            // set the owning side to null (unless already changed)
            if ($blog->getCategory() === $this) {
                $blog->setCategory(null);
            }
        }

        return $this;
    }

    public function getFeedUrl(): ?string
    {
        return $this->feed_url;
    }

    public function setFeedUrl(string $feed_url): static
    {
        $this->feed_url = $feed_url;

        return $this;
    }

    public function getFeedLastUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->feed_last_updated_at;
    }

    public function setFeedLastUpdatedAt(\DateTimeImmutable $feed_last_updated_at): static
    {
        $this->feed_last_updated_at = $feed_last_updated_at;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }
}
