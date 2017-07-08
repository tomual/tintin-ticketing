        </div>
</div>
<footer>
    
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
<script src="/js/bootstrap-datepicker.js"></script>
<script src="/js/tinymce/tinymce.min.js"></script>

<script>
tinymce.init({
  selector: 'textarea#description',  // change this value according to your HTML
  plugins: "link, image, codesample, lists",
  toolbar: 'undo redo | styleselect | bold italic underline | bullist numlist | link image codesample',
  statusbar: false,
  menubar: false,
  height : 250
});
tinymce.init({
  selector: 'textarea#comment',  // change this value according to your HTML
  toolbar: false,
  statusbar: false,
  menubar: false,
  height : 50
});
</script>
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

    var modified_from = $('#modified_from').datepicker().on('changeDate', function(ev) {
        if (ev.date.valueOf() > modified_to.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            modified_to.setValue(newDate);
        }
        modified_from.hide();
        $('#modified_to')[0].focus();
    }).data('datepicker');
    var modified_to = $('#modified_to').datepicker().on('changeDate', function(ev) {
        modified_to.hide();
    }).data('datepicker');

    <?php if($this->input->get('created_from')): ?>
    created_from.setValue('<?php echo $this->input->get('created_from') ?>');
    <?php endif ?>
    <?php if($this->input->get('created_to')): ?>
    created_to.setValue('<?php echo $this->input->get('created_to') ?>');
    <?php endif ?>
    <?php if($this->input->get('modified_from')): ?>
    modified_from.setValue('<?php echo $this->input->get('modified_from') ?>');
    <?php endif ?>
    <?php if($this->input->get('modified_to')): ?>
    modified_to.setValue('<?php echo $this->input->get('modified_to') ?>');
    <?php endif ?>
</script>

</body>
</html>