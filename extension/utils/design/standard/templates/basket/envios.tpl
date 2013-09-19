{if $error}
    <div class="message-error">
        <h2>{$error}</h2>
    </div>
{/if}

<form name="enviosconfig" action={'basket/envios'|ezurl} method="post">

<div class="context-block">

{* DESIGN: Header START *}<div class="box-header"><div class="box-ml">

<h1 class="context-title">
Configuración gastos de envío.
</h1>

{* DESIGN: Mainline *}<div class="header-mainline"></div>

{* DESIGN: Header END *}</div></div>

{* DESIGN: Content START *}<div class="box-ml"><div class="box-mr"><div class="box-content">

{def $locale_list = fetch( 'content', 'locale_list' )}

<div class="block">

    <table class="list" cellspacing="0">
        <tr>
            <td width="40%">Importe en euros a partir del cual no se aplican gastos de envío</td>
            <td><input type="text" name="shipping_cost_limit" value="{$shipping_cost_limit}" /> Válido para provincias zona 1</td>
        </tr>
        <tr>
            <td>Gastos de envío para zona 1</td>
            <td><input type="text" name="shipping_cost_zone1" value="{$shipping_cost_zone1}" /></td>
        </tr>
        <tr>
            <td>Gastos de envío para zona 2</td>
            <td><input type="text" name="shipping_cost_zone2" value="{$shipping_cost_zone2}" /></td>        
        </tr>
         <tr>
            <td>Provincias Zona 1</td>
            <td>
                <select name="provincias_zona_1" multiple="multiple" size="20">
                    {foreach $provincias as $provincia}
                        <option value="{$provincia}" {if $provincias_zone_1|contains($provincia)}selected="selected"{/if}>{$provincia}</option>
                    {/foreach}
                </select>
            </td>        
        </tr>
        
        <tr>
            <td>Provincias Zona 2</td>
            <td>
                <select name="provincias_zona_2" multiple="multiple" size="20">
                    {foreach $provincias as $provincia}
                        <option value="{$provincia}" {if $provincias_zone_2|contains($provincia)}selected="selected"{/if}>{$provincia}</option>
                    {/foreach}
                </select>
            </td>        
        </tr>

    </table>


</div>


{* DESIGN: Content END *}</div></div></div>

{* Button bar for remove and add currency. *}
<div class="controlbar">

{* DESIGN: Control bar START *}<div class="box-bc"><div class="box-ml">

<div class="block">
    <div class="left">
        
                <input class="button" type="submit" name="StoreChangesButton" value="{'Store changes'|i18n( 'design/admin/shop/editcurrency' )}" title="{'Store changes.'|i18n( 'design/admin/shop/editcurrency' )}" />
            
    </div>

    <div class="break"></div>
</div>
{* DESIGN: Control bar END *}</div></div>

</div>

</div>

</form>
