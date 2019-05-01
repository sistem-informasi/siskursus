<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Admin</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="/css/app.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.8,af-2.0.0,b-1.0.1,b-colvis-1.0.1,b-flash-1.0.1,b-html5-1.0.1,b-print-1.0.1,cr-1.2.0,fc-3.1.0,fh-3.0.0,kt-2.0.0,r-1.0.7,rr-1.0.0,sc-1.3.0,se-1.0.0/datatables.min.css"/>
		<!-- Add fancyBox -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" type="text/css" media="screen" />
		@yield('top-scripts')
		<style type="text/css">
			body {
				padding-top: 70px;
			}
			.dataTables_filter {
	            display: none;
	        }
		</style>
	</head>
	<body>

	    <nav class="navbar navbar-default navbar-fixed-top">
		    <div class="container">
		        <!-- Brand and toggle get grouped for better mobile display -->
		        <div class="navbar-header">
		            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
		                <span class="sr-only">Toggle navigation</span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		            </button>
		            <a class="navbar-brand" href="#">LaraCRUD</a>
		        </div>

		        <!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a href="{{ url('/example') }}">Example <span class="sr-only">(current)</span></a></li>
					</ul>
				</div><!-- /.navbar-collapse -->

		    </div><!-- /.container-fluid -->
		</nav>
		
		<div class="btn-group" role="group" aria-label="">
			<a href="{{ url($crudData['crudRoute'].'/create') }}">
				<button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Create new {{ $crudData['crudName'] }}</button>
			</a>
		</div>
		<hr>

		<input type="hidden" id="csrf_token" value="{{ csrf_token() }}" />

		<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    @foreach($table['headers'] as $header)
                        @if(in_array(strtolower($header->column_name), $table['displayable']))
                            <th>{{ $header->title }}</th>
                        @endif
                    @endforeach
                    <th>Actions</th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    @foreach($table['headers'] as $header)
                        @if(in_array(strtolower($header->column_name), $table['displayable']))
                            <th>{{ $header->title }}</th>
                        @endif
                    @endforeach
                </tr>
            </tfoot>

        </table>

		<!-- Latest compiled and minified JS -->
		<script src="https://code.jquery.com/jquery.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.8,af-2.0.0,b-1.0.1,b-colvis-1.0.1,b-flash-1.0.1,b-html5-1.0.1,b-print-1.0.1,cr-1.2.0,fc-3.1.0,fh-3.0.0,kt-2.0.0,r-1.0.7,rr-1.0.0,sc-1.3.0,se-1.0.0/datatables.min.js"></script>
		<!-- Add fancyBox -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.pack.js"></script>

		<script type="text/javascript">
	        $(document).ready(function() {
	            if (window.top.location != window.location) {
	                parent.jQuery.fancybox.close();
	            }

	            $('#example tfoot th').each( function () {
	                var title = $(this).text();
	                if (title !== 'Actions') {
	                    $(this).html( '<input type="text" placeholder="Search '+title+'" />' );                    
	                }
	            });

	            var table = $('#example').DataTable({
	                processing: true,
	                serverSide: true,
	                stateSave: true,
	                ajax: '{!! url($crudData['crudRoute']. '/data') !!}',
	                columns: [
	                	@if (!in_array('id', $table['displayable']))
                    		{ data: 'id', name: 'id' },
                    	@endif
	            		@foreach ($table['headers'] as $header)
		                	@if (in_array(strtolower($header->column_name), $table['displayable'])) 
		                    	{ data: '{{ $header->column_name }}', name: '{{ $header->column_name }}' },
		                	@endif
	            		@endforeach
	                    { data: 'actions', name: 'actions' },
	                ],
	                stateLoadCallback: function (settings) {
	                    var storage = $.parseJSON(localStorage.getItem('DataTables_example_'+window.location.pathname));
	                    if (storage) {
		                    $.each(storage.columns, function(key, value) {
		                        if (key > 0 && value.search.search !== "") {
		                            $('#example').find('input').eq(key).val(value.search.search);
		                        }
		                    });
		                }
	                    return JSON.parse( localStorage.getItem('DataTables_example_'+window.location.pathname) );
	                },
	                columnDefs: [
	                    {
	                        targets: [0],
	                        visible: false
	                    },
	                    {
	                        render: function ( data, type, full ) {
	                            console.log(full);
	                            view = '<a href="'+full.actions.crudRoute+'/'+full.id+'" class="btn btn-primary">View <i class="glyphicon glyphicon-eye-open"></i></a>';
	                            edit = '<a href="'+full.actions.crudRoute+'/'+full.id+'/edit" class="btn btn-info">Edit <i class="glyphicon glyphicon-pencil"></i></a>';
	                            del =  '<form style="display: inline;" method="POST" action="'+full.actions.crudRoute+'/'+full.id+'"><input type="hidden" name="_token" value="'+$('#csrf_token').val()+'"/><input name="_method" type="hidden" value="DELETE" /><button type="submit" class="btn btn-danger">Delete <i class="glyphicon glyphicon-trash"></i></button></form>';
	                            return view + edit + del;
	                        },
	                        targets: -1
	                    }
	                ],
	                drawCallback: function( settings ) {
	                    $('.btn-danger').click(function(e){
	                        e.preventDefault();
	                        var that = $(this);
	                        swal({   
	                            title: "Are you sure you want to delete row?",
	                            text: "You will not be able to recover this!",
	                            type: "warning",
	                            showCancelButton: true,
	                            closeOnConfirm: true,
	                            closeOnCancel: true,
	                            showLoaderOnConfirm: true,
	                        }, function(isConfirm){   
	                            if (isConfirm) {
	                                that.parent('form').submit();
	                            }
	                        });
	                    });
	                }
	            });

	            // Apply the search
	            table.columns().every( function () {
	                var that = this;
	         
	                $( 'input', this.footer() ).on( 'keyup change', function () {
	                    if ( that.search() !== this.value ) {
	                        that
	                            .search( this.value )
	                            .draw();
	                    }
	                } );
	            } );

	        });
	    </script>

		@include('lara_crud::laracrudflash')

	</body>
	
</html>