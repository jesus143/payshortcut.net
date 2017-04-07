<?php  

	$itemsPerPage = 5; 
	$page = 1; 
	$totalItems = 10;

    $start = ($page - 1) * $itemsPerPage + 1; 
    $end = $totalItems; 
    if ($itemsPerPage < $totalItems) {
    $end = $itemsPerPage * $page; 
    if ($end > $totalItems) {
        $end = $totalItems;
    }
  } 

  // e.g. "21-30 of 193 items"
  print $start . '-' . $end . ' of ' . $totalItems . ' items'; 
