<div class="modal fade" id="keyboard-shortcuts-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</a>
                <h4 class="modal-title">{{ trans('admin::admin.shortcuts.available_shortcuts') }}</h4>
            </div>

            <div class="modal-body">
                <dl class="dl-horizontal">
                    <dt><code>?</code></dt>
                    <dd>{{ trans('admin::admin.shortcuts.this_menu') }}</dd>
                </dl>

                @stack('shortcuts')
            </div>
        </div>
    </div>
</div>

<footer class="main-footer hide">
    <div class="pull-right hidden-xs">
        <span>{{-- fleetcart_version() --}}</span>
    </div>

    <a href="#" data-toggle="modal" data-target="#keyboard-shortcuts-modal">
        <i class="fa fa-keyboard-o"></i>
    </a>&nbsp;

    <span>Copyright &copy; {{ date('Y')}} <a href="#" target="_blank">E-mandi</a></span>
    <div id="google_translate_element"></div>
    <style>
        #google_translate_element{
            position: relative;
            float: right;
        }
    </style>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</footer>
