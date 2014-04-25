<form action={'/content/search/'|ezurl} method="get" id="{$form_id}" name="{$form_id}">
<label for="termino">
{include uri='design:ngsuggest/searchfield.tpl' form_id=$form_id search_id=$search_id search_style="text"}
</label>
<input id="searchbutton" class="btn" name="SearchButton" type="submit" value="Buscar" />
</form>
  