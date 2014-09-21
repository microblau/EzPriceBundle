<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/09/14
 * Time: 19:49
 */

namespace Efl\ReviewsBundle\eZ\Publish\Core\Persistence\Legacy\Reviews\Gateway;

use Doctrine\ORM\EntityManager;
use Efl\ReviewsBundle\eZ\Publish\Core\Persistence\Legacy\Reviews\Gateway;

class Doctrine extends Gateway
{
    /**
     * Database handler
     *
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * Construct from database handler
     *
     * @param \Doctrine\ORM\EntityManager $em
     */
    public function __construct( EntityManager $em )
    {
        $this->em = $em;
    }

    /**
     * Nº de reviews que tiene un producto
     *
     * @param $locationId
     * @return mixed
     */
    public function getReviewsCountForLocationId( $locationId )
    {
        $query = $this->em->createQueryBuilder();
        $query
            ->select( 'count(v.id) as n' )
            ->from( 'EflReviewsBundle:ValoracionesProductos','v' )
            ->where(
                $query->expr()->andX(
                    $query->expr()->eq( 'v.nodeProducto', ':locationId' ),
                    $query->expr()->eq( 'v.visible', 1 )
                )
            )
            ->setParameter( 'locationId', $locationId );

        return $query->getQuery()->getScalarResult()[0]['n'];
    }

    /**
     * Reviews que tiene un producto
     *
     * @param int $locationId
     * @param int $limit
     * @param int $offset
     */
    public function getReviewsForLocationId( $locationId, $limit, $offset = 0 )
    {
        $query = $this->em->createQueryBuilder();
        $query
            ->select( 'v.calidad', 'v.actualizaciones', 'v.facilidad', 'v.comentario', 'v.nombre', 'v.apellidos', 'v.empresa' )
            ->from( 'EflReviewsBundle:ValoracionesProductos','v' )
            ->where(
                $query->expr()->andX(
                    $query->expr()->eq( 'v.nodeProducto', ':locationId' ),
                    $query->expr()->eq( 'v.visible', 1 )
                )
            )
            ->orderBy( 'v.fecha', 'DESC' )
            ->setFirstResult( $offset )
            ->setMaxResults( $limit )
            ->setParameter( 'locationId', $locationId );

        return $query->getQuery()->getResult();
    }
}
