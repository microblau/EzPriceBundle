<select id="areas" name="areas">
    <option value="-1">En todas las áreas</option>
    
        {def $areas=fetch('content','list', hash('parent_node_id',$avernode.node_id,
                                                'class_filter_type','include',
                                                'class_filter_array',array('folder')
        ))}
        {foreach $areas as $area}
            <option value="{$area.node_id}">{$area.name}</option>
        {/foreach}
    
</select>
