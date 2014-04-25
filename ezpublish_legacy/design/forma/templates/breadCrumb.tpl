			<div id="breadCrumb">
				<!--li><a href={"/"|ezurl}>Inicio</a></li-->
			<ul>
			{def $total = $module_result.path|count()}
			{foreach $module_result.path as $index => $elemento}
			{if and( $index|gt(0), ne($elemento.text,'Formularios') )}

				{if eq($index, $total|sub(1))}
				<li class="reset">{$elemento.text|shorten(54,'[...]')}</li>
				{else}
				<li><a href={$elemento.url_alias|ezurl}>{$elemento.text}</a></li>
				{/if}

			{/if}
			{/foreach}
			</ul>

</div>