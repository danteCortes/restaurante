<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Primer Usuario</title>

    {{Html::style('componentes/bootstrap-3.3.7/css/bootstrap.min.css')}}

    <style>
      @-ms-viewport     { width: device-width; }
      @-o-viewport      { width: device-width; }
      @viewport         { width: device-width; }

      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #1a9c0e;
      }

      .form-signin {
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin .checkbox {
        font-weight: normal;
      }
      .form-signin .form-control {
        position: relative;
        height: auto;
        -webkit-box-sizing: border-box;
          -moz-box-sizing: border-box;
                box-sizing: border-box;
        padding: 10px;
        font-size: 16px;
      }
      .form-signin .form-control:focus {
        z-index: 2;
      }
      .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
      }
      .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
      }
      .mayuscula{
        text-transform: uppercase;
      }

    </style>

    <script>
      (function () {
        'use strict';

        function emulatedIEMajorVersion() {
          var groups = /MSIE ([0-9.]+)/.exec(window.navigator.userAgent)
          if (groups === null) {
            return null
          }
          var ieVersionNum = parseInt(groups[1], 10)
          var ieMajorVersion = Math.floor(ieVersionNum)
          return ieMajorVersion
        }

        function actualNonEmulatedIEMajorVersion() {
          // Detects the actual version of IE in use, even if it's in an older-IE emulation mode.
          // IE JavaScript conditional compilation docs: https://msdn.microsoft.com/library/121hztk3%28v=vs.94%29.aspx
          // @cc_on docs: https://msdn.microsoft.com/library/8ka90k2e%28v=vs.94%29.aspx
          var jscriptVersion = new Function('/*@cc_on return @_jscript_version; @*/')() // jshint ignore:line
          if (jscriptVersion === undefined) {
            return 11 // IE11+ not in emulation mode
          }
          if (jscriptVersion < 9) {
            return 8 // IE8 (or lower; haven't tested on IE<8)
          }
          return jscriptVersion // IE9 or IE10 in any mode, or IE11 in non-IE11 mode
        }

        var ua = window.navigator.userAgent
        if (ua.indexOf('Opera') > -1 || ua.indexOf('Presto') > -1) {
          return // Opera, which might pretend to be IE
        }
        var emulated = emulatedIEMajorVersion()
        if (emulated === null) {
          return // Not IE
        }
        var nonEmulated = actualNonEmulatedIEMajorVersion()

        if (emulated !== nonEmulated) {
          window.alert('WARNING: You appear to be using IE' + nonEmulated + ' in IE' + emulated + ' emulation mode.\nIE emulation modes can behave significantly differently from ACTUAL older versions of IE.\nPLEASE DON\'T FILE BOOTSTRAP BUGS based on testing in IE emulation modes!')
        }
      })();
    </script>
  </head>

  <body>
    <div class="container">
      {{Form::open(['url'=>'primer-usuario', 'class'=>'form-signin', 'id'=>'frmLogin', 'autocomplete'=>'off'])}}
        {{Form::token()}}
        <h2 class="form-signin-heading">Ingrese sus datos</h2>
        {{Form::label(null, 'DNI: ', ['class'=>'sr-only'])}}
        {{Form::text('dni', null, ['class'=>'form-control dni', 'placeholder'=>'DNI', 'required'=>'', 'autofocus'=>''])}}
        
        {{Form::label(null, 'NOMBRES: ', ['class'=>'sr-only'])}}
        {{Form::text('nombres', null, ['class'=>'form-control mayuscula', 'placeholder'=>'NOMBRES', 'required'=>''])}}
        
        {{Form::label(null, 'APELLIDOS: ', ['class'=>'sr-only'])}}
        {{Form::text('apellidos', null, ['class'=>'form-control mayuscula', 'placeholder'=>'APELLIDOS', 'required'=>''])}}
        <br>
        {{Form::button('Limpiar', ['class'=>'btn btn-warning', 'type'=>'reset'])}}
        {{Form::button('Guardar', ['class'=>'btn btn-primary pull-right', 'type'=>'submit'])}}
      {{Form::close()}}
      <div class="modal fade" id="error" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Error!</h4>
              </div>
              <div class="modal-body">
                <p>El DNI Debe contener 8 dígitos</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div>
    </div>
    <script>
      (function () {
        'use strict';

        if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
          var msViewportStyle = document.createElement('style')
          msViewportStyle.appendChild(
            document.createTextNode(
              '@-ms-viewport{width:auto!important}'
            )
          )
          document.querySelector('head').appendChild(msViewportStyle)
        }

      })();
    </script>
    {{Html::script('componentes/jquery-1.12.4/jquery.min.js')}}
    {{Html::script('componentes/bootstrap-3.3.7/js/bootstrap.min.js')}}
    {{Html::script('componentes/jquery-mask-1.14.11/jquery.mask.js')}}
    <script>
      $(document).ready(function(){
        $(".dni").mask("99999999");
        $("#frmLogin").submit(function(event){
          if ($(".dni").val().length != 8) {
            event.preventDefault();
            $("#error").modal("show");
            $(".dni").focus();
          }
        });
      });
    </script>
  </body>
</html>