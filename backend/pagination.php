<?php

    include_once('../database/database.php');

    if(isset($_POST["query"]))
    {

    	$data = array();

    	$limit = 5;

    	$page = 1;

    	if($_POST["page"] > 1)
    	{
    		$start = (($_POST["page"] - 1) * $limit);

    		$page = $_POST["page"];
    	}

    	else
    	{
    		$start = 0;
    	}
        
    	$query = "SELECT id, title, topic, end_year, sector, swot, pestle, city, country, region, published FROM `table 1` ORDER BY id ASC";
		
        $statement1 = $conn->prepare($query);
        $statement1->execute();
		$result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
        
		$total_data = $statement1->rowCount();
        
        $filter_query = $query . ' LIMIT ' . $start . ', ' . $limit . '';
    
        $statement2 = $conn->prepare($filter_query);	
        $statement2->execute();
    	
        while ($row = $statement2->fetch(PDO::FETCH_ASSOC))
    	{
            $buttonHtml =   "<button type='button' data-val='{$row['id']}' class='btn btn-primary' id='viewTableButton' data-bs-toggle='modal' data-bs-target='#viewTable'>
                                <i class='fa-regular fa-eye' style='font-size: 15px;'></i>View
                            </button>";
    		$data[] = array(
				'id'        =>  $row['id'],
    			'title' 	=>	$row['title'],
    			'topic'	    =>	$row['topic'],
    			'year'		=>	$row['end_year'],
                'sector'    =>  $row['sector'],
				'swot'      =>  $row['swot'],
				'pestle'	=>  $row['pestle'],
				'city'		=>  $row['city'],
				'country'	=>  $row['country'],
				'region'	=>  $row['region'],
                'published' =>  $row['published'],
                'view'      =>  $buttonHtml
    		);
    	}

    	$pagination_html = '
    	<div align="center">
      		<ul class="pagination">
    	';

    	$total_links = ceil($total_data/$limit);

    	$previous_link = '';

    	$next_link = '';

    	$page_link = '';

    	if($total_links > 4)
    	{
    		if($page < 5)
    		{
    			for($count = 1; $count <= 5; $count++)
    			{
    				$page_array[] = $count;
    			}
    			$page_array[] = '...';
    			$page_array[] = $total_links;
    		}
    		else
    		{
    			$end_limit = $total_links - 5;

    			if($page > $end_limit)
    			{
    				$page_array[] = 1;

    				$page_array[] = '...';

    				for($count = $end_limit; $count <= $total_links; $count++)
    				{
    					$page_array[] = $count;
    				}
    			}
    			else
    			{
    				$page_array[] = 1;

    				$page_array[] = '...';

    				for($count = $page - 1; $count <= $page + 1; $count++)
    				{
    					$page_array[] = $count;
    				}

    				$page_array[] = '...';

    				$page_array[] = $total_links;
    			}
    		}
    	}
    	else
    	{
    		for($count = 1; $count <= $total_links; $count++)
    		{
    			$page_array[] = $count;
    		}
    	}

    	for($count = 0; $count < count($page_array); $count++)
    	{
    		if($page == $page_array[$count])
    		{
    			$page_link .= '
    			<li class="page-item active">
    	      		<a class="page-link" href="#">'.$page_array[$count].' <span class="sr-only">(current)</span></a>
    	    	</li>
    			';

    			$previous_id = $page_array[$count] - 1;

    			if($previous_id > 0)
    			{
    				$previous_link = '<li class="page-item"><a class="page-link" href="javascript:load_data(`'.$_POST["query"].'`, '.$previous_id.')">Previous</a></li>';
    			}
    			else
    			{
    				$previous_link = '
    				<li class="page-item disabled">
    			        <a class="page-link" href="#">Previous</a>
    			    </li>
    				';
    			}

    			$next_id = $page_array[$count] + 1;

    			if($next_id >= $total_links)
    			{
    				$next_link = '
    				<li class="page-item disabled">
    	        		<a class="page-link" href="#">Next</a>
    	      		</li>
    				';
    			}
    			else
    			{
    				$next_link = '
    				<li class="page-item"><a class="page-link" href="javascript:load_data(`'.$_POST["query"].'`, '.$next_id.')">Next</a></li>
    				';
    			}

    		}
    		else
    		{
    			if($page_array[$count] == '...')
    			{
    				$page_link .= '
    				<li class="page-item disabled">
    	          		<a class="page-link" href="#">...</a>
    	      		</li>
    				';
    			}
    			else
    			{
    				$page_link .= '
    				<li class="page-item">
    					<a class="page-link" href="javascript:load_data(`'.$_POST["query"].'`, '.$page_array[$count].')">'.$page_array[$count].'</a>
    				</li>
    				';
    			}
    		}
    	}

    	$pagination_html .= $previous_link . $page_link . $next_link;


    	$pagination_html .= '
    		</ul>
    	</div>
    	';

    	$output = array(
    		'data'				=>	$data,
    		'pagination'		=>	$pagination_html,
    		'total_data'		=>	$total_data
    	);

    	echo json_encode($output);

    }

?>
