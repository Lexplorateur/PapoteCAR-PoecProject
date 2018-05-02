<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\member", inversedBy="comments")
     */
    private $writer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\member", inversedBy="commentsaboutme")
     * @ORM\JoinColumn(nullable=false)
     */
    private $target;

    /**
     * @Assert\Length(
     *     max="4000",
     *     maxMessage="Your comment is too long dude! 4000 max!",
     *     min="2",
     *     minMessage="2 chars minimum please !"
     * )
     *
     * @Assert\NotBlank(message="Please provide a comment!")
     *
     * @ORM\Column(type="text")
     */
    private $content;

    public function getId()
    {
        return $this->id;
    }

    public function getWriter(): ?member
    {
        return $this->writer;
    }

    public function setWriter(?member $writer): self
    {
        $this->writer = $writer;

        return $this;
    }

    public function getTarget(): ?member
    {
        return $this->target;
    }

    public function setTarget(?member $target): self
    {
        $this->target = $target;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }
}
