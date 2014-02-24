<?php
/**
 *
 * Gianna js
 *
 */

if (0) { ?><script><?php }

?>

$(document).ready(function() {

	var target = $("#target");

	$("#select-context").multiselect({
		noneSelectedText: "<?php echo elgg_echo("gianna:select:background"); ?>",
		selectedText: '# <?php echo elgg_echo("gianna:select:selected"); ?>',
		checkAllText: "<?php echo elgg_echo("gianna:select:check"); ?>",
		uncheckAllText: "<?php echo elgg_echo("gianna:select:uncheck"); ?>",
		selectedList: 2	  
	})
	
	$("#select-context").multiselect().bind("multiselectclick multiselectcheckall multiselectuncheckall", 
	function( event, ui ){
		var checkedValues = $.map($(this).multiselect("getChecked"), function( input ){			
			return input.value;
		});
		elgg.action('gianna/background', {
			dataType:'json',
			data:{
				selected: checkedValues.join(',')
			}
		});
		if (checkedValues.length) {
			target.addClass("active").html(checkedValues.join(', '));
		} else {
			target.removeClass("active").html("<?php echo elgg_echo("gianna:select:none"); ?>");
		}
	}).triggerHandler("multiselectclick");

});




