<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\User;
use App\Entity\Page;

/**
 * @ORM\Table(name="comments")
 * @ORM\Entity
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comments")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    private $autor;
    /**
     * @ORM\Column(type="text", name="text")
     * @Assert\NotBlank()
     */
    private $text;
    /**
     * @ORM\Column(type="date", name="date")
     */
    private $date;
    /**
     * @ORM\ManyToOne(targetEntity="Page", inversedBy="comments")
     *@ORM\JoinColumn(name="page", referencedColumnName="id")
     */
    private $page;

    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @return mixed
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * @param mixed $autor
     */
    public function setAutor($autor): void
    {
        $this->autor = $autor;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $page
     */
    public function setPage($page): void
    {
        $this->page = $page;
    }

    public function toJSON(){
        return json_encode(
            [
                'username'=>$this->autor!=null?$this->autor->getUserName():null,
                'text'=>$this->text,
                'date'=>$this->date->format("d-m-Y H:i:s"),
                'page_id'=>$this->page != null?$this->page->getId():null
            ]
        );
    }
}