<div id="notification">Notifications //animate later? //todo: lines via jsPlumb //restore save function //add subject (take2) //color subjs involved in error</div>

<div id="content">
	<div id="container">
		<!--<p><input type="submit" class="input-button" id="btn-get" value="Get items" /></p>-->
		
		<?php
			foreach($data as $value=>$item){
				$time = explode("-", $value);
				$year = explode("sem", $time[0]);
				$units = 0;
				if($time[1]==3){$time[1]='Summer';}
				echo '<div class="column left">';
				echo '<p class="semheader">Year: ' .$year[1] .' Sem: '.$time[1] .'</p>';
				//do something about the next 5 lines;
				if(isset($item[0])){
					foreach($item as $subject){
						$units = $units + $subject['units'];
					}
				}
				
				echo	'<p class="units" id="unit-'.$value .'">Units: ' .$units .'</p>';
				echo	'<ul class="sortable-list ' .$time[1] .'" id="'.$value .'">';
				if(isset($item[0])){
					foreach($item as $subject){
						echo '<li class="sortable-item"';
						echo ' id="' .$subject['alias'] .'"';
						echo ' title="'.$subject['details'].'">' .$subject['name'] .' (' .$subject['units'] .' units) ';
						if(isset($subject['prereqs'][0])){ 
							echo '<ul class="prereq">';
							foreach($subject['prereqs'] as $prereq){
								echo '<li>' .$prereq['name'] .'</li>';
							}
							echo '</ul>';
						}
						if($subject['var']==1){ 
							echo '<input size="15"></input>';
						}
						echo '</li>';
					}
				}
				echo '</ul></div>';
		
		}?>
		
		<?php //echo print_r($data);?>
		
		<div style="clear: both;"> <!-- --> </div>
	</div>
	<div style="clear: both;"> <!-- --> </div>
	
</div>
<div id="footer">Footer here. CopyLeft ______. | Other menu | Other stuff |</div>

<script type="text/javascript">
function subject(name,sem, unit, prereq){
	this.name=name;
	this.sem=sem;
	this.unit=unit;
	this.prereq=prereq;
}

function computeUnits(sem){
	var units = 0;
	for(j=0; j<subjects.length; j++){
		if(subjects[j].sem == sem){
			units = units + subjects[j].unit;
		}
	}
	document.getElementById("unit-"+sem).innerHTML= "Units: "+units;
}
</script>


<?php
	//initialize subjects
	echo '<script type="text/javascript">';
	$subjects = 'subjects = new Array(';
	foreach($data as $value=>$item){
		if(isset($item[0])){
			foreach($item as $subject){
				echo $subject['alias'] .' = new subject(';
				echo '"' .$subject['alias'] .'", ';
				echo '"' .$value .'", ';
				echo $subject['units'] .', ';
				$prereqs = 'new Array(';
				if(isset($subject['prereqs'][0])){ 
					foreach($subject['prereqs'] as $prereq){
						$prereqs = $prereqs .$prereq['alias'] .',';
					}
					echo substr($prereqs, 0, -1) .')';
				}
				else{ echo $prereqs .')'; }
				echo '); ' . PHP_EOL;;
				$subjects = $subjects .$subject['alias'] .',';
			}
		}
	}
	$subjects = substr($subjects, 0, -1);
	echo $subjects .');';
	echo '</script>';
?>

//check if prereqs are satisfied
<script>
function test(subject, sem){
	for(j=0; j<subjects.length; j++){
		if(subjects[j].name==subject){
			variable = subjects[j];
			break;
		}
	}
	
	previousSem = variable.sem;
	variable.sem = sem;
	
	for(j=0; j<subjects.length; j++){
		x = subjects[j];		
		for(i=0; i<x.prereq.length; i++){
			if(x.prereq[i].sem>=x.sem){
				document.getElementById("notification").innerHTML = "Error: " + x.prereq[i].name + " is a prereq of " + x.name;
				variable.sem = previousSem;
				return false;
			}
		}
	}
	computeUnits(previousSem);
	computeUnits(sem);
	return true;
}

</script>

<script type="text/javascript">

$(document).ready(function(){
	// Get items
	function getItems(exampleNr)
	{
		var columns = [];

		$(exampleNr + ' ul.sortable-list').each(function(){
			columns.push($(this).sortable('toArray').join(','));				
		});
		return columns.join('|');
	}
	$('#content').draggable({ 
		axis: "x",
	});
	//$( "li.sortable-item" ).draggable({
	//		connectToSortable: ".sortable-list",
	//		helper: "clone",
	//		revert: "invalid"
	//	});
	$("li.sortable-item").dblclick( function () { 
		$(this).draggable('enable');
		$(this).draggable({
			//start: function(event, ui){$(this).draggable('enable')},
			connectToSortable: ".sortable-list",
			helper: "clone",
			revert: "invalid",
			stop: function(event, ui) {
				$(this).draggable('disable');
			}
				//$(this).addClass('fade');
				//$(ui.item).addClass('clone');
				//$(ui.item).css({"font-weight":"bold"});
		});
		//$( "li.sortable-item" ).draggable("disable");
		//var helper = $( ".li.sortable-item" ).draggable( "option", "helper");
		//$("ui.draggable").css({"font-weight":"bold"});
	});
/*
	$("li.sortable-item").dblclick( function () { 
		var helper = $( ".li.sortable-item" ).draggable( "option", "helper", 'clone' );
		helper.css({"font-weight":"bold"});
		
	});*/
	$('.sortable-list').sortable({
		connectWith: '.sortable-list',
	});

	//1st year
	$('ul#sem1-1').sortable({
		receive: function(event, ui) {
			if(!test(ui.item.attr('id'), "sem1-1")){
				$(ui.sender).sortable('cancel');			
			}
			//if($(this).attr('style')!="display: block;"){
				//$(this).css({"font-weight":"bold"});
				//alert("this is a clone");
			//}
		}
	});
	$('ul#sem1-2').sortable({
		receive: function(event, ui) {
			if(!test(ui.item.attr('id'), "sem1-2")){
				$(ui.sender).sortable('cancel');			
			}
		}
	});
	$('ul#sem1-3').sortable({
		receive: function(event, ui) {
			if(!test(ui.item.attr('id'), "sem1-3")){
				$(ui.sender).sortable('cancel');			
			}
		}
	});
    //2nd year
	$('ul#sem2-1').sortable({
		receive: function(event, ui) {
			if(!test(ui.item.attr('id'), "sem2-1")){
				$(ui.sender).sortable('cancel');			
			}
		}
	});
	$('ul#sem2-2').sortable({
		receive: function(event, ui) {
			if(!test(ui.item.attr('id'), "sem2-2")){
				$(ui.sender).sortable('cancel');			
			}
		}
	});
	$('ul#sem2-3').sortable({
		receive: function(event, ui) {
			if(!test(ui.item.attr('id'), "sem2-3")){
				$(ui.sender).sortable('cancel');			
			}
		}
	});
    // 3rd year
	$('ul#sem3-1').sortable({
		receive: function(event, ui) {
			if(!test(ui.item.attr('id'), "sem3-1")){
				$(ui.sender).sortable('cancel');			
			}
		}
	});
	$('ul#sem3-2').sortable({
		receive: function(event, ui) {
			if(!test(ui.item.attr('id'), "sem3-2")){
				$(ui.sender).sortable('cancel');			
			}
		}
	});
	$('ul#sem3-3').sortable({
		receive: function(event, ui) {
			if(!test(ui.item.attr('id'), "sem3-3")){
				$(ui.sender).sortable('cancel');			
			}
		}
	});
    // 4th year
	$('ul#sem4-1').sortable({
		receive: function(event, ui) {
			if(!test(ui.item.attr('id'), "sem4-1")){
				$(ui.sender).sortable('cancel');			
			}
		}
	});
	$('ul#sem4-2').sortable({
		receive: function(event, ui) {
			if(!test(ui.item.attr('id'), "sem4-2")){
				$(ui.sender).sortable('cancel');			
			}
		}
	});
	$('ul#sem4-3').sortable({
		receive: function(event, ui) {
			if(!test(ui.item.attr('id'), "sem4-3")){
				$(ui.sender).sortable('cancel');			
			}
		}
	});
    // 5th year
	$('ul#sem5-1').sortable({
		receive: function(event, ui) {
			if(!test(ui.item.attr('id'), "sem5-1")){
				$(ui.sender).sortable('cancel');			
			}
		}
	});
	$('ul#sem5-2').sortable({
		receive: function(event, ui) {
			if(!test(ui.item.attr('id'), "sem5-2")){
				$(ui.sender).sortable('cancel');			
			}
		}
	});
	$('ul#sem5-3').sortable({
		receive: function(event, ui) {
			if(!test(ui.item.attr('id'), "sem5-3")){
				$(ui.sender).sortable('cancel');			
			}
		}
	});
    // 6th year
	$('ul#sem6-1').sortable({
		receive: function(event, ui) {
			if(!test(ui.item.attr('id'), "sem6-1")){
				$(ui.sender).sortable('cancel');			
			}
		}
	});
	$('ul#sem6-2').sortable({
		receive: function(event, ui) {
			if(!test(ui.item.attr('id'), "sem6-2")){
				$(ui.sender).sortable('cancel');			
			}
		}
	});
	$('ul#sem6-3').sortable({
		receive: function(event, ui) {
			if(!test(ui.item.attr('id'), "sem6-3")){
				$(ui.sender).sortable('cancel');			
			}
		}
	});
    // 7th year
	$('ul#sem7-1').sortable({
		receive: function(event, ui) {
			if(!test(ui.item.attr('id'), "sem7-1")){
				$(ui.sender).sortable('cancel');			
			}
		}
	});
	$('ul#sem7-2').sortable({
		receive: function(event, ui) {
			if(!test(ui.item.attr('id'), "sem7-2")){
				$(ui.sender).sortable('cancel');			
			}
		}
	});
	$('ul#sem7-3').sortable({
		receive: function(event, ui) {
			if(!test(ui.item.attr('id'), "sem7-3")){
				$(ui.sender).sortable('cancel');			
			}
		}
	});
});
</script>

