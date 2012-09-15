<?php
class CjwNewsletterTrack extends eZPersistentObject
{
    function CjwNewsletterTrack( $row )
    {
        $this->eZPersistentObject( $row );
    }

    static function definition()
    {
        return array( 
            'fields' => array(
                'hash' => 'hash',
                'newsletterid' => 'newsletterid'  
            ),
            'keys' => array( 'hash', 'newsletter_id' ),
            'class_name' => 'CjwNewsletterTrack',
            'name' => 'cjw_newsletter_track'
        );
    }

    static function fetchCountByNewsletterID( $newsletter_id )
    {
        $objects = eZPersistentObject::fetchObjectList( 
            self::definition(),
            null,
            array( 'newsletter_id' => $newsletter_id )
        );
        return count( $objects );
    }

    static function create( $hash, $newsletterid )
    {
        return new CjwNewsletterTrack( array( 'hash' => $hash, 
                                              'newsletterid' => $newsletterid 
                                            ) );
    }
}
?>
