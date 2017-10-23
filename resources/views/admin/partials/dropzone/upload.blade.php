<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Administration &bull; {{ infos('societe') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <!-- Contre éventuel problème TokenMismatchException à l'upload ou delete des fichiers DROPZONE -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Dropzone CSS -->
  <link rel="stylesheet" href="{{asset('vendor/dropzone/css/dropzone.css')}}">
  <!-- Bootstrap 3.3.7 CDN -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" 
		integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" 
		crossorigin="anonymous">
	
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <div class="how-to-create">
                <ul>
					<li>Dimensions minimales : <b>{{ config('dropzone.full_size') }}px</b></li>
                    <li>Taille maximale des fichiers acceptée est de <b id="maxSizeFile"></b></li>
                    <li>Les fichiers sont automatiquement liés à votre {{ $type }}.</li>
                    <li>Deux fichiers seront créés. Un de {{ config('dropzone.full_size') }}px et un de {{ config('dropzone.icon_size') }}px.</li>
                </ul>
            </div>
            <div class="how-to-create" >

                <h3 class="text-center">Images {{-- strtoupper($type) --}} <span id="photoCounter"></span></h3>
				
				<a href="" class="btn btn-xs btn-default">Actualiser</a>
                
		    	<form action="{{route('upload-post-images')}}" class="dropzone" files="true" id="real-dropzone" style="background-color: #e6f0e6">
	       				 {{ csrf_field() }}
		    		
		        	<input type="hidden" id="csrf-token" value="{{csrf_token()}}" /><!-- pour Dropzone, à la suppression -->
	        		<input type="hidden" name="relation_id" value="{{ $id }}" />
	        		<input type="hidden" name="relation_type" value="{{ $type }}" />

	                <div class="dz-message">
	
	                </div>
	
	                <div class="fallback">
	                    <input name="file" type="file" multiple />
	                </div>
	
	                <div class="dropzone-previews" id="dropzonePreview"></div>
					
					<br>
               </form>
            </div>
        </div>
    </div>

    <!-- Dropzone Preview Template -->
    <div id="preview-template" style="display: none;">

        <div class="dz-preview dz-file-preview">
            <div class="dz-image"><img data-dz-thumbnail="" class="img-responsive"></div>
            <input type="hidden" class="serverfilename"/>

            <div class="dz-details">
                <div class="dz-size"><span data-dz-size=""></span></div>
                <div class="dz-filename"><span data-dz-name=""></span></div>
            </div>
            <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
            <div class="dz-error-message"><span data-dz-errormessage=""></span></div>

            <div class="dz-success-mark">
                <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                    <!-- Generator: Sketch 3.2.1 (9971) - http://www.bohemiancoding.com/sketch -->
                    <title>Vérification</title>
                    <desc>Créé avec Sketch.</desc>
                    <defs></defs>
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                        <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>
                    </g>
                </svg>
            </div>

            <div class="dz-error-mark">
                <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                    <!-- Generator: Sketch 3.2.1 (9971) - http://www.bohemiancoding.com/sketch -->
                    <title>Erreur</title>
                    <desc>Créé avec Sketch.</desc>
                    <defs></defs>
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                        <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">
                            <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>
                        </g>
                    </g>
                </svg>
            </div>

        </div>
    </div>
    <!-- End Dropzone Preview Template -->
    
	<!-- jQuery 2.2.4 -->
	<script src="https://code.jquery.com/jquery-2.2.4.min.js"
	  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
	  crossorigin="anonymous"></script>
	<!-- Dropzone JS -->
	<script src="{{asset('vendor/dropzone/js/dropzone.js')}}"></script>
	  
	<script type="text/javascript">
		
	$(function () {
		
		var photo_counter = 0;
		
		Dropzone.options.realDropzone = {
		
		    uploadMultiple: false, /* possible quand même ! */
		    parallelUploads: 100,
		    maxFilesize: 1, /* Mo */
		    previewsContainer: '#dropzonePreview',
		    previewTemplate: document.querySelector('#preview-template').innerHTML,
		    addRemoveLinks: true,
			dictRemoveFile: 'Supprimer',
		    dictDefaultMessage: "Déposez les fichiers ici afin de les télécharger &nbsp;<span class='glyphicon glyphicon-hand-down'></span>",
		    dictFallbackMessage: "Votre navigateur ne supporte pas les téléchargements de fichiers drag'n'drop.",
		    dictFallbackText: "Veuillez utiliser le formulaire de rechange ci-dessous pour télécharger vos fichiers comme autrefois...",
			dictFileTooBig: "Le fichier est trop volumineux.",
		    dictInvalidFileType: "Vous ne pouvez pas télécharger de fichiers de ce type.",
		    dictCancelUpload: "Arrêter",
		    dictCancelUploadConfirmation: "Voulez-vous vraiment annuler ce téléchargement ?",
		    dictRemoveFileConfirmation: null,
		    dictMaxFilesExceeded: "Vous ne pouvez pas télécharger d'autres fichiers.",
			
		    /* The setting up of the dropzone */
		    init:function() {
		
		        /* Add server images */
		        var myDropzone = this;
			
				/* GET pour afficher celle qui existe */
		    	$.get("<?php echo url('admin/dropzone/server-images/'.$type.'/'.$id); ?>", function(data) {
		
		            $.each(data.images, function (key, value) {
		            	
			                var file = {name: value.original, size: value.size};
			                myDropzone.options.addedfile.call(myDropzone, file);
			                myDropzone.options.thumbnail.call(myDropzone, file, "{{ url('/photos/shares/DropZone/' . config('dropzone.icon_size')) }}" + value.server);
			                myDropzone.emit("complete", file);
			
			                photo_counter++;
			                $("#photoCounter").text( "(" + photo_counter + ")" );
		            });
		        });
		
				/* Remove */
		        myDropzone.on("removedfile", function(file) {
		
		            $.ajax({
		                type: 'POST',
		                url: "<?php echo url('admin/dropzone/delete/'.$type); ?>",
		                data: {id: file.name, _token: $('#csrf-token').val()},
		                dataType: 'html',
		                success: function(data){
		                    var rep = JSON.parse(data);
		                    if(rep.code == 200)
		                    {
		                        photo_counter--;
		                        $("#photoCounter").text( "(" + photo_counter + ")" );
		                    }
		
		                }
		            });
		
		        });
		    },
		    error: function(file, response) {
		        if($.type(response) === "string")
		            var message = response; /* dropzone sends it's own error messages in string */
		        else
		            var message = response.message;
		        file.previewElement.classList.add("dz-error");
		        _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
		        _results = [];
		        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
		            node = _ref[_i];
		            _results.push(node.textContent = message);
		        }
		        return _results;
		    },
		    success: function(){ /* file, done) {*/
		        photo_counter++;
		        $("#photoCounter").text( "(" + photo_counter + ")");
		    }
		};
		
		/* Affiche dans le modal la taille max */
		$('#maxSizeFile').text(Dropzone.options.realDropzone.maxFilesize+'Mo');
	
		/* Affiche le message de chargement au millieu du champ */
		$('.dz-message').html(Dropzone.options.realDropzone.dictDefaultMessage);
	
	});	
	</script>
 
</body>
</html>

