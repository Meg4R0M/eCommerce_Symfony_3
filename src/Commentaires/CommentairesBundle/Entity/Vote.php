<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 22/12/16
 * Time: 09:58
 */

namespace Commentaires\CommentairesBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use FOS\CommentBundle\Entity\Vote as BaseVote;

/**
 * @ORM\Entity
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class Vote extends BaseVote
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Comment of this vote
     *
     * @var Comment
     * @ORM\ManyToOne(targetEntity="Commentaires\CommentairesBundle\Entity\Comment")
     */
    protected $comment;
}