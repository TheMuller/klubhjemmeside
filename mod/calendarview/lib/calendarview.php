<?php
/**
 * @package ElggCalendarView
 * Calendar functions
 */

/* Returns HTML code
==========================================================================================================
*/
	error_reporting(E_WARNING);
	$cal_ID = 0;

class CALENDAR {
//========================================================================================================
// Configuration
//========================================================================================================
        var $tFontFace = 'Arial, Helvetica';	// title: font family (CSS-spec, e.g. "Arial, Helvetica")
        var $tFontSize = 14;					// title: font size (pixels)
        var $tFontColor = '#FFFFFF';			// title: font color
        var $tBGColor = '#0E679F';				// title: background color

        var $hFontFace = 'Arial, Helvetica'; 	// heading: font family (CSS-spec, e.g. "Arial, Helvetica")
        var $hFontSize = 12;					// heading: font size (pixels)
        var $hFontColor = '#085283';			// heading: font color
        var $hBGColor = '#A0C9E5';				// heading: background color

        var $dFontFace = 'Arial, Helvetica';	// days: font family (CSS-spec, e.g. "Arial, Helvetica")
        var $dFontSize = 13;					// days: font size (pixels)
        var $dFontColor = '#000000';			// days: font color
        var $dBGColor = '#FFFFFF';				// days: background color

        var $wFontFace = 'Arial, Helvetica';	// weeks: font family (CSS-spec, e.g. "Arial, Helvetica")
        var $wFontSize = 12;					// weeks: font size (pixels)
        var $wFontColor = '#FFFFFF';			// weeks: font color
        var $wBGColor = '#304B90';				// weeks: background color

        var $saFontColor = '#0E679F';			// Saturdays: font color
        var $saBGColor = '#F6F6FF';				// Saturdays: background color

        var $suFontColor = '#0E679F';			// Sundays: font color
        var $suBGColor = '#F6F6FF';				// Sundays: background color

        var $tdBorderColor = 'green';			// today: border color

        var $borderColor = '#304B90';			// border color
        var $hilightColor = '#FFFF00';			// hilight color (works only in combination with link)

        var $link = '';							// page to link to when day is clicked
        var $linkTarget = '';					// link target frame or window, e.g. parent.myFrame
        var $offset = 1;						// week start: 0 - 6 (0 = Saturday, 1 = Sunday, 2 = Monday ...)
        var $weekNumbers = true;				// view week numbers: true = yes, false = no

//--------------------------------------------------------------------------------------------------------
// You should change these variables only if you want to translate them into your language:
//--------------------------------------------------------------------------------------------------------
        // weekdays: must start with Saturday because January 1st of year 1 was a Saturday
        //var $weekdays = array("Saturday", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday");
        var $weekdays = array("Sat", "Sun", "Mon", "Tue", "Wed", "Thu", "Fri");

        // months: must start with January
        var $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

        // error messages
        var $error = array("Year must be 1 - 3999!", "Month must be 1 - 12!");

//--------------------------------------------------------------------------------------------------------
// Don't change from here:
//--------------------------------------------------------------------------------------------------------
        var $year, $month, $size;
        var $mDays = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        var $specDays = array();
        var $specDays2 = array();

//========================================================================================================
// Functions
//========================================================================================================
        function CALENDAR($year = '', $month = '', $week = '') {
                if($year == '' && $month == '') {
                        $year = date('Y');
                        $month = date('n');
                }
                else if($year != '' && $month == '') $month = 1;
                $this->year = (int) $year;
                $this->month = (int) $month;
                $this->week = (int) $week;
                if($this->linkTarget == '') $this->linkTarget = 'document';
        }

        function set_styles() {
                global $cal_ID;

                $cal_ID++;
                $html = '<style> .cssTitle' . $cal_ID . ' { ';
                if($this->tFontFace) $html .= 'font-family: ' . $this->tFontFace . '; ';
                if($this->tFontSize) $html .= 'font-size: ' . $this->tFontSize . 'px; ';
                if($this->tFontColor) $html .= 'color: ' . $this->tFontColor . '; ';
                if($this->tBGColor) $html .= 'background-color: ' . $this->tBGColor . '; ';
                $html .= 'text-align: center; ';
                $html .= 'padding:8px; ';
                $html .= 'border-top: 1px solid #999999; ';
                $html .= 'border-bottom: 1px solid #999999; ';
                $html .= 'border-right: 1px solid #999999; ';
                $html .= '} .cssHeading' . $cal_ID . ' { ';
                if($this->hFontFace) $html .= 'font-family: ' . $this->hFontFace . '; ';
                if($this->hFontSize) $html .= 'font-size: ' . $this->hFontSize . 'px; ';
                if($this->hFontColor) $html .= 'color: ' . $this->hFontColor . '; ';
                if($this->hBGColor) $html .= 'background-color: ' . $this->hBGColor . '; ';
                $html .= 'text-align: center; ';
                $html .= 'padding:3px; ';     
                $html .= 'border-bottom: 1px solid #999999; ';
                $html .= 'border-right: 1px solid #999999; ';
                $html .= 'width:14.28%; ';
                $html .= '} .cssDays' . $cal_ID . ' { ';
                if($this->dFontFace) $html .= 'font-family: ' . $this->dFontFace . '; ';
                if($this->dFontSize) $html .= 'font-size: ' . $this->dFontSize . 'px; ';
                if($this->dFontColor) $html .= 'color: ' . $this->dFontColor . '; ';
                if($this->dBGColor) $html .= 'background-color: ' . $this->dBGColor . '; ';
                $html .= 'text-align: center; ';
                $html .= 'padding: 2px 5px 5px 5px; ';
                $html .= 'border-bottom: 1px solid #999999; ';
                $html .= 'border-right: 1px solid #999999; ';  
                $html .= 'min-height: 40px; height: 40px; ';    
                $html .= '} .cssWeeks' . $cal_ID . ' { ';
                if($this->wFontFace) $html .= 'font-family: ' . $this->wFontFace . '; ';
                if($this->wFontSize) $html .= 'font-size: ' . $this->wFontSize . 'px; ';
                if($this->wFontColor) $html .= 'color: ' . $this->wFontColor . '; ';
                if($this->wBGColor) $html .= 'background-color: ' . $this->wBGColor . '; ';
                $html .= '} .cssSaturdays' . $cal_ID . ' { ';
                if($this->dFontFace) $html .= 'font-family: ' . $this->dFontFace . '; ';
                if($this->dFontSize) $html .= 'font-size: ' . $this->dFontSize . 'px; ';
                if($this->saFontColor) $html .= 'color: ' . $this->saFontColor . '; ';
                if($this->saBGColor) $html .= 'background-color: ' . $this->saBGColor . '; ';
                $html .= 'text-align: center; ';
                $html .= 'padding: 2px 5px 5px 5px; ';
                $html .= 'border-bottom: 1px solid #999999; ';
                $html .= 'border-right: 1px solid #999999; '; 
                $html .= 'min-height: 40px; height: 40px; ';    
                $html .= '} .cssSundays' . $cal_ID . ' { ';
                if($this->dFontFace) $html .= 'font-family: ' . $this->dFontFace . '; ';
                if($this->dFontSize) $html .= 'font-size: ' . $this->dFontSize . 'px; ';
                if($this->suFontColor) $html .= 'color: ' . $this->suFontColor . '; ';
                if($this->suBGColor) $html .= 'background-color: ' . $this->suBGColor . '; ';
                $html .= 'text-align: center; ';
                $html .= 'padding: 2px 5px 5px 5px; ';
                $html .= 'border-bottom: 1px solid #999999; ';
                $html .= 'border-right: 1px solid #999999; ';      
                $html .= 'min-height: 40px; height: 40px; ';      
                $html .= '} .cssHilight' . $cal_ID . ' { ';
                if($this->dFontFace) $html .= 'font-family: ' . $this->dFontFace . '; ';
                if($this->dFontSize) $html .= 'font-size: ' . $this->dFontSize . 'px; ';
                if($this->dFontColor) $html .= 'color: ' . $this->dFontColor . '; ';
                if($this->hilightColor) $html .= 'background-color: ' . $this->hilightColor . '; ';
                $html .= 'cursor: default; ';
                $html .= '} </style>';

                return $html;
        }

        function leap_year($year) {
                return (!($year % 4) && ($year < 1582 || $year % 100 || !($year % 400))) ? true : false;
        }

        function get_weekday($year, $days) {
                $a = $days;
                if($year) $a += ($year - 1) * 365;
                for($i = 1; $i < $year; $i++) if($this->leap_year($i)) $a++;
                if($year > 1582 || ($year == 1582 && $days > 277)) $a -= 10;
                if($a) $a = ($a - $this->offset) % 7;
                else if($this->offset) $a += 7 - $this->offset;

                return $a;
        }

        function get_week($year, $days) {
                $firstWDay = $this->get_weekday($year, 0);
                if($year == 1582 && $days > 277) $days -= 10;

                return floor(($days + $firstWDay) / 7) + ($firstWDay <= 3);
        }

        function table_cell($content, $class, $date = '', $style = '') {
                global $cal_ID;

                $size = round($this->size * 1.5);
                $html = '<td align=center width=' . $size . ' class="' . $class . '"';

                if($content != '&nbsp;' && stristr($class, 'day')) {
                        $link = $this->link;
                        $events = array();
                        $bgColor = '';
                        
                        if(is_array($this->specDays[$content])) {
                                foreach($this->specDays[$content] as $arr) {
                                        if($arr[0]) $bgColor = $arr[0];
                                        if($arr[1]) {   
                                            $onmouseover = $arr[3];
                                            if($arr[2]) $events[] = '<a target=\'_parent\' href=\''.$arr[2].'\' title=\''.$onmouseover.'\'>'.$arr[1].'</a><br />';
                                            else $events[] = $arr[1].'<br />';
                                        }
                                        //if($arr[2]) $link = $arr[2];
                                }
                                $xxx .= join(' ', $events);
                                if($bgColor) $style .= 'background-color:' . $bgColor . ';';
                        }
/*                        
                        if($link) {
                                $link .= strstr($link, '?') ? "&date=$date" : "?date=$date";
                                $html .= ' onMouseOver="this.className=\'cssHilight' . $cal_ID . '\'"';
                                $html .= ' onMouseOut="this.className=\'' . $class . '\'"';
                                $html .= ' onClick="' . $this->linkTarget . '.location.href=\'' . $link . '\'"';
                        }       
 * 
 */                 
/*
                        if(is_array($this->specDays[$content])) {
                                foreach($this->specDays[$content] as $arr) {
                                        if($arr[0]) $bgColor = $arr[0];
                                        if($arr[1]) $events[] = $arr[1];
                                        if($arr[2]) $link = $arr[2];
                                }
                                $html .= ' title="' . join(' &middot; ', $events) . '"';
                                if($bgColor) $style .= 'background-color:' . $bgColor . ';';
                        }
                        if($link) {
                                $link .= strstr($link, '?') ? "&date=$date" : "?date=$date";
                                $html .= ' onMouseOver="this.className=\'cssHilight' . $cal_ID . '\'"';
                                $html .= ' onMouseOut="this.className=\'' . $class . '\'"';
                                $html .= ' onClick="' . $this->linkTarget . '.location.href=\'' . $link . '\'"';
                        }
 * 
 */
                }
                if($style) $html .= ' style="' . $style . '"';
                $html .= '>' . $content . '<br />'.$xxx. '</td>';

                return $html;
        }

        function table_head($content) {
                global $cal_ID;

                $cols = $this->weekNumbers ? 8 : 7;
                $html = '<tr><td colspan=' . $cols . ' class="cssTitle' . $cal_ID . '" align=center><b>' .
                                $content . '</b></td></tr><tr>';
                for($i = 0; $i < count($this->weekdays); $i++) {
                        $ind = ($i + $this->offset) % 7;
                        $wDay = $this->weekdays[$ind];
                        $html .= $this->table_cell($wDay, 'cssHeading' . $cal_ID);
                }
                if($this->weekNumbers) $html .= $this->table_cell('&nbsp;', 'cssHeading' . $cal_ID);
                $html .= '</tr>';

                return $html;
        }

        function viewEvent($from, $to, $color, $title, $link = '', $onmouseover = '') {
                if($from > $to) return;
                if($from < 1 || $from > 31) return;
                if($to < 1 || $to > 31) return;

                while($from <= $to) {
                        if(!$this->specDays[$from]) $this->specDays[$from] = array();
                        $this->specDays[$from][] = array($color, $title, $link, $onmouseover);
                        $from++;
                }
        }

        function viewEventEach($weekday, $color, $title, $link = '') {
                if($weekday < 0 || $weekday > 6) return;
                if(!$this->specDays2[$weekday]) $this->specDays2[$weekday] = array();
                $this->specDays2[$weekday][] = array($color, $title, $link);
        }

        function create() {
                global $cal_ID;

                $this->size = ($this->hFontSize > $this->dFontSize) ? $this->hFontSize : $this->dFontSize;
                if($this->wFontSize > $this->size) $this->size = $this->wFontSize;

                list($curYear, $curMonth, $curDay) = explode('-', date('Y-m-d'));

                if($this->year < 1 || $this->year > 3999) $html = '<b>' . $this->error[0] . '</b>';
                else if($this->month < 1 || $this->month > 12) $html = '<b>' . $this->error[1] . '</b>';
                else {
                        $this->mDays[1] = $this->leap_year($this->year) ? 29 : 28;
                        for($i = $days = 0; $i < $this->month - 1; $i++) $days += $this->mDays[$i];

                        $start = $this->get_weekday($this->year, $days);
                        $stop = $this->mDays[$this->month-1];

                        $html = $this->set_styles();
                        $html .= '<table border=0 cellspacing=0 cellpadding=0 class="calendar" width="100%"><tr>';
                        $html .= '<td' . ($this->borderColor ? ' bgcolor=' . $this->borderColor	: '') . '>';
                        $html .= '<table border=0 cellspacing="1" cellpadding="3" width="100%">';
                        $title = htmlentities($this->months[$this->month-1]) . ' ' . $this->year;
                        $html .= $this->table_head($title);
                        $daycount = 1;

                        if(($this->year == $curYear) && ($this->month == $curMonth)) $inThisMonth = true;
                        else $inThisMonth = false;

                        if($this->weekNumbers || $this->week) $weekNr = $this->get_week($this->year, $days);

                        for($i = 0; $i <= $this->mDays[$this->month-1]; $i++) {
                                foreach($this->specDays2 as $j => $arr) {
                                        if($this->get_weekday($this->year, $days + $i) == $j - $this->offset + 1) {
                                                if(!$this->specDays[$i]) $this->specDays[$i] = array();
                                                $this->specDays[$i] = array_merge($this->specDays[$i], $arr);
                                        }
                                }
                        }

                        while($daycount <= $stop) {
                                if($this->week && $this->week != $weekNr) {
                                        $daycount += 7 - ($daycount == 1 ? $start : 0);
                                        $weekNr++;
                                        continue;
                                }
                                $html .= '<tr>';

                                for($i = $wdays = 0; $i <= 6; $i++) {
                                        $ind = ($i + $this->offset) % 7;
                                        if($ind == 0) $class = 'cssSaturdays';
                                        else if($ind == 1) $class = 'cssSundays';
                                        else $class = 'cssDays';

                                        $style = '';
                                        $date = sprintf('%4d-%02d-%02d', $this->year, $this->month, $daycount);

                                        if(($daycount == 1 && $i < $start) || $daycount > $stop) $content = '&nbsp;';
                                        else {
                                                $content = $daycount;
                                                if($inThisMonth && $daycount == $curDay) {
                                                        $style = 'padding:0px;border:3px solid ' . $this->tdBorderColor . ';';
                                                }
                                                else if($this->year == 1582 && $this->month == 10 && $daycount == 4) $daycount = 14;
                                                $daycount++;
                                                $wdays++;
                                        }
                                        $html .= $this->table_cell($content, $class . $cal_ID, $date, $style);
                                }

                                if($this->weekNumbers) {
                                        if(!$weekNr) {
                                                if($this->year == 1) $content = '&nbsp;';
                                                else if($this->year == 1583) $content = 51;
                                                else $content = $this->get_week($this->year - 1, 365);
                                        }
                                        else if($this->month == 12 && $weekNr >= 52 && $wdays < 4) $content = 1;
                                        else $content = $weekNr;

                                        $html .= $this->table_cell($content, 'cssWeeks' . $cal_ID);
                                        $weekNr++;
                                }
                                $html .= '</tr>';
                        }
                        $html .= '</table></td></tr></table>';
                }
                return $html;
        }
}


////////////////////////////// obs obs obs //////////////////////////////
// draws a calendar 
function draw_calendar($month,$year){

	/* draw table */
	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

	/* table headings */
	$headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np">&nbsp;</td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		$calendar.= '<td class="calendar-day">';
			/* add in the day number */
			$calendar.= '<div class="day-number">'.$list_day.'</div>';

			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			$calendar.= str_repeat('<p>&nbsp;</p>',2);
			
		$calendar.= '</td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np">&nbsp;</td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';
	
	/* all done, return result */
	return $calendar;
}


// this function can be used in custom index
function cindex(){

    global $CONFIG;
    if (!isset($CONFIG)) {
            $CONFIG = new stdClass;
    }

    // Extend CSS
    $content .= '<style type="text/css">';
    $content .= '#nav {text-align:right; clear:both; margin: 8px 0 8px;  font-size:90%;}';
    $content .= '#nav input, select {-moz-box-sizing: border-box;border: 1px solid #CCCCCC;border-radius: 3px 3px 3px 3px;  color: #666666;  font: 100% Arial,Helvetica,sans-serif; font-size:90%;  padding: 2px; margin-left: 4px;}';
    $content .= '#nav input { width: 60px;text-align:center; }';
    $content .= '#nav select { width: 110px; }';
    $content .= 'table.calendar  { border-left:1px solid #999; }';
    $content .= 'td.calendar-day, td.calendar-day-np { border-bottom:1px solid #999; border-right:1px solid #999; }';
    $content .= '</style>';

    //
    // set the default timezone to use
    date_default_timezone_set('UTC');

    // Get navigation variables
    $date = get_input('date');
    $year = get_input('year');
    $month = get_input('month');
    // if year is empty, set year to current year:
    if($year == '') $year = date('Y');
    // if month is empty, set month to current month:
    if($month == '') $month = date('n');

    // start calendar
    $offset = 1;  // start with Sunday  
    $cal = new CALENDAR($year, $month);
    $cal->offset = $offset;
    $cal->weekNumbers = $weeks;
    $cal->tFontSize = 20;
    $cal->hFontSize = 13;
    $cal->dFontSize = 12;

    // load list of events with start date and end date
    $options1 = array(
            'type' => 'object',
            'subtype' => 'event_calendar',
            'limit' => 0,
             'metadata_name_value_pairs' => array(
                array('name' => 'end_date',
                   'value' => mktime(0, 0, 0, $month, 1, $year),
                   'operand' => '>='), 
                array('name' => 'start_date',
                   'value' => mktime(0, 0, 0, $month, date('t', mktime(0, 0, 0, $month, 1, $year)), $year),
                   'operand' => '<='),             
            ),
            'metadata_name_value_pairs_operator' => 'AND',
    );
    $eventlist1 = elgg_get_entities_from_metadata($options1);

    // load list of events with only start date
    $options2 = array(
            'type' => 'object',
            'subtype' => 'event_calendar',
            'limit' => 0,
             'metadata_name_value_pairs' => array(
                array('name' => 'start_date',
                   'value' => mktime(0, 0, 0, $month, 1, $year),
                   'operand' => '>='), 
                array('name' => 'start_date',
                   'value' => mktime(0, 0, 0, $month, date('t', mktime(0, 0, 0, $month, 1, $year)), $year),
                   'operand' => '<='),    
                array('name' => 'end_date',
                   'value' => '',
                   'operand' => '='),                 
            ),
            'metadata_name_value_pairs_operator' => 'AND',
    );
    $eventlist2 = elgg_get_entities_from_metadata($options2);

    // merge events
    $all_entities = array_merge($eventlist1, $eventlist2);

    foreach ($all_entities as $v) {
        $event = get_entity($v['guid']);

        // get start and end day
        $edaystart = date('j', $event->start_date);
        $edayend = date('j', $event->end_date);

        // check if only start day
        if (empty($edayend)) $edayend = $edaystart; 

        // bakalia.... add one day to events start and end to show right dates
        //$edaystart = $edaystart +1;
        //$edayend = $edayend +1;

        // check if start day belongs to previous month and if yes set it to 1
        if ($event->start_date < mktime(0, 0, 0, $month, 1, $year)) $edaystart = 1 ;

        // check if end day belongs to next month and if yes set it to last day of month
        if ($event->end_date > mktime(0, 0, 0, $month, date('t', mktime(0, 0, 0, $month, 1, $year)), $year)) $edayend = date('t', mktime(0, 0, 0, $month, 1, $year)) ;

        //build site url
        $elink = $CONFIG->url.'event_calendar/view/'.$v['guid'];

        //build on mouse over message
        $omo = '';
        if (!empty($event->start_time)) $omo .= elgg_echo('calendarview:starttime').': '.$event->start_time;
        if (!empty($event->venue)) {
            if (empty($omo)) $omo .= elgg_echo('calendarview:venue').': '.$event->venue;
            else $omo .= ', '.elgg_echo('calendarview:venue').': '.$event->venue;
        }
        if (empty($omo)) $omo = $event->title;

        // add to calendar
        $cal->viewEvent($edaystart, $edayend, "#f4f9fd", $event->title, $elink, $omo);
        //$content .= $v['title'].' - '.$v['guid'].' - '.$event->start_date.' - '.$event->end_date.'<br />';
    }

    $content .= '<br />';
    $content .= $cal->create();

    // build navigation form
    $content .= '<div id="nav">';
    $content .= '<form action="'.$CONFIG->url.'calendarview/all/'.'" method="post"  target="_parent">';
    $content .= '<input class="cal" type="text" name="year" size="4" maxlength="4" value="'.$year.'">';
    $content .= '<select class="cal" name="month">';
    // build selection (months):
    $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    for($i = 1; $i <= 12; $i++) {
      $content .= '<option value="' . $i . '"';
      if($i == $month) $content .= ' selected';
      $content .= '>' . $months[$i-1] . "</option>\n";
    }
    $content .= '</select>';
    $content .= '<input class="cal" type="submit" value="'.elgg_echo('calendarview:go').'">';
    $content .= '</form>';
    $content .= '</div>';
    // build navigation form end

    $sidebar = '';

    $body = elgg_view_layout('content', array(
            'filter_context' => 'all',
            'content' => $content,
            'title' => $title,
            'sidebar' => $sidebar,
    ));

    return $content;    
    
}
