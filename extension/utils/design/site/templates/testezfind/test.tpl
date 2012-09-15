{*def $defaultSearchFacets = array(hash( 'field', 'producto/cat_buscador','limit', 500 ),hash( 'field', 'producto/area','limit', 500 ),hash( 'field', 'producto/sector','limit', 500 ) ) } 
{def $productos = fetch( 'ezfind', 'search', hash(
				'query', '',
				'class_id', 48,
				'limit', 500,
				'facet', $defaultSearchFacets
) ) *}




{def $productos = fetch( 'ezfind', 'search', hash(
				'query', '',
				'class_id', 48,
				'limit', 500,
				filter, 'producto/area:Fiscal'
                        
                     
             )
) ) }

{$productos.SearchResult|attribute(show)}








{def $search_extras=$productos['SearchExtras']}
{*foreach $defaultSearchFacets as $key => $defaultFacet}
              


                  {def $facetData=$search_extras.facet_fields.$key}
			
                  
                  {foreach $facetData.nameList as $key2 => $facetName}                  
                      
                          {def $activeFacetsCount=sum( $key, 1 )}
                          {def $suffix=$uriSuffix|explode( concat( '&filter[]=', $facetData.queryLimit[$key2]|wash ) )|implode( '' )|explode( concat( '&activeFacets[', $defaultFacet['field'], ':', $defaultFacet['name'], ']=', $facetName ) )|implode( '' )}
			              <li>
			                  <a href={concat( $baseURI, $suffix )|ezurl}>[x]</a> <strong>{$defaultFacet['name']}</strong>: {$facetName}
			              </li>                        
                      
                  {/foreach}
          
{/foreach*}
