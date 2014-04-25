<?php
// SOFTWARE NAME: Noven Utils
// SOFTWARE RELEASE: 1.0
// COPYRIGHT NOTICE: Copyright (C) 1999-2009 Noven
// SOFTWARE LICENSE: GNU General Public License v2.0
// NOTICE: >
//   This program is free software; you can redistribute it and/or
//   modify it under the terms of version 2.0  of the GNU General
//   Public License as published by the Free Software Foundation.
//
//   This program is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU General Public License for more details.
//
//   You should have received a copy of version 2.0 of the GNU General
//   Public License along with this program; if not, write to the Free
//   Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
//   MA 02110-1301, USA.
/**
 * String process operators
 *
 * @author Jerome Vieilledent
 * @since 2008/05/19
 */
class NovenStringUtilities
{
	
	/*!
      Constructor
    */
    public function __construct()
    {
    	
    }

    /*!
     	Return an array with the template operator name.
    */
    public function operatorList()
    {
        return array( 'escape_as_entities', 'shorten_to_last_word', 'split_words_in_parts' );
    }
    /*!
     \return true to tell the template engine that the parameter list exists per operator type,
             this is needed for operator classes that have multiple operators.
    */
    public function namedParameterPerOperator()
    {
        return true;
    }    
    
	/*!
     See eZTemplateOperator::namedParameterList
    */
    public function namedParameterList()
    {
        return array(                      
                      'shorten_to_last_word' => array('length' => array( 'type' => 'integer',
                                                                    	'required' => true,
                                                                     	'default' => 0 )
                                            ),
                      'split_words_in_parts' => array('length' => array( 'type' => 'integer',
                                                                    	'required' => true,
                                                                     	'default' => 0 ),
                      'escape_as_entities'	=> array()
                                            ) );
    }
    
    /*!
     Executes the operator
    */
    public function modify( &$tpl, &$operatorName, &$operatorParameters, &$rootNamespace, &$currentNamespace, &$operatorValue, &$namedParameters )
    {
        
        switch ( $operatorName )
        {
            case 'escape_as_entities':
                $operatorValue = $this->escape($operatorValue);
				break;
				
            case 'shorten_to_last_word':
            	$operatorValue = $this->shortenToLastWord($operatorValue, $namedParameters['length']);
            	break;
            	
            case 'split_words_in_parts':
            	$operatorValue = $this->splitWordsInParts($operatorValue, $namedParameters['length']);
            	break;
        }
    }
    
    /**
     * Does an htmlentities on the string, taking the charset used into account
     *
     * @param string $string
     * @return string
     */
    private function escape($string)
    {
    	$charset = strtoupper(eZTextCodec::internalCharset());
    	$convertedString = htmlentities($string, ENT_COMPAT, $charset);
    	return $convertedString;
    }
    
    /**
     * Cuts a string to $length characters and then cuts at the end of the last word
     *
     * @param string $string
     * @param int $length
     * @return string
     */
    public function shortenToLastWord($string, $length)
    {
    	if (strlen($string) > $length)
    	{
	    	$shortenString = substr($string, 0, $length);
	    	$posDernierEspace = strrpos($shortenString, ' ');
	    	// On verifie si on a trouve un espace
	    	if ($posDernierEspace !== false)
	    		$shortenString = substr($shortenString, 0, $posDernierEspace).'...';
    	}
    	else
    	{
    		$shortenString = $string;
    	}
    	
    	return $shortenString;
    }
    
    /**
     * Splits too long words and adds one or more caesura character(s)
     *
     * @param string $string Input string
     * @param int $length Max length of a word
     * @param string $wordSeparator Caesura character. Default is '-'
     * @return string
     */
    private function splitWordsInParts($string, $length, $wordSeparator='-')
    {
    	$string = self::charsetInputFilter($string);
    	$aString = explode(' ', $string); // On splitte la chaine par les espaces et on insere les mots dans un tableau
    	for($i=0, $iMax=count($aString); $i<$iMax; ++$i)
    	{
    		$currentLength = strlen($aString[$i]);
    		if($currentLength > $length)
    		{
    			$diviseur = 2; // Par defaut on divise le mot par 2
    			$cesure = floor($currentLength / $diviseur); // Combien de caracteres cela donne ?
    			while($cesure > $length) // Tant que le nb de caracteres est sup. a la longueur attendue, on incrémente le diviseur de 1
    			{
    				$diviseur++;
	    			$cesure = floor($currentLength / $diviseur);
    			}
    			
    			
    			$finalCurrentString = '';
    			$curCesure = 0;
    			while($curCesure < $diviseur) // On boucle pour rajouter les separateurs
    			{
    				$len = ($curCesure+1) < $diviseur ? $cesure : $currentLength; // Si on est sur la derniere partie du mot, on s'assure d'avoir la bonne longueur en prenant celle du mot
    				$str = substr($aString[$i], $curCesure*$cesure, $len);
    				$curCesure++;
    				
    				// Si la cesure courante est inf. au diviseur, on ajoute le separateur.
    				if($curCesure < $diviseur)
    					$finalCurrentString .= $str.$wordSeparator;
    				else
    					$finalCurrentString .= $str;
    			}
    			
    			$aString[$i] = $finalCurrentString;
    		}
    	}
    	
    	$returnString = implode(' ', $aString);
    	return self::charsetOutputFilter($returnString);
    }
    
    /**
     * Detects charset and transcodes in ISO if necessary, in order to be able to work with PHP string functions and utf8
     *
     * @param string $string
     * @return string
     */
    public static function charsetInputFilter($string)
    {
    	$encoding = mb_detect_encoding($string);
    	if($encoding == 'UTF-8')
    		$string = utf8_decode($string);
    		
    	return $string;
    }
    
    /**
     * Detects charset and transcodes in utf8 if necessary
     *
     * @param string $string
     * @return string
     */
    public static function charsetOutputFilter($string)
    {
    	$encoding = mb_detect_encoding($string);
    	if($encoding == 'UTF-8')
    		$string = utf8_encode($string);
    		
    	return $string;
    }
}


