<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 8/09/14
 * Time: 12:51
 */

namespace Efl\WebBundle\Form\Validator\Constraints;

use eZ\Publish\Core\Persistence\Database\DatabaseHandler;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class EmailAlreadySubscribedValidator extends ConstraintValidator
{
    /**
     * @var DatabaseHandler
     */
    private $dbHandler;

    public function setConnection( $dbHandler )
    {
        // This obviously violates the Liskov substitution Principle, but with
        // the given class design there is no sane other option. Actually the
        // dbHandler *should* be passed to the constructor, and there should
        // not be the need to post-inject it.
        if ( !$dbHandler instanceof \eZ\Publish\Core\Persistence\Database\DatabaseHandler )
        {
            throw new \RuntimeException( "Invalid dbHandler passed" );
        }

        $this->dbHandler = $dbHandler;
    }

    /**
     * Returns the active connection
     *
     * @throws \RuntimeException if no connection has been set, yet.
     *
     * @return \eZ\Publish\Core\Persistence\Database\DatabaseHandler
     */
    protected function getConnection()
    {
        if ( $this->dbHandler === null )
        {
            throw new \RuntimeException( "Missing database connection." );
        }
        return $this->dbHandler;
    }

    public function validate( $email, Constraint $constraint )
    {
        $connection = $this->getConnection();
        $query = $connection->createSelectQuery();
        $query->select( 'cjwnl_user.id' )
            ->from( 'cjwnl_user')
            ->innerJoin('cjwnl_subscription', $query->expr->eq( 'cjwnl_user.id', 'cjwnl_subscription.newsletter_user_id' ))
            ->where(
                $query->expr->land(
                    $query->expr->eq(
                        $connection->quoteColumn( 'email' ),
                        $query->bindValue( $email, null, \PDO::PARAM_STR )
                    ),
                    $query->expr->eq(
                    $connection->quoteColumn( 'list_contentobject_id' ),
                        $query->bindValue( 7943 )
                    )
                )
            );

        $statement = $query->prepare();
        $statement->execute();

        if ( $statement->rowCount() )
        {
            $this->context->addViolation(
                $constraint->message,
                array('%email%' => $email)
            );
        }
    }
}