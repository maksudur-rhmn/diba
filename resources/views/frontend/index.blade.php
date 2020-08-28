@extends('layouts.frontend')
@section('content')


        <!--************************************
				Home Banner Start				
	*************************************-->
       @include('includes.index.banner')
        <!--************************************
				Home Banner End					
        *************************************-->
        <!--************************************
				Main Start						
	*************************************-->
        <main id="tg-main" class="tg-main tg-haslayout">
        <!-- Works Section Start -->
        @include('includes.index.works')
        <!-- Works Section End -->
        <!--************************************
                Featured DiretPost Start		
        *************************************-->
            @include('includes.index.featured')
        <!--************************************
                Featured DiretPost End			
        *************************************-->
        <!--************************************
                Trusted By Many Start			
        *************************************-->
        @include('includes.index.sponsor')
        <!--************************************
                Trusted By Many Start			
        *************************************-->
        <!-- Latest Articles Start -->
            @include('includes.index.blog')
        <!-- Latest Articles End -->
        </main>
        <!--************************************
				Main End
	*************************************-->
    
@endsection