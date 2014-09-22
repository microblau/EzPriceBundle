<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/09/14
 * Time: 19:49
 */

namespace Efl\ReviewsBundle\eZ\Publish\Core\Persistence\Legacy\Reviews\Gateway;

use Doctrine\ORM\EntityManager;
use Efl\ReviewsBundle\Entity\ValoracionesProductos;
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
     * @inheritdoc
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
     * @inheritdoc
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

    /**
     * @inheritdoc
     */
    public function createReview( $locationId, $userId, array $data )
    {
        $valoracionProducto = new ValoracionesProductos();
        $valoracionProducto->setCalidad( $data['calidad'] );
        $valoracionProducto->setFacilidad( $data['facilidad'] );
        $valoracionProducto->setActualizaciones( $data['actualizaciones'] );
        $valoracionProducto->setNodeProducto( $locationId );
        $valoracionProducto->setEmail( $data['email'] );
        $valoracionProducto->setComentario( $data['comentario'] );
        $valoracionProducto->setNombre( $data['nombre'] );
        $valoracionProducto->setApellidos( $data['apellido1'] );
        $valoracionProducto->setApellido2( $data['apellido2'] );
        $valoracionProducto->setVisible( 2 );
        $valoracionProducto->setUserId( $userId );
        $valoracionProducto->setFecha( time() );
        $valoracionProducto->setHaVotado( 1 );
        $this->em->persist( $valoracionProducto );
        $this->em->flush();
    }

    /**
     * @param int $userId
     * @param int $locationId
     *
     * @return bool
     */
    public function userHasReviewedLocation( $userId, $locationId )
    {
        $query = $this->em->createQueryBuilder();
        $query
            ->select( 'count(v.id) as n' )
            ->from( 'EflReviewsBundle:ValoracionesProductos','v' )
            ->where(
                $query->expr()->andX(
                    $query->expr()->eq( 'v.nodeProducto', ':locationId' ),
                    $query->expr()->eq( 'v.visible', 1 ),
                    $query->expr()->eq( 'v.userId', $userId )
                )
            )
            ->setParameter( 'locationId', $locationId );

        return $query->getQuery()->getScalarResult()[0]['n'];
    }
}
