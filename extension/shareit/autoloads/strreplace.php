<?php 
class shareItOperators
{
    /**
     * Constructor
     * 
     */
    function __construct()
    {
    }
    
	/**
     * Return an array with the template operator name.
     * 
     * @return array
     */
    public function operatorList()
    {
        return array( 'shareit_replace' );
    }
    
	/**
     * Return true to tell the template engine that the parameter list exists per operator type,
     * this is needed for operator classes that have multiple operators.
     * 
     * @return bool
     */
    function namedParameterPerOperator()
    {
        return true;
    }
    
	/**
     * Returns an array of named parameters, this allows for easier retrieval
     * of operator parameters. This also requires the function modify() has an extra
     * parameter called $namedParameters.
     * 
     * @return array
     */
    public function namedParameterList()
    {
        return array( 'shareit_replace' => array( 'search' => array( 'type' => 'string',
                                                                'required' => true,
                                                                'default' => '' ),
                                             'replace' => array( 'type' => 'string',
                                                               'required' => false,
                                                               'default' => '' ),
                                             'subject' => array( 'type' => 'string',
                                                                'required' => false,
                                                                'default' => '' ) ) );
    }
    
    /*!
     Executes the needed operator(s).
     Checks operator names, and calls the appropriate functions.
    */
    public function modify( $tpl, $operatorName, $operatorParameters, $rootNamespace, $currentNamespace, &$operatorValue, $namedParameters )
    {
        switch ( $operatorName )
        {
            case 'shareit_replace':
            {
                $operatorValue = $this->ezstr_replace( $namedParameters['search'], 
                                                        $namedParameters['replace'], 
                                                        $namedParameters['subject']);
            } break;
        }    
    }

    function ezstr_replace( $search, $replace, $subject  )
    {     	
        return str_replace( $search, $replace, $subject  );
    }

    /// \privatesection
    var $Operators;
}    
