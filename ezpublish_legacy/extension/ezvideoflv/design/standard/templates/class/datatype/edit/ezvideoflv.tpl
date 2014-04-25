{**
 * $Id: ezvideoflv.tpl 22 2009-10-04 15:18:33Z dpobel $
 * $HeadURL: http://svn.projects.ez.no/ezvideoflv/ezp4/trunk/ezvideoflv/design/standard/templates/class/datatype/edit/ezvideoflv.tpl $
 *}
<div class="block">
    <label>{'Max file size'|i18n( 'design/standard/class/datatype' )}:</label>
    <input type="text" name="ContentClass_ezvideoflv_max_filesize_{$class_attribute.id}" value="{$class_attribute.data_int1}" size="5" maxlength="5" />&nbsp;MB
</div>
