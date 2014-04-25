  
  <div id="header">
            {include uri='design:page_header_logo.tpl'}
            <ul id="headerLinks">
                {if $current_user.is_logged_in}
            	<li class="reset">{$current_user.login} <a href={"user/logout"|ezurl}>Desconectar</a></li>
            	{/if}   
            	<li class="acceso"><a href={"acceso-abonados"|ezurl}>Acceso abonados</a></li>     
                    	
            	<li {if $current_user.is_logged_in|not}class="reset"{/if}><a href="http://espacioclientes.efl.es">Espacio clientes</a></li>
            	<li><a href={"preguntas-frecuentes"|ezurl()}>Preguntas frecuentes</a></li>
            	<li><a href={"colectivos"|ezurl}>Colectivos</a></li>
            	
            	<li><a href={"quienes-somos/grupo-francis-lefebvre"|ezurl}>Quiénes somos</a></li>
            	<li><a href={"contacto"|ezurl}>Contacto</a></li>            
            </ul>       
            
            {def $n_productos = fetch( shop, basket ).items|count}
            <span class="cesta full"><span id="infocesta">Tiene <a href={"basket/basket"|ezurl}>{$n_productos} producto{if ne( $n_productos, 1)}s{/if} en la cesta</a></span></span>
            {undef $n_productos}       
        </div>
