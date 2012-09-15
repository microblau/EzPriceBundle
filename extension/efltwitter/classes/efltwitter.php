<?php


class eflTwitter
{
    var $user = "EdicionesFL";
    var $password = "";
    
    /**
    * Constructor
    */
    function eflTwitter( )
    {
        $ini = eZIni::instance("twitter.ini");
        $this->user = $ini->variable( "EflTwitterSettings", "User" );
        $this->password = $ini->variable( "EflTwitterSettings", "Password" );
    }

     /**
     * Get the timeline for the user. 
     * $limit could be 0 (wich means no limit) or any other number. 
     * By default twitter will give your 20 last messages
     * 
     * @return array
     * @param integer $limit
     */    
    public function getFriendsTimeline( $limit = 0, $user, $pass )
    {    
    	$result = array();

        // initialize the twitter class
		$twitter = new Twitter( $user, $pass );
		
		// fetch public timeline in xml format
		//$xml = $twitter->getPublicTimeline();
		//$xml = $twitter->getFriendsTimeline();
		$xml = $twitter->getFriendsTimeline();
        print 'xx';
	    print_r( $xml );
		//$twitterStatus = new SimpleXMLElement($xml);
		$response = new SimpleXMLElement($xml);				
		
		if ( count( $response->status ) > 0 )
        {
            if ( $limit != 0 )
            {
               for ( $i=0; $i < $limit; $i++ )
               {    
                   if ( isset( $response->status[$i] ) )
                   {
                       $status = $response->status[$i];
                       $element = array( );
                       //$element["text"] = (string)$status->text;
		       		   $element["text"] = $this->parse_twitter( (string)$status->text );
                       $element["id"] = (string)$status->id;
                       $element["source"] = (string)$status->source;
                       $element["timestamp"] = strtotime( $status->created_at );
                       $user = $status->user;
                       $element["user_screen_name"] = (string)$user->screen_name;
                       $element["user_full_name"] = (string)$user->name;
                       $element["user_profile_image_url"] = (string)$user->profile_image_url;
                       $result[] = $element;
                   }
               }
            }
            else
            {
                foreach ( $response->status as $status )
                {
                    $element = array( );
                    //$element["text"] = (string)$status->text;
		            $element["text"] = $this->parse_twitter( (string)$status->text );
                    $element["id"] = (string)$status->id;
                    $element["source"] = (string)$status->source;
                    $element["timestamp"] = strtotime( $status->created_at );
                    $user = $status->user;
                    $element["user_screen_name"] = (string)$user->screen_name;
                    $element["user_full_name"] = (string)$user->name;
                    $element["user_profile_image_url"] = (string)$user->profile_image_url;
                    $result[] = $element;
                }
            }
        }
		
        return array( "result" => $result );
        
    }
    
    /**
     * Get the timeline for the user. 
     * $limit could be 0 (wich means no limit) or any other number. 
     * By default twitter will give your 20 last messages
     * 
     * @return array
     * @param integer $limit
     */    
    public function getUserTimeline( $limit = 0, $user, $pass, $include_retweets=false )
    {
        $ini = eZINI::instance( 'twitter.ini' );
        $consumer_key = $ini->variable( 'EflTwitterSettings', 'ConsumerKey' );
        $consumer_secret = $ini->variable( 'EflTwitterSettings', 'ConsumerSecret' );
        $oauthtoken = $ini->variable( 'EflTwitterSettings', 'OAuthToken' );
        $oauthsecret = $ini->variable( 'EflTwitterSettings', 'OAuthSecret' );

        try{
            $twitterObj = new EpiTwitter( $consumer_key, $consumer_secret, $oauthtoken, $oauthsecret );

            $creds = $twitterObj->get('/account/verify_credentials.json');

            $query = $twitterObj->get('/statuses/user_timeline.xml?screen_name='.urlencode($user).'&include_rts='.($include_retweets?'true':'false').'&count=' . $limit);
        }catch(Exception $e){
            return array( 'result' => false );
        }

/*
        $result = array();

        // initialize the twitter class
        $twitter = new Twitter( $user, $pass );

        // fetch public timeline in xml format
        //$xml = $twitter->getPublicTimeline();
        //$xml = $twitter->getFriendsTimeline();
        $xml = $twitter->getUserTimeline();

        //$twitterStatus = new SimpleXMLElement($xml);

        //DESCOMENTAR ESTA LINEA QUE SIGUE LIDIA	*/

        $response = simplexml_load_string($query->responseText);		

        $statuses = $response->xpath( '//status' );
        foreach ( $response->status as $status )
        {
            $element = array( );
            //$element["text"] = (string)$status->text;
            $element["text"] = $this->parse_twitter( (string)$status->text );
            $element["id"] = (string)$status->id;
            $element["source"] = (string)$status->source;
            $element["timestamp"] = strtotime( $status->created_at );
            $user = $status->user;
            $element["user_screen_name"] = (string)$user->screen_name;
            $element["user_full_name"] = (string)$user->name;
            $element["user_profile_image_url"] = (string)$user->profile_image_url;
            $result[] = $element;
        }



        return array( "result" => $result );

    }
    
    function getTweetCount( $url )
    {
    	$content = file_get_contents("http://api.tweetmeme.com/url_info?url=".$url);
		$element = new SimpleXmlElement($content);
		$tweets = $element->story->url_count;
 		return array( 'result' => $tweets );    	
    }
    
    function parse_twitter($t) {
	// link URLs
	$t = " ".preg_replace( "/(([[:alnum:]]+:\/\/)|www\.)([^[:space:]]*)".
		"([[:alnum:]#?\/&=])/i", "<a href=\"\\1\\3\\4\" target=\"_blank\">".
		"\\1\\3\\4</a>", $t);

	// link mailtos
	$t = preg_replace( "/(([a-z0-9_]|\\-|\\.)+@([^[:space:]]*)".
		"([[:alnum:]-]))/i", "<a href=\"mailto:\\1\">\\1</a>", $t);

	//link twitter users
	$t = preg_replace( "/ +@([a-z0-9_]*) ?/i", " <a href=\"http://twitter.com/\\1\" target=\"_blank\">@\\1</a> ", $t);

	//link twitter arguments
	$t = preg_replace( "/ +#([a-z0-9_]*) ?/i", " <a href=\"http://twitter.com/search?q=%23\\1\" target=\"_blank\">#\\1</a> ", $t);

	// truncates long urls that can cause display problems (optional)
	$t = preg_replace("/>(([[:alnum:]]+:\/\/)|www\.)([^[:space:]]".
		"{30,40})([^[:space:]]*)([^[:space:]]{10,20})([[:alnum:]#?\/&=])".
		"</", ">\\3...\\5\\6<", $t);
	return trim($t);
	}
    
    
    function getSearch( $q )
    {
    	$search = new TwitterSearch($q);
		$query = $search->rpp(4)->results();
		$results = array();
		foreach( $query as $item )
		{
			$el = array();
			foreach( $item as $index => $value )
			{
				$el[$index] = $value;
				
			}
			
			$date = strtotime( $el["created_at"] );		
			$el['created_at'] = $date;
			$el['text'] = $this->parse_twitter( $el['text'] );
			//$el['source'] = $this->parse_twitter( $el['source'] );
			$el['source'] = htmlspecialchars_decode( $el['source'] );
			$results[] = $el;
			
		}

		return array( 'result' => $results  );   	
    }
}
?>
