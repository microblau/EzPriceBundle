<?php

class eflBlog {
    function __construct()
    {
        $this->User = eZINI::instance( 'blog.ini' )->variable( 'BlogDatabaseSettings', 'User' );
        $this->Password = eZINI::instance( 'blog.ini' )->variable( 'BlogDatabaseSettings', 'Password' );
        $this->DB = eZINI::instance( 'blog.ini' )->variable( 'BlogDatabaseSettings', 'Database' );
    }

    function getRelatedPosts( $query )
    {
        $params = array( 
            'use_defaults' => false,
            'user' => $this->User,
            'password' => $this->Password,
            'database' => $this->DB );
        $db = eZDB::instance( 'ezmysqli', $params, true );
        $result = $db->arrayQuery( "SELECT DISTINCT(guid), post_title
                                    FROM efl_posts
                                    INNER JOIN efl_postmeta ON efl_posts.ID = efl_postmeta.post_id 
                                    INNER JOIN efl_postmeta aux ON efl_postmeta.post_id = aux.post_id
                                    WHERE ( post_content LIKE '%{$query}%' OR 
                                            post_title LIKE '%{$query}%' OR ( 
                                            efl_postmeta.meta_key = '_obras' AND
                                            efl_postmeta.meta_value LIKE '%{$query}%' )
                                            ) AND aux.meta_key = '_p_prot' AND aux.meta_value = 'off'
                                            ORDER BY post_date DESC
                                            "
                                           );
        return array( 'result' => $result );
                                       
    }

    var $User;
    var $Password;
    var $DB;
}

?>
