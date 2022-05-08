@extends("front.master.main")

@section("content")

    <div class="main-container container pt-80 pb-80" id="main-container">
        <!-- post content -->
        <div class="blog__content mb-72">
            <div class="container text-center">
                <h1 class="page-404-number">404</h1>
                <h2>Page not found</h2>
                <p>Don't fret! Let's get you back on track. Perhaps searching can help</p>

                <div class="row justify-content-center mt-40">

                    <div class="col-md-6">
                        <!-- Search form -->
                        <form role="search" method="get" class="search-form relative" action="{{ url('search') }}">
                            <input type="search" name="term" class="widget-search-input mb-0" placeholder="Search an article">
                            <button type="submit" class="widget-search-button btn btn-color"><i class="ui-search widget-search-icon"></i></button>
                        </form>

                        <!-- Back to home -->
                        <a href="{{ url("/") }}" class="btn btn-lg btn-light mt-40"><span>Back to Home</span></a>
                    </div>

                </div> <!-- end row -->

            </div> <!-- end container -->
        </div> <!-- end post content -->
    </div>

@endsection