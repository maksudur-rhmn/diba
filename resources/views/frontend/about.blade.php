@extends('layouts.frontend')

@section('content')
    	<!--************************************
				Home Banner Start				
		*************************************-->
        @include('includes.about.banner')
		<!--************************************
				Home Banner End					
		*************************************-->
		<!--************************************
				Main Start						
		*************************************-->
		<main id="tg-main" class="tg-main tg-haslayout tg-paddingzero">
			<!--************************************
					Welcome to Medlink Start		
			*************************************-->
			@include('includes.about.welcome')
			<!--************************************
					Welcome to Medlink End			
			*************************************-->
			<!--************************************
					Statistics Start				
			*************************************-->
			@include('includes.about.stats')
			<!--************************************
						Statistics End				
			*************************************-->
			<!--************************************
						Trusted Start				
			*************************************-->
			@include('includes.about.trusted')
			<!--************************************
						Trusted End					
			*************************************-->
		</main>
@endsection