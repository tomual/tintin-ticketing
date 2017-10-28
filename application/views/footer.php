        </div>
</div>
<footer>
    
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
<script src="<?php echo base_url() ?>/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url() ?>/js/tinymce/tinymce.min.js"></script>

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
  plugins: "link, image, codesample, lists",
  toolbar: 'undo redo | styleselect | bold italic underline | bullist numlist | link image codesample',
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

    // Advanced Search - Select2
    $('.advanced-search #category').select2({
        placeholder: "Select ...",
    });
    $('.advanced-search #and-category').select2({
        placeholder: "Select ...",
        width: '100%'
    })
    $('.advanced-search #author').select2({
        placeholder: "Select ...",
    });
    $('.advanced-search #and-author').select2({
        placeholder: "Select ...",
        width: '100%'
    })
    $('.advanced-search #worker').select2({
        placeholder: "Select ...",
    });
    $('.advanced-search #and-worker').select2({
        placeholder: "Select ...",
        width: '100%'
    })
    $('.advanced-search #status').select2({
        placeholder: "Select ...",
    });
    $('.advanced-search #and-status').select2({
        placeholder: "Select ...",
        width: '100%'
    })

    // Status page - Reordering statuses
    $(".status-move").click(function(event) {
        row = $(this).closest('tr');
        if ($(this).is(".up")) {
            row.insertBefore(row.prev());
        } else {
            row.insertAfter(row.next());
        }
        updateStatusOrder();
    });

    function updateStatusOrder() {
        var order = new Object();
        var rows = $('tbody tr');

        $.each(rows, function( i, row ) {
            order[i] = {place:i, id: $(row).attr('id')};
        });
        $.post( "<?php echo base_url() ?>status/reorder", order );
    }

    $('input[name="exclude[]"]').on('change', function() {
        if (this.checked) {
            $('#' + this.value + '-and-select').fadeIn('fast');
        }
        else
        {
            $('#' + this.value + '-and-select').fadeOut('fast');
        }
    });

    getQueryStringKey = function(key) {
        return getQueryStringAsObject()[key];
    };


    getQueryStringAsObject = function() {
        var b, cv, e, k, ma, sk, v, r = {},
            d = function (v) { return decodeURIComponent(v).replace(/\+/g, " "); }, 
            q = window.location.search.substring(1), 
            s = /([^&;=]+)=?([^&;]*)/g 
        ;

        ma = function(v) {
            if (typeof v != "object") {
                cv = v;
                v = {};
                v.length = 0;
                if (cv) { Array.prototype.push.call(v, cv); }
            }
            return v;
        };

        while (e = s.exec(q)) { 
            b = e[1].indexOf("[");
            v = d(e[2]);
            if (b < 0) { 
                k = d(e[1]);
                if (r[k]) {
                    r[k] = ma(r[k]);
                    Array.prototype.push.call(r[k], v);
                }
                else {
                    r[k] = v;
                }
            }
            else {
                k = d(e[1].slice(0, b));
                sk = d(e[1].slice(b + 1, e[1].indexOf("]", b)));
                r[k] = ma(r[k]);
                if (sk) { r[k][sk] = v; }
                else { Array.prototype.push.call(r[k], v); }
            }
        }
        return r;
    };

    window.onunload = function(){}; 
    window.onload = function() {

        if(created_from_value = getQueryStringKey('created_from'))
        {
            created_from.setValue(created_from_value);
        }
        if(created_to_value = getQueryStringKey('created_to'))
        {
            created_to.setValue(created_to_value);
        }
        if(modified_from_value = getQueryStringKey('modified_from'))
        {
            modified_from.setValue(modified_from_value);
        }
        if(modified_to_value = getQueryStringKey('modified_to'))
        {
            modified_to.setValue(modified_to_value);
        }

        if(not = getQueryStringKey('exclude[]'))
        {
            if(typeof not === "object")
            {
                for(i in not)
                {
                    console.log( 'input[type=checkbox][value=' + not[i] + ']' );
                    $('input[type=checkbox][value=' + not[i] + ']').click();
                }                
            }
            else if(not)
            {
                $('input[type=checkbox][value=' + not + ']').click();
            }
        }

        select_labels = ['category', 'author', 'worker', 'status'];

        select_labels.forEach(function(select_label) {
            select_value = getQueryStringKey(select_label + '[]');
            select_and_value = getQueryStringKey('and-' + select_label + '[]');

            if(typeof select_value === "object")
            {
                select_values = select_value;
                delete select_values.length;
                for(i in select_values)
                {
                    $('#' + select_label + ' option[value="' + select_values[i] + '"]').prop("selected", true).trigger('change');
                }
            }
            else if(select_value)
            {
                $('#' + select_label + ' option[value="' + select_value + '"]').prop("selected", true).trigger('change');
            }


            if(typeof select_and_value === "object")
            {
                select_and_values = select_and_value;
                delete select_and_values.length;
                for(i in select_and_values)
                {
                    $('#and-' + select_label + ' option[value="' + select_and_values[i] + '"]').prop("selected", true).trigger('change');
                }
            }
            else if(select_and_value)
            {
                $('#and-' + select_label + ' option[value="' + select_and_value + '"]').prop("selected", true).trigger('change');
            }
        })
    }



</script>

</body>
</html>