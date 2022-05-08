 <!-- Footer -->
 <footer class="footer footer--dark">
        <div class="container">
          <div class="footer__widgets">
            <div class="row">
  
              <div class="col-lg-3 col-md-6">
                <aside class="widget widget-logo">
                  <a href="{{ url('/') }}">
                    {{-- <img src="{{asset('images/sportco_white-01.svg')}}" srcset="{{asset('images/sportco_white-01.svg')}} 1x" class="logo__img" alt=""> --}}
                  </a>

                  {{-- <p class="copyright">
                      {{ date('Y') }} &copy; SPORTCO
                  </p> --}}

                    <p class="mb-4">
                        For Partnerships and Sponsored Content
                        write to us  {{-- <a href="mailto:partners@sportco.io">partners@sportco.io</a> --}}
                    </p>
                  <div class="socials socials--large socials--rounded mb-24">
                    <a href="javascript:void(0)" class="social social-facebook" aria-label="facebook"><i class="ui-facebook"></i></a>
                    <a href="javascript:void(0)" class="social social-twitter" aria-label="twitter"><i class="ui-twitter"></i></a>
                    <a href="javascript:void(0)" class="social social-youtube" aria-label="youtube"><i class="ui-youtube"></i></a>
                    {{--<a class="social social-medium" href="https://medium.com/@social_72044"><i class="fab fa-medium-m"></i></a>--}}
<a class="social social-linkedin" href="javascript:void(0)">
  <i class="ui-linkedin"></i></a>
{{--<a class="social social-slack" href="http://sportcoworkspace.slack.com/"><i class="fab fa-slack-hash"></i></a>--}}
<a class="social social-telegram" href="javascript:void(0)"><i class="fab fa-telegram-plane"></i></a>
                  </div>
                </aside>
              </div>
              <div class="col-lg-2 col-md-6">
                    <aside class="widget widget_nav_menu">
                      <h4 class="widget-title">Useful Links</h4>
                      <ul>
                        {{-- <li><a href="{{ url('about') }}" target="_blank">About</a></li> --}}
                        {{--<li><a target="_blank" href="https://tokensale.sportco.io">Token Sale</a></li>--}}
                        
                        <li><a href="{{ route('play-game') }}">Play</a></li>
                          <a class="" href="mailto:info@sportco.io" style="">
                              Contact Us
                          </a>
                        
                      </ul>
                    </aside>
                  </div>
                  <div class="col-lg-4 col-md-6">
                        <aside class="widget widget-popular-posts">
                          <h4 class="widget-title">Trending</h4>
                          {{-- <ul class="post-list-small">
                              <li class="post-list-small__item">
                                <article class="post-list-small__entry clearfix">
                                  <div class="post-list-small__img-holder">
                                    <div class="thumb-container thumb-100">
                                      <a href="single-post.html">
                                        <img data-src="img/content/post_small/post_small_1.jpg" src="img/content/post_small/post_small_1.jpg" alt="" class="post-list-small__img--rounded lazyloaded">
                                      </a>
                                    </div>
                                  </div>
                                  <div class="post-list-small__body">
                                    <h3 class="post-list-small__entry-title">
                                      <a href="single-post.html">Follow These Smartphone Habits of Successful Entrepreneurs</a>
                                    </h3>
                                    <ul class="entry__meta">
                                      <li class="entry__meta-author">
                                        <span>by</span>
                                        <a href="#">DeoThemes</a>
                                      </li>
                                      <li class="entry__meta-date">
                                        Jan 21, 2018
                                      </li>
                                    </ul>
                                  </div>                  
                                </article>
                              </li>
                              <li class="post-list-small__item">
                                <article class="post-list-small__entry clearfix">
                                  <div class="post-list-small__img-holder">
                                    <div class="thumb-container thumb-100">
                                      <a href="single-post.html">
                                        <img data-src="img/content/post_small/post_small_2.jpg" src="img/content/post_small/post_small_2.jpg" alt="" class="post-list-small__img--rounded lazyloaded">
                                      </a>
                                    </div>
                                  </div>
                                  <div class="post-list-small__body">
                                    <h3 class="post-list-small__entry-title">
                                      <a href="single-post.html">Lose These 12 Bad Habits If You're Serious About Becoming a Millionaire</a>
                                    </h3>
                                    <ul class="entry__meta">
                                      <li class="entry__meta-author">
                                        <span>by</span>
                                        <a href="#">DeoThemes</a>
                                      </li>
                                      <li class="entry__meta-date">
                                        Jan 21, 2018
                                      </li>
                                    </ul>
                                  </div>                  
                                </article>
                              </li>
                            </ul> --}}


                            <ul class="post-list-small footerouter">
                              {!! trendingFooter() !!}
                          </ul>
                        </aside>              
                      </div>
                      <div class="col-lg-3 col-md-6">
                            <aside class="widget widget_mc4wp_form_widget">
                              <h4 class="widget-title">Newsletter</h4>
                              <p class="newsletter__text">
                                <i class="ui-email newsletter__icon"></i>
                                Subscribe for our daily news
                              </p>
                                <form class="mc4wp-form newsletter fnewsletter" method="post" id="newsletter">
                                    <br/>
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="name" placeholder="Name" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" placeholder="Email" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" id="alertsclick" class="btn btn-lg btn-color" value="Sign Up">
                                    </div>

                                </form>
                            </aside>


                      </div>


            </div>
          </div>    
        </div> <!-- end container -->
      </footer> <!-- end footer -->
  
      <div id="back-to-top">
        <a href="#top" aria-label="Go to top"><i class="ui-arrow-up"></i></a>
      </div>
  
    </main> <!-- end main-wrapper -->
 <!-- The Modal -->
 <div class="modal" id="nickname">
     <div class="modal-dialog">
         <div class="modal-content">

             <!-- Modal Header -->
             <div class="modal-header">
                 <h4 class="modal-title">Update Your User name</h4>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
             </div>

             <!-- Modal body -->
             <div class="modal-body">
                 <p class="">This username will be your identity on the Sportco platform. You should choose a username that’s friendly and accessible.<br/><br/>
                     Incase you do not choose a username your actual name will be displayed. We highly recommend that you choose a username now.</p>
                 <form action="" id="n_nameupdate" method="POST">
                     @csrf


                         <label>User Name</label>
                         <input type="text" class="form-control"  name="username" value="" required/>

                             <div class="alert alert-danger" id="usererror" style="display: none;">

                             </div>

                         <button type="submit" class="btn btn-lg btn-color btn-button">Save</button>


                 </form>
             </div>



         </div>
     </div>
 </div>
 