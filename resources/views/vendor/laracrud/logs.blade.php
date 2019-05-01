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
		            <a class="navbar-brand" href="#">Admin</a>
		        </div>

		        <!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a href="{{ url('/example') }}">Example <span class="sr-only">(current)</span></a></li>
					</ul>
				</div><!-- /.navbar-collapse -->

		    </div><!-- /.container-fluid -->
		</nav>

		@if (isset($error))

            <div class="alert alert-danger" role="alert">{!! $error !!}</div>
            
        @else

			<ul class="list-group">

	        @foreach ($paginator as $item)
	            <li class="list-group-item">
	        @if ($history->userResponsible())
		        @if($item->key == 'created_at' && !$item->old_value)
		            {{ $item->userResponsible()->name }} created this {{ get_class($item->revisionable) }} - {{ $item->revisionable->id }}] resource at {{ $item->newValue() }} ({{ $item->created_at->diffForHumans() }})
		        @else
		            {{ $item->userResponsible()->name }} changed {{ $item->fieldName() }} from {{ $item->oldValue() }} to {{ $item->newValue() }} ({{ $item->created_at->diffForHumans() }})
		        @endif
		    @else
		    	@if($item->key == 'created_at' && !$item->old_value)
		            [{{ get_class($history->revisionable()->get()[0]) }} - {{ $history->revisionable()->get()[0]->id }}] resource created at {{ $history->newValue() }} ({{ $history->created_at->diffForHumans() }})
		        @else
		            Resource [{{ get_class($history->revisionable()->get()[0]) }}] changed {{ $history->fieldName() }} from {{ $history->oldValue() }} to {{ $history->newValue() }} ({{ $history->created_at->diffForHumans() }})
		        @endif
		        </li>
			@endforeach

			</ul>

	        {!! $paginator->render() !!}

	     @endif

	</body>
	
</html>