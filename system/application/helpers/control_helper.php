<?php

/* Using these function requires an appropraite stylesheet */
if ( ! function_exists('rounded_box_open'))
{
	function rounded_box_open()
	{
		return '<b class="roundedBox">
						<b class="roundedBox1"><b></b></b>
						<b class="roundedBox2"><b></b></b>
						<b class="roundedBox3"></b>
						<b class="roundedBox4"></b>
						<b class="roundedBox5"></b>
					</b>
					<div class="roundedBoxfg">';
	}
}

if ( ! function_exists('rounded_box_close'))
{
	function rounded_box_close()
	{
		return '</div>
					<b class="roundedBox">
						<b class="roundedBox5"></b>
						<b class="roundedBox4"></b>
						<b class="roundedBox3"></b>
						<b class="roundedBox2"><b></b></b>
						<b class="roundedBox1"><b></b></b>
					</b>';
	}
}

if ( ! function_exists('rounded_box_open_yellow'))
{
	function rounded_box_open_yellow()
	{
		return '<b class="roundedBox_yellow">
						<b class="roundedBox1_yellow"><b></b></b>
						<b class="roundedBox2_yellow"><b></b></b>
						<b class="roundedBox3_yellow"></b>
						<b class="roundedBox4_yellow"></b>
						<b class="roundedBox5_yellow"></b>
					</b>
					<div class="roundedBoxfg_yellow">';
	}
}

if ( ! function_exists('rounded_box_close_yellow'))
{
	function rounded_box_close_yellow()
	{
		return '</div>
					<b class="roundedBox_yellow">
						<b class="roundedBox5_yellow"></b>
						<b class="roundedBox4_yellow"></b>
						<b class="roundedBox3_yellow"></b>
						<b class="roundedBox2_yellow"><b></b></b>
						<b class="roundedBox1_yellow"><b></b></b>
					</b>';
	}
}

/* Rounded box red */
if ( ! function_exists('rounded_box_open_red'))
{
	function rounded_box_open_red()
	{
		return '<b class="roundedBox_red">
						<b class="roundedBox1_red"><b></b></b>
						<b class="roundedBox2_red"><b></b></b>
						<b class="roundedBox3_red"></b>
						<b class="roundedBox4_red"></b>
						<b class="roundedBox5_red"></b>
					</b>
					<div class="roundedBoxfg_red">';
	}
}

if ( ! function_exists('rounded_box_close_red'))
{
	function rounded_box_close_red()
	{
		return '</div>
					<b class="roundedBox_red">
						<b class="roundedBox5_red"></b>
						<b class="roundedBox4_red"></b>
						<b class="roundedBox3_red"></b>
						<b class="roundedBox2_red"><b></b></b>
						<b class="roundedBox1_red"><b></b></b>
					</b>';
	}
}
/* End rounded red */
if ( ! function_exists('notification'))
{
	function notification( $id, $message, $is_warning = false, $show_dismiss = true )
	{
		$code = "
				<div id=\"$id\" class=\"notification\">
				". ($is_warning ? rounded_box_open_red() : rounded_box_open_yellow()) ."
					<div style=\"float:left; " . ( $show_dismiss ? "width: 900px;" : "" ) . "\">$message</div>
					" . ( $show_dismiss ? "<div style=\"float:right;cursor:pointer;\" id=\"$id-dismiss\">Dismiss</div>" : "" ) . "
					<div class=\"clear\"></div>
				". ($is_warning ? rounded_box_close_red() : rounded_box_close_yellow()) ."
				</div>
				<br/>";
		
		if( $show_dismiss )
		{
			$code .= "<script type=\"text/javascript\">
						Event.observe('$id-dismiss', 'click', function() {
							Effect.Fade('$id');
						});
					</script>";
		}
		
		return $code;
	}
}

if ( !function_exists('generate_toolip') )
{
	function generate_tooltip( $markup, $tip, $tooltips_enabled = true, $enable_highlight = true )
	{
		if( $tooltips_enabled )
		{
			$code = "<span " . ($enable_highlight ? "style=\"color:lightyellow;\"" : "") . "class=\"tt\">$markup<span>$tip</span></span>";
		}
		else
		{
			$code = $markup;
		}
		
		echo $code;
	}
}

?>