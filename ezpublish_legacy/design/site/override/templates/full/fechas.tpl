{def $actual_month = currentdate()|datetime( 'custom', '%m')}		
{def $actual_year = currentdate()|datetime( 'custom', '%Y')}



			<div id="gridWide" class="legal">
								
				<h1>Fechas de edición</h1>
			
				<div class="wrap">
				
					<div class="inner">
						<div class="calendars">
                        	<ul class="listCalendar">
                            	<li class="prevs">
                                	<div class="calendarItem">
										 {def $start = maketime( 0, 0, 0, $actual_month|sub(3), 1, $actual_year)}
									   {def $end = maketime( 0, 0, -1, $actual_month|sub(2), 1, $actual_year)}
									   	{def $fechas = fetch( 'content', 'tree', hash( 'parent_node_id', 61,
									   												  'main_node_only', true(),
									   												  'class_filter_type', 'include',
									   												  'class_filter_array', array( 'producto' ),
									   												  'sort_by', array( 'attribute', true(), 356 ),
									   												  'attribute_filter', array( array( 356, 'between', array( $start, $end ) ) )	
									    ))}
									    {def $days = fetch( 'calendar', 'days', hash( 'fechas', $fechas ))}
									    
                                        {fetch( 'calendar', 'show_month', hash( 
                                    						'year', $actual_year,
                                    						'month', $actual_month|sub(3),
                                    						'days', $days,
                                    						'day_name_length', 0,
                                    						'month_href', '',
                                    						'first_day', 1,
                                    						'pn', array(),
                                    						'type', 2
                                    	))}
                                    </div>
                                    <div class="events">
                                    	<h2 class="title">{maketime( 0, 0, 0, $actual_month|sub(3), 1, $actual_year)|datetime( 'custom', '%F %Y')|upfirst()}</h2>
                                        <ul>
                                            {foreach $fechas as $fecha}
                                            <li><strong>Día {$fecha.data_map.fecha_aparicion.content.timestamp|datetime('custom', '%j')}:</strong> <a href={$fecha.url_alias|ezurl}>{$fecha.name}</a></li>
                                            {/foreach}
                                        </ul>
                                    </div>
                                    	{undef $start $end $fechas $days}
                                </li>
                                <li class="prevs reset">
                                	<div class="calendarItem">
                                	    {def $start = maketime( 0, 0, 0, $actual_month|sub(2), 1, $actual_year)}
									   {def $end = maketime( 0, 0, -1, $actual_month|sub(1), 1, $actual_year)}
									   	{def $fechas = fetch( 'content', 'tree', hash( 'parent_node_id', 61,
									   												  'main_node_only', true(),
									   												  'class_filter_type', 'include',
									   												  'class_filter_array', array( 'producto' ),
									   												  'sort_by', array( 'attribute', true(), 356 ),
									   												  'attribute_filter', array( array( 356, 'between', array( $start, $end ) ) )	
									    ))}
									    {def $days = fetch( 'calendar', 'days', hash( 'fechas', $fechas ))}
									    
                                        {fetch( 'calendar', 'show_month', hash( 
                                    						'year', $actual_year,
                                    						'month', $actual_month|sub(2),
                                    						'days', $days,
                                    						'day_name_length', 0,
                                    						'month_href', '',
                                    						'first_day', 1,
                                    						'pn', array(),
                                    						'type', 2
                                    	))}
                                    </div>
                                    <div class="events">
                                    	<h2 class="title">{maketime( 0, 0, 0, $actual_month|sub(2), 1, $actual_year)|datetime( 'custom', '%F %Y')|upfirst()}</h2>
                                        <ul>
                                            {foreach $fechas as $fecha}
                                            <li><strong>Día {$fecha.data_map.fecha_aparicion.content.timestamp|datetime('custom', '%j')}:</strong> <a href={$fecha.url_alias}>{$fecha.name}</a></li>
                                            {/foreach}
                                        </ul>
                                    </div>
                                    	{undef $start $end $fechas $days}
                                </li>
                                <li class="prevs">
                                	<div class="calendarItem">
                                	   {def $start = maketime( 0, 0, 0, $actual_month|sub(1), 1, $actual_year)}
									   {def $end = maketime( 0, 0, -1, $actual_month|sub(0), 1, $actual_year)}
									   	{def $fechas = fetch( 'content', 'tree', hash( 'parent_node_id', 61,
									   												  'main_node_only', true(),
									   												  'class_filter_type', 'include',
									   												  'class_filter_array', array( 'producto' ),
									   												  'sort_by', array( 'attribute', true(), 356 ),
									   												  'attribute_filter', array( array( 356, 'between', array( $start, $end ) ) )	
									    ))}
									    {def $days = fetch( 'calendar', 'days', hash( 'fechas', $fechas ))}
									    
                                        {fetch( 'calendar', 'show_month', hash( 
                                    						'year', $actual_year,
                                    						'month', $actual_month|sub(1),
                                    						'days', $days,
                                    						'day_name_length', 0,
                                    						'month_href', '',
                                    						'first_day', 1,
                                    						'pn', array(),
                                    						'type', 2
                                    	))}
                                    </div>
                                    <div class="events">
                                    	<h2 class="title">{maketime( 0, 0, 0, $actual_month|sub(1), 1, $actual_year)|datetime( 'custom', '%F %Y')|upfirst()}</h2>
                                        <ul>
                                            {foreach $fechas as $fecha}
                                            <li><strong>Día {$fecha.data_map.fecha_aparicion.content.timestamp|datetime('custom', '%j')}:</strong> <a href={$fecha.url_alias}>{$fecha.name}</a></li>
                                            {/foreach}
                                        </ul>
                                    </div>
                                    	{undef $start $end $fechas $days}
                                </li>
                                <li class="actual reset">

                                	<div class="calendarItem">
                                       {def $start = maketime( 0, 0, 0, $actual_month|sub(0), 1, $actual_year)}
									   {def $end = maketime( 0, 0, -1, $actual_month|sum(1), 1, $actual_year)}
									   {def $fechas = fetch( 'content', 'tree', hash( 'parent_node_id', 61,
									   												  'main_node_only', true(),
									   												  'class_filter_type', 'include',
									   												  'class_filter_array', array( 'producto' ),
									   												  'sort_by', array( 'attribute', true(), 356 ),
									   												  'attribute_filter', array( array( 356, 'between', array( $start, $end ) ) )	
									    ))}
									    {def $days = fetch( 'calendar', 'days', hash( 'fechas', $fechas ))}
									    
									   
                                    	{fetch( 'calendar', 'show_month', hash( 
                                    						'year', $actual_year,
                                    						'month', $actual_month,
                                    						'days', $days,
                                    						'day_name_length', 0,
                                    						'month_href', '',
                                    						'first_day', 1,
                                    						'pn', array(),
                                    						'type', 2
                                    	))}
                                    </div>
                                    <div class="events">
                                    	<h2 class="title">{maketime( 0, 0, 0, $actual_month, 1, $actual_year)|datetime( 'custom', '%F %Y')|upfirst()}</h2>
                                        <ul>
                                        	{foreach $fechas as $fecha}
                                            <li><strong>Día {$fecha.data_map.fecha_aparicion.content.timestamp|datetime('custom', '%j')}:</strong> <a href={$fecha.url_alias|ezurl}>{$fecha.name}</a></li>
                                            {/foreach}    
                                        </ul>

                                    </div>
                                    	{undef $start $end $fechas $days}
                                </li>
                                <li class="nexts">
                                	<div class="calendarItem">
                                		  {def $start = maketime( 0, 0, 0, $actual_month|sum(1), 1, $actual_year)}
									   {def $end = maketime( 0, 0, -1, $actual_month|sum(2), 1, $actual_year)}
									  	{def $fechas = fetch( 'content', 'tree', hash( 'parent_node_id', 61,
									   												  'class_filter_type', 'include',
									   												  'class_filter_array', array( 'producto' ),
									   												  'sort_by', array( 'attribute', true(), 356 ),
									   												  'attribute_filter', array( array( 356, 'between', array( $start, $end ) ) )	
									    ))}
									      {def $days = fetch( 'calendar', 'days', hash( 'fechas', $fechas ))}
                                       {fetch( 'calendar', 'show_month', hash( 
                                    						'year', $actual_year,
                                    						'month', $actual_month|sum(1),
                                    						'days', $days,
                                    						'day_name_length', 0,
                                    						'month_href', '',
                                    						'first_day', 1,
                                    						'pn', array(),
                                    						'type', 2
                                    	))}
                                    </div>

                                    <div class="events">
                                    	<h2 class="title">{maketime( 0, 0, 0, $actual_month|sum(1), 1, $actual_year)|datetime( 'custom', '%F %Y')|upfirst()}</h2>
                                        <ul>
                                            {foreach $fechas as $fecha}
                                            <li><strong>Día {$fecha.data_map.fecha_aparicion.content.timestamp|datetime('custom', '%j')}:</strong> <a href={$fecha.url_alias}>{$fecha.name}</a></li>
                                            {/foreach}                                           
                                        </ul>
                                    </div>
                                    {undef $start $end $days $fechas}
                                </li>
                                <li class="nexts reset">
                                	<div class="calendarItem">
                                	   {def $start = maketime( 0, 0, 0, $actual_month|sum(2), 1, $actual_year)}
									   {def $end = maketime( 0, 0, -1, $actual_month|sum(3), 1, $actual_year)}
									  
  								       {def $fechas = fetch( 'content', 'tree', hash( 'parent_node_id', 61,
									   												  'class_filter_type', 'include',
									   												  'main_node_only', true(),
									   												  'class_filter_array', array( 'producto' ),
									   												  'sort_by', array( 'attribute', true(), 356 ),
									   												  'attribute_filter', array( array( 356, 'between', array( $start, $end ) ) )	
									    ))}
									    {def $days = fetch( 'calendar', 'days', hash( 'fechas', $fechas ))}
									    
                                        {fetch( 'calendar', 'show_month', hash( 
                                    						'year', $actual_year,
                                    						'month', $actual_month|sum(2),
                                    						'days', $days,
                                    						'day_name_length', 0,
                                    						'month_href', '',
                                    						'first_day', 1,
                                    						'pn', array(),
                                    						'type', 2
                                    	))}
                                    	 {undef $start $end $days}
                                    </div>
                                    <div class="events">
                                    	<h2 class="title">{maketime( 0, 0, 0, $actual_month|sum(2), 1, $actual_year)|datetime( 'custom', '%F %Y')|upfirst()}</h2>
                                        <ul>
                                        	{foreach $fechas as $fecha}
                                            <li><strong>Día {$fecha.data_map.fecha_aparicion.content.timestamp|datetime('custom', '%j')}:</strong> <a href={$fecha.url_alias}>{$fecha.name}</a></li>
                                            {/foreach}
                                        </ul>
                                    </div>
                                    {undef $fechas}
                                </li>
                                
                            
                            </ul>

                            
                        </div>
						
					</div>
				
				</div>
			
			
			</div>
				
