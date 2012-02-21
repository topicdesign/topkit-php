<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Calendar Config
| -------------------------------------------------------------------------
*/

$config['local_time'] = date_create(NULL, new DateTimeZone(config_item('site_timezone')))->format('u');
$config['start_day'] = 'sunday';
$config['month_type'] = 'long';
$config['day_type'] = 'long';
$config['show_next_prev'] = TRUE;
$config['next_prev_url'] = get_calendar_url();
$config['template'] = '

   {table_open}<table border="0" cellpadding="4" cellspacing="0">{/table_open}

   {heading_row_start}<tr>{/heading_row_start}

   {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
   {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
   {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

   {heading_row_end}</tr>{/heading_row_end}

   {week_row_start}<tr>{/week_row_start}
   {week_day_cell}<td>{week_day}</td>{/week_day_cell}
   {week_row_end}</tr>{/week_row_end}

   {cal_row_start}<tr>{/cal_row_start}
   {cal_cell_start}<td>{/cal_cell_start}

   {cal_cell_content}<span class="day">{day}</span>{content}{/cal_cell_content}
   {cal_cell_content_today}<div class="highlight"><span class="day">{day}</span>{content}</div>{/cal_cell_content_today}

   {cal_cell_no_content}<span class="day">{day}</span>{/cal_cell_no_content}
   {cal_cell_no_content_today}<div class="highlight"><span class="day">{day}</span></div>{/cal_cell_no_content_today}

   {cal_cell_blank}&nbsp;{/cal_cell_blank}

   {cal_cell_end}</td>{/cal_cell_end}
   {cal_row_end}</tr>{/cal_row_end}

   {table_close}</table>{/table_close}
';

/* End of file calendar.php */
/* Location: ./third_party/config/calendar.php */
