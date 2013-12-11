<?php
/**
 * File containing the eZDiffEngine class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package lib
 */

/*!
  \class eZDiffEngine ezdiffengine.php
  \abstract
  \ingroup eZDiff
  \brief eZDiff provides an access point the diff system

  The eZDiffEngine class is an abstract class, providing interface and shared code
  for the different available DiffEngine.
*/
class eZDiffEngine
{
    /*!
      This method must be overridden for each implementation of eZDiffEngine. This is the function
      which created the object containing the detected changes in the data set.
    */
    function createDifferenceObject( $fromData, $toData )
    {
    }

    /// \privatesection
    public $DiffMode;
}

?>
