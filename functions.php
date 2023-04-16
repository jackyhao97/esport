<?php
	function format_date($date)
	{
		// if(($date == '') || (strlen($date) <> 10))
		// 	return false;
		$reform = substr($date,8,2) . '-' . substr($date,5,2) . '-' . substr($date,0,4);
		return $reform;
	}
  function format_datetime($datetime, $separator='-')
  {
    if (empty($datetime)) return '';
    else
    {
      $result = substr($datetime, 0, 10);
      $datetime = substr($datetime, 10, 6);
      $result = explode($separator, $result);
      $result = $result[2] . $separator . $result[1] . $separator . $result[0] . $datetime;
      return $result;
    }
  }
?>