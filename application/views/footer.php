    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
<script src="/js/bootstrap-datepicker.js"></script>



<script type="text/javascript">
	var nowTemp = new Date();
	var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
	 
	var created_from = $('#created_from').datepicker().on('changeDate', function(ev) {
	  if (ev.date.valueOf() > created_to.date.valueOf()) {
	    var newDate = new Date(ev.date)
	    newDate.setDate(newDate.getDate() + 1);
	    created_to.setValue(newDate);
	  }
	  created_from.hide();
	  $('#created_to')[0].focus();
	}).data('datepicker');
	var created_to = $('#created_to').datepicker().on('changeDate', function(ev) {
	  created_to.hide();
	}).data('datepicker');

	created_from.setValue('<?php echo $this->input->get('created_from') ?>');
	created_to.setValue('<?php echo $this->input->get('created_to') ?>');
</script>

</body>
</html>