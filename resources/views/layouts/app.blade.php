<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Music Library') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            padding-top: 65px;
            padding-bottom: 20px;
        }

        /* Set padding to keep content from hitting the edges */
        .body-content {
            padding-left: 15px;
            padding-right: 15px;
        }

        /* Override the default bootstrap behavior where horizontal description lists 
           will truncate terms that are too long to fit in the left column.
           Also, add a 8pm to the bottom margin
        */
        .dl-horizontal dt {
            white-space: normal;
            margin-bottom: 8px;
        }

        /* Set width on the form input elements since they're 100% wide by default */
        input,
        select,
        textarea,
        .uploaded-file-group,
        .input-width-input {
            max-width: 380px;
        }

        .input-delete-container {
            width: 46px !important;
        }

        /* Vertically align the table cells inside body-panel */
        .panel-body .table > tr > td
        {
            vertical-align: middle;
        }

        .panel-body-with-table
        {
            padding: 0;
        }

        .mt-5 {
            margin-top: 5px !important;
        }

        .mb-5 {
            margin-bottom: 5px !important;
        }
    </style>

</head>

<body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar">A</span>
            <span class="icon-bar">B</span>
            <span class="icon-bar">C</span>
          </button>
          <a href="{!! url('/') !!}" class="navbar-brand">{{ config('app.name', 'Music Library') }}</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="{!! url('/') !!}">Home</a></li>
          </ul>

          @if (Route::has('login'))
            <ul class="nav navbar-nav navbar-right">
            @if (Auth::check())
                <li><a href="{{ url('/home') }}">Home</a></li>
            @else
                <li><a href="{{ url('/login') }}">Login</a></li>
                <li><a href="{{ url('/register') }}">Register</a></li>
            @endif
            </ul>
          @endif

        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container body-content">
        @yield('content')
    </div>

    <!-- Scripts -->
    
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
        integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script type="text/javascript">
        $(function(){

             // sends the uploaded file file to the fielselect event
            $(document).on('change', ':file', function() {
                var input = $(this);
                var label = input.val().replace(/\\/g, '/').replace(/.*\//, '');

                input.trigger('fileselect', [label]);
            });

            // Set the label of the uploaded file
            $(':file').on('fileselect', function(event, label) {
                $(this).closest('.uploaded-file-group').find('.uploaded-file-name').val(label);
            });
            
            // Deals with the upload file in edit mode
            $('.custom-delete-file:checkbox').change(function(e){
                var self = $(this);
                var container = self.closest('.input-width-input');
                var display = container.find('.custom-delete-file-name');

                if (self.is(':checked')) {
                    display.wrapInner('<del></del>');
                } else {
                    var del = display.find('del').first();
                    if (del.is('del')) {
                        del.contents().unwrap();
                    }
                }
            }).change();

            // Sets the validator defaults
            $.validator.setDefaults({
                errorElement: "span",
                errorClass: "help-block",
                highlight: function (element, errorClass, validClass) {
                    $(element).closest('.form-group').addClass('has-error');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).closest('.form-group').removeClass('has-error');
                },
                errorPlacement: function (error, element) {
                    if (element.parent('.input-group').length) {
                        error.insertAfter(element.parent());
                    } else if(element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                        error.appendTo(element.closest(':not(input, label, .checkbox, .radio)').first());
                    } else {
                        error.insertAfter(element);
                    }
                }
            });

            // Makes sure any input with the required class is actually required
            $('form').each(function(index, item){
                var form = $(item);
                form.validate();

                form.find(':input.required').each(function(i, input){
                    $(input).attr('required', true);
                });
            });

        });
    </script>

</body>
</html>
