//
// Namespace - Module Pattern.
//
var JQD = (function($, window, document, undefined) {
  // Expose innards of JQD.
  return {
    go: function() {
      for (var i in JQD.init) {
        JQD.init[i]();
      }
    },
    init: {
      frame_breaker: function() {
        if (window.location !== window.top.location) {
          window.top.location = window.location;
        }
      },
      //
      // Initialize the clock.
      //
      clock: function() {
        var clock = $('#clock');

        if (!clock.length) {
          return;
        }

        // Date variables.
        var date_obj = new Date();
        var hour = date_obj.getHours();
        var minute = date_obj.getMinutes();
        var day = date_obj.getDate();
        var year = date_obj.getFullYear();
        var suffix = 'AM';

        // Array for weekday.
        var weekday = [
          'Domingo',
          'Lunes',
          'Martes',
          'Miércoles',
          'Jueves',
          'Viernes',
          'Sábado'
        ];

        // Array for month.
        var month = [
          'Ene',
          'Feb',
          'Mar',
          'Abr',
          'May',
          'Jun',
          'Jul',
          'Ago',
          'Sep',
          'Oct',
          'Nov',
          'Dic'
        ];

        // Assign weekday, month, date, year.
        weekday = weekday[date_obj.getDay()];
        month = month[date_obj.getMonth()];

        // AM or PM?
        if (hour >= 12) {
          suffix = 'PM';
        }

        // Convert to 12-hour.
        if (hour > 12) {
          hour = hour - 12;
        }
        else if (hour === 0) {
          // Display 12:XX instead of 0:XX.
          hour = 12;
        }

        // Leading zero, if needed.
        if (minute < 10) {
          minute = '0' + minute;
        }

        // Build two HTML strings.
        var clock_date = day + ' ' + month + ' ' + year;
        var clock_time = '<p class="hour">' + hour + ':' + minute + ' ' + suffix + '</p>' + '<p class="date">' + clock_date + '</p>';

     
        // Shove in the HTML.
        clock.html(clock_time).attr('title', clock_date);

        // Timer de 1000 minisegundos
        setTimeout(JQD.init.clock, 1000);
      },
     //
      // Iniciando Sistema Operativo.
      //
      desktop: function() {
        // Alias del documento
        var d = $(document);

        // Impidiendo eventos del ratón
        d.mousedown(function(ev) {
          var tags = [
            'a',
            'button',
            'input',
            'select',
            'textarea',
            'tr'
          ].join(',');

          if (!$(ev.target).closest(tags).length) {
            JQD.util.clear_active();
            ev.preventDefault();
            ev.stopPropagation();
          }
        });

        // Impiendo Clic derecho
        d.on('contextmenu', function() {
          return false;
        });

        // Links remotos o relativos
        d.on('click', 'a', function(ev) {
          try{
            var url = $(this).attr('href');
            this.blur();

            if (url.match(/^#/)) {
              ev.preventDefault();
              ev.stopPropagation();
            }
            else {
              $(this).attr('target', '_self');
            }
          }catch(err){}
        });

        // Activando menús principales
        d.on('mousedown', 'a.menu_trigger', function() {
          if ($(this).next('ul.menu').is(':hidden')) {
            JQD.util.clear_active();
            $(this).addClass('active').next('ul.menu').show();
          }
          else {
            JQD.util.clear_active();
          }
        });

        // Obteniendo foco si esta abierto
        d.on('mouseenter', 'a.menu_trigger', function() {
          if ($('ul.menu').is(':visible')) {
            JQD.util.clear_active();
            $(this).addClass('active').next('ul.menu').show();
          }
        });

        // Cancelando clic simple
        d.on('mousedown', 'a.icon', function() {
          // Highlight the icon.
          JQD.util.clear_active();
          $(this).addClass('active');
        });

        // Abre ventana al doble clic
        d.on('click', 'a.MenuAccess', function() {
          //Cerrando Menú Principal
          $('div.StartMenu').hide();
          // Obteniendo objetivo
          //var x = $(this).attr('href');
          var idTarget = "window_" + $(this).attr('id');
          var x = $("div[id="+idTarget+"]");
          //var y = $(x).find('a').attr('href');

          // Antigua referencia al taskbar.
          //if ($(x).is(':hidden')) {
            //$(x).remove().appendTo('#dock');
            //$(x).show('fast');
          //}
          // Verificando si la Ventana está abierta
          if ($("div[id="+idTarget+"]").length){
            JQD.util.window_flat();
            x.show().addClass('window_stack');
          }
          else{
            //JQD.util.window_flat();
            //$(y).addClass('window_stack').show();
            $("#dock").append('<li id="'+ $(this).attr('href').replace("#",'') +'"><a href="'+ '#window_' + $(this).attr('id')  +'">'+ '<img  src="assets/images/icons/'+ 'generic' +'.png" />'+$(this).attr('title') +'</a></li>');

            //Si la ventana es de herramientas retira los botones
            var botones= ' <a href="#" class="window_resize"></a>';
            var Clase = 'PrincipalWindow';
            var Resize =' <span class="abs ui-resizable-handle ui-resizable-se">'
            if($(this).attr('tag') === 'PRINCIPAL'){

            }
            else if($(this).attr('tag') === 'CHICA')
            { 
               Resize = '';
               Clase= 'ChicaWindow';
            }
            else if($(this).attr('tag') === 'MEDIANA')
            { 
              
               Clase= 'MedianaWindow';
            }
            else{
             
              Resize = '';
              Clase= 'ReportesWindow';
            }

            $("#wrapper").append('<div class="abs window ' + Clase +'" id="window_' + $(this).attr('id')  +'">' +
                                    '<div class="abs window_inner">'+
                                        '<div class="window_top">'+
                                          '<span class="float_left">' +
                                            '<img src="assets/images/icons/'+ 'generic' +'.png" />'+
                                              $(this).attr('title') +
                                          '</span>'+
                                          '<span class="float_right">'+'  <a href="#" class="window_min"></a>'+
                                            botones +
                                            '  <a href="' + $(this).attr('href') + '" class="window_close"></a>'+
                                            '</span>'+
                                          '</span>' +
                                        '</div>'+
                                        '<div class="abs window_content">'+
                                          '<div class="window_main '+ $(this).attr('id') + '">'+
                                          '</div>'+
                                        '</div>'+
                                        '<div class="abs window_bottom">' + Resize + '</span></div>'+
                                    '</div>'+
                                    '<input id="txtAcciones_' + $(this).attr('sufijo') + '" type="hidden" value="'+ $(this).attr('permisos') + '"></input>'+
                                    '<input id="txtProcesoMenuID_' + $(this).attr('sufijo') + '" type="hidden" value="'+ $(this).attr('procesoID') + '"></input>'+
                                '</div>');

            var NewClassEvent =   '.' + $(this).attr('id');
            var base_url = $(this).attr('href');
            $.ajax( {
                //
                url: base_url,//'pages/'+$(this).attr('id') + '.html',
                type: "POST",
                cache: false,
                success: function(html) {
                    $(NewClassEvent).html(html);
                }
            });
            //Trayendo Nueva Ventana hacia adelante de las demás
            JQD.util.window_flat();
            x.show().addClass('window_stack');
          }
          return false;
        });

        // Iconos Arrastables
        d.on('mouseenter', 'a.icon', function() {
          $(this).off('mouseenter').draggable({
            revert: true,
            containment: $("#wrapper")
          });
        });

        // Botones de la Barra de Tarea
        d.on('click', '#dock a', function() {
          // Get the link's target.
          var idTarget = $(this).attr('href').replace('#','');
          var x = $('div[id="'+ idTarget +'"]');
          // Esconde si es visible
          if (x.is(':visible')) {
            x.hide();
          }
          else {
            // Trae ventanas al frente
            JQD.util.window_flat();
            x.show().addClass('window_stack');

          }
        });

        // Seleccionar ventana.
        d.on('mousedown', 'div.window', function() {
          // Traerla al frente.
          JQD.util.window_flat();
          $(this).addClass('window_stack');
        });

        // Mover ventana.
        d.on('mouseenter', 'div.window', function() {

          $(this).off('mouseenter').draggable({

            // Limitar al escritorio
            // Limitar evento a barra superior.
            cancel: 'a',
            containment:  $("#wrapper"),
            handle: 'div.window_top'
          }).resizable({
            containment:  $("#wrapper"),
            minWidth: 400,
            minHeight: 200
          });
        });

        // Doble Clic para Maximizar.
        d.on('dblclick', 'div.window_top', function() {
          JQD.util.window_resize(this);

        });

        // Doble clic en Icono para Cerrar
        d.on('dblclick', 'div.window_top img', function() {
         var idTarget = $(this).closest('div.window');
          idTarget.remove();
        });

        // Minimizar Ventana.
        d.on('click', 'a.window_min', function() {
          $(this).closest('div.window').hide();
        });

        // Maximizar o Restaurar.
        d.on('click', 'a.window_resize', function() {
          JQD.util.window_resize(this);
        });

        // Cerrar Ventana.
        d.on('click', 'a.window_close', function() {
          //$(this).closest('div.window').hide();
          //$($(this).attr('href')).hide('fast');
          //Cierre total del contenedor
          var TaskBar = $(this).attr('href').replace('#','');
          var AutoGenID = $(this).closest('div.window').attr('id') + '_closedialog'
          var CloseDialog = '<div id="'+ AutoGenID +'" class="CloseModalBody" style="display=none">' +
                                '<p>¿Desea cerrar esta ventana?</p>' +
                                '<a href="#" class="ModalBtn Cerrar">Si</a>' +
                                '<a href="#" class="ModalBtn NoCerrar">No</a>' +
                            '</div>';

            $(this).closest('div.window').append(CloseDialog);

            $("#" + AutoGenID).bPopup({
              appendTo: '#' + $(this).closest('div.window').attr('id')
              , zIndex: 40
              , modalClose: false
              , modal: true
              , follow: [true,false]
              , followEasing : "linear"
              , easing: "linear"
              , modalColor: ('#F0F0F0')
            })
            $(".Cerrar").click(function(){
              var idTarget = $(this).closest('div.window');
              var idTaskBar = $('li[id="'+ TaskBar +'"]');
              idTarget.remove();
              idTaskBar.remove();
            });
            $(".NoCerrar").click(function(){
              $("#"+ AutoGenID).bPopup().close(); //Cierra el Popup
              document.getElementById(AutoGenID).remove(); //Destruye El Popup
            });

            return false;

        });

        // Mostrar Escritorio.
        d.on('mousedown', '#show_desktop', function() {
          // If any windows are visible, hide all.
          if ($('div.window:visible').length) {
            $('div.window').hide();
          }
          else {
            // Muestra todas las ventanas
            $('#dock li:visible a').each(function() {
              $($(this).attr('href')).show();
            });
          }
        });

        //Mostrar Menu
        d.on('mousedown', '#StartMenuBtn', function(e) {
          e.preventDefault();
          $("#StartMenuBtn").tooltip('hide');
          // Checa Estado del Menu
          if ($('div.StartMenu:visible').length) {
            $('div.StartMenu').hide();
          }
          else {
            // Muestra Menu
            $('div.StartMenu').show();
          }
        });
        //Mostrar Info
        d.on('mousedown', '#show_info', function(e) {
          e.preventDefault();
          //$("#StartMenuBtn").tooltip('hide');
          // Checa Estado del Menu
          if ($('div.Widget:visible').length) {
            $('div.Widget').hide();
          }
          else {
            // Muestra Menu
            $('div.Widget').show();
          }
        });


        //Pierde Foco Menu
        d.on('mousedown', '#wrapper', function() {
            // Checa Estado del Menu
            if ($('div.StartMenu:visible').length) {
              $('div.StartMenu').hide();
            }
        });
        d.on('mousedown', '#dock', function() {
            // Checa Estado del Menu
            if ($('div.StartMenu:visible').length) {
              $('div.StartMenu').hide();
            }
        });


        $('table.data').each(function() {
          $(this).find('tbody tr:odd').addClass('zebra');
        });

        d.on('mousedown', 'table.data tr', function() {
          // Clear active state.
          JQD.util.clear_active();

          // Highlight row, ala Mac OS X.
          $(this).closest('tr').addClass('active');
        });
      },
      wallpaper: function() {
        // Add wallpaper last, to prevent blocking.
        if ($('#desktop').length) {
          $('body').prepend('<img id="wallpaper" class="abs" src="assets/images/misc/wallpaper.jpg" />');
        }
      }
    },
    util: {
      //
      // Clear active states, hide menus.
      //
      clear_active: function() {
        $('a.active, tr.active').removeClass('active');
        $('ul.menu').hide();
      },
      //
      // Zero out window z-index.
      //
      window_flat: function() {
        $('div.window').removeClass('window_stack');
      },
      //
      // Resize modal window.
      //
      window_resize: function(el) {
        // Nearest parent window.
        var win = $(el).closest('div.window');

        // Is it maximized already?
        if (win.hasClass('window_full')) {
          // Restore window position.
          win.removeClass('window_full').css({
            'top': win.attr('data-t'),
            'left': win.attr('data-l'),
            'right': win.attr('data-r'),
            'bottom': win.attr('data-b'),
            'width': win.attr('data-w'),
            'height': win.attr('data-h')
          });
        }
        else {

          win.attr({
            // Save window position.
            'data-t': win.css('top'),
            'data-l': win.css('left'),
            'data-r': win.css('right'),
            'data-b': win.css('bottom'),
            'data-w': win.css('width'),
            'data-h': win.css('height')
          }).addClass('window_full').css({
            // Maximize dimensions.
            'top': '0',
            'left': '0',
            'right': '0',
            'bottom': '0',
            'width': '100%',
            'height': '100%'
          });

        }

        // Bring window to front.
        JQD.util.window_flat();
        win.addClass('window_stack');
      }
    }
  };
// Pass in jQuery.
})(jQuery, this, this.document);


//
// Kick things off.
//
jQuery(document).ready(function() {
  JQD.go();

  //Timeout para cerrar el loader y mostrar login
  setTimeout(function(){
    $('body').addClass('loaded');
  }, 3000);

  $("#StartMenuBtn").tooltip({
                        trigger: 'manual',
                        placement: 'right',
                        title: "Módulo Cargado"
                    });



    /*Hacer un llamado al método del controlador para regresar el número de mensajes nuevos del usuario
      por un intervalo de tiempo.
    */
    /*setInterval( function() {
        //Hacer un llamado al método del controlador para regresar el número de mensajes nuevos del usuario,
        //de esta manera se cambiará el icono del mensaje
       $.ajax({url: 'administracion/mensajes/get_mensajes_nuevos',
            	type: 'POST',
            	data: {},
	            success: function(data) {
	              //Si hay datos
	                    if(data.row)
	                    {
	                      //Quitar clases del icono mensaje
			              $('#IconMensajes').removeClass("fa fa-envelope mensajes-NUEVOS")
			              $('#IconMensajes').removeClass("fa fa-envelope-open");
	              
	                      //Si hay nuevos mensajes para el usuario
	                      if(data.row.total_mensajes_nuevos > 0)
	                      { 
	                        //Agregar icono de mensaje cerrado
	                        $('#IconMensajes').addClass("fa fa-envelope mensajes-NUEVOS");
	                      }
	                      else
	                      {
	                        //Agregar icono de mensaje abierto
	                        $('#IconMensajes').addClass("fa fa-envelope-open");
	                      }
	                    }
	        	}
        	});
        },1000);*/
});