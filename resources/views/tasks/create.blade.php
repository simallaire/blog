@extends('layouts.master')

@section('content')
<div class="container">

    <div class="content">
    <form action="/tasks" method="POST">
    {{csrf_field()}}
        <div class="form-group">
            <label class="form-control-label" for="Body">Body</label>
            <input type="text" name="body" id="title" class="form-control">

        </div>
        <div class="form-group">
            <div class="form-group">
                <span class="button-checkbox">
                    <button type="button" class="btn" data-color="primary">Completed</button>
                    <input type="checkbox" name="completed" value="0" hidden="hidden"/>
                    <input type="checkbox" name="completed" value="1" checked="checked" hidden="hidden"/>
                </span>
            </div>
            <div class="form-group">
                <input type="submit" class="form-control" value="Ajouter">
            </div>
        </div>
        </form>  
</div>

</div>



@endsection

<script>
$(function () {
    $('.button-checkbox').each(function () {

        // Settings
        var $widget = $(this),
            $button = $widget.find('button'),
            $checkbox = $widget.find('input:checkbox'),
            color = $button.data('color'),
            settings = {
                on: {
                    icon: 'glyphicon glyphicon-check'
                },
                off: {
                    icon: 'glyphicon glyphicon-unchecked'
                }
            };

        // Event Handlers
        $button.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {
            updateDisplay();
        });

        // Actions
        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');

            // Set the button's state
            $button.data('state', (isChecked) ? "on" : "off");

            // Set the button's icon
            $button.find('.state-icon')
                .removeClass()
                .addClass('state-icon ' + settings[$button.data('state')].icon);

            // Update the button's color
            if (isChecked) {
                $button
                    .removeClass('btn-default')
                    .addClass('btn-' + color + ' active');
            }
            else {
                $button
                    .removeClass('btn-' + color + ' active')
                    .addClass('btn-default');
            }
        }

        // Initialization
        function init() {

            updateDisplay();

            // Inject the icon if applicable
            if ($button.find('.state-icon').length == 0) {
                $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
            }
        }
        init();
    });
});

</script>