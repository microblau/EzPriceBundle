<?php
    class eZEflSSOHandler
    {
        public function __construct()
        {
         // Here you can make initialization stuffs for your handler
        }
 
        /**
         * Return a eZUser PHP object to be logged in eZ Publish
         * If authentication fails, just return false
         */
        public function handleSSOLogin()
        {
            $currentUser = false; // Default falue that we return if authentication fails.
            print session_id();
            print_r( $_SESSION );
            // Here you can do everything you need to identify your user (interface with SSO, search the SSO database...)
            // In all cases, you must return a valid eZ Publish user or false
            // User must be created if needed
           // $currentUser = eZUser::fetch( 2401 );
 
            return $currentUser;
        }
    }
?>
