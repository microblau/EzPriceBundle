<?php
/**
 * File containing the ezpRestErrorController class
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

/**
 * This controller deals with error situations arising in the REST layer.
 */
class ezpRestErrorController extends ezcMvcController
{
    /**
     * Default method, currently used for fatal error handling
     * @return ezcMvcResult
     */
    public function doShow()
    {
        if ( ($this->exception instanceof ezcMvcRouteNotFoundException) || ($this->exception instanceof ezpContentNotFoundException ) )
        {
            // we want to return a 404 to the user
            $result = new ezcMvcResult;
            $result->status = new ezpRestHttpResponse( ezpHttpResponseCodes::NOT_FOUND, "Not Found" );
            return $result;
        }

        else if ( $this->exception instanceof ezpOauthBadRequestException )
        {
            $result = new ezcMvcResult;
            $result->status = new ezpRestOauthErrorStatus( $this->exception->errorType, $this->exception->getMessage() );
            $result->variables['message'] = $this->exception->getMessage();
            return $result;
        }
        else if ( $this->exception instanceof ezpOauthRequiredException )
        {
            $result = new ezcMvcResult;
            $result->status = new ezpOauthRequired( "eZ Publish REST", $this->exception->errorType, $this->exception->getMessage() );
            $result->variables['message'] = $this->exception->getMessage();
            return $result;
        }
        else if ( $this->exception instanceof ezpContentAccessDeniedException )
        {
            $result = new ezcMvcResult;
            $result->variables['message'] = $this->exception->getMessage();
            $result->status = new ezpRestHttpResponse( ezpHttpResponseCodes::FORBIDDEN, $this->exception->getMessage() );
            return $result;
        }
        else if ( $this->exception instanceof ezpRouteMethodNotAllowedException )
        {
            $result = new ezpRestMvcResult;
            $result->status = new ezpRestStatusResponse(
                ezpHttpResponseCodes::METHOD_NOT_ALLOWED,
                $this->exception->getMessage(),
                array( 'Allow' => implode( ', ', $this->exception->getAllowedMethods() ) )
            );
            return $result;
        }

        $result = new ezcMvcResult;
        $result->variables['message'] = $this->exception->getMessage();
        $result->status = new ezpRestHttpResponse( ezpHttpResponseCodes::SERVER_ERROR, $this->exception->getMessage() );
        return $result;
    }
}
?>
