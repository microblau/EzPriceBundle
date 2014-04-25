  
  <div id="header">
            {include uri='design:page_header_logo.tpl'}
            {*<ul id="headerLinks">
                {if $current_user.is_logged_in}
            	<li class="reset">{$current_user.login} <a href={"user/logout"|ezurl}>Desconectar</a></li>
            	{/if}   
            	<li class="acceso"><a href={"acceso-abonados"|ezurl}>Acceso abonados</a></li>     
                    	
            	<li {if $current_user.is_logged_in|not}class="reset"{/if}><a href="http://espacioclientes.efl.es">Espacio clientes</a></li>
            	<li><a href={"preguntas-frecuentes"|ezurl()}>Preguntas frecuentes</a></li>
            	<li><a href={"colectivos"|ezurl}>Colectivos</a></li>
            	
            	<li><a href={"quienes-somos/grupo-francis-lefebvre"|ezurl}>Quiénes somos</a></li>
            	<li><a href={"contacto"|ezurl}>Contacto</a></li>            
            </ul>*}
            <div id="search">
            {include uri='design:ngsuggest/searchform.tpl'  search_id="s" search_default_value="" search_style="field"}
            </div>
            <div id="sociallinks">
                <ul>
                    <li><a href="https://www.facebook.com/GrupoEFL" target="_blank"><img src={"fb.png"|ezimage} alt="Facebook" /></a></li>
                    <li><a href="https://twitter.com/#!/edicionesfl " target="_blank"><img src={"tw.png"|ezimage} alt="Twitter" /></a></li>
                    <li><a href="http://www.linkedin.com/company/ediciones-francis-lefebvre" target="_blank"><img src={"in.png"|ezimage} alt="LinkedIn" /></a></li>
                    <li><a href="http://www.youtube.com/fmourelle" target="_blank"><img src={"yt.png"|ezimage} alt="YouTube" /></a></li>
                <ul>
            </div>
            
          
        </div>
