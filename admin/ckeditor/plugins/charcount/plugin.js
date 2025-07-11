    CKEDITOR.plugins.add( 'charcount',
    {
       init : function( editor )
       {
          var defaultLimit = 'unlimited';
          var defaultFormat = '<span class="cke_charcount_count">%count%</span> of <span class="cke_charcount_limit">%limit%</span> characters';
          var limit = defaultLimit;
          var format = defaultFormat;

          var intervalId;
          var lastCount = -1;
          var limitReachedNotified = false;
          var limitRestoredNotified = false;
          
          
          if ( true )
          {   
             function counterId( editor )
             {
                return 'cke_charcount_' + editor.name;
             }
             
             function counterElement( editor )
             {
                return document.getElementById( counterId(editor) );
             }
             
             function updateCounter( editor )
             {
                var count = editor.getData().length;
                if( count == lastCount ){
                   return true;
                } else {
                   lastCount = count;
                }
                if( !limitReachedNotified && count > limit ){
                   limitReached( editor );
                } else if( !limitRestoredNotified && count <= limit ){
                   limitRestored( editor );
                }
                
                var html = format.replace('%count%', count).replace('%limit%', limit);
                counterElement(editor).innerHTML = html;
             }
             
             function limitReached( editor )
             {
                limitReachedNotified = true;
                limitRestoredNotified = false;
                editor.setUiColor( '#FFC4C4' );
             }
             
             function limitRestored( editor )
             {
                limitRestoredNotified = true;
                limitReachedNotified = false;
                editor.setUiColor( '#C4C4C4' );
             }

             editor.on( 'themeSpace', function( event )
             {
                if ( event.data.space == 'bottom' )
                {
                   event.data.html += '<div id="'+counterId(event.editor)+'" class="cke_charcount"' +
                      ' title="' + CKEDITOR.tools.htmlEncode( 'Character Counter' ) + '"' +
                      '>&nbsp;</div>';
                }
             }, editor, null, 100 );
             
             editor.on( 'instanceReady', function( event )
             {
                if( editor.config.charcount_limit != undefined )
                {
                   limit = editor.config.charcount_limit;
                }
                
                if( editor.config.charcount_format != undefined )
                {
                   format = editor.config.charcount_format;
                }
                
                
             }, editor, null, 100 );
             
             editor.on( 'dataReady', function( event )
             {
                var count = event.editor.getData().length;
                if( count > limit ){
                   limitReached( editor );
                }
                updateCounter(event.editor);
             }, editor, null, 100 );
             
             editor.on( 'key', function( event )
             {
                updateCounter(event.editor);
             }, editor, null, 100 );
             
             editor.on( 'focus', function( event )
             {
                editorHasFocus = true;
                intervalId = window.setInterval(function () {
                     updateCounter(editor)
                }, 1000, event.editor);
             }, editor, null, 100 );
             
             editor.on( 'blur', function( event )
             {
                editorHasFocus = false;
                if( intervalId )
                   clearInterval(intervalId);
             }, editor, null, 100 );
          }
       }
    });
