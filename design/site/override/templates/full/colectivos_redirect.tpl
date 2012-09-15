{concat( 'catalogo/sector/', fetch('content', 'node', hash( 'node_id', 166)).name|normalize_path()|explode('_')|implode('-'))|redirect()}
