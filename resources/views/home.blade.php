@include('components_layout.header')
@include('components_layout.start_banner')
@include('components_layout.about')
@include('components_layout.registration_info')
@include('components_layout.services')


					<!-- Start Case Studies -->
					{{-- <section class="lqd-section case-studies pt-55 pb-120">
						<div class="container">
							<div class="row justify-center">
								<div class="col col-12 col-xl-4 col-md-8 mb-25 p-0 text-center module-title">
									<div class="ld-fancy-heading relative">
										<h2 class="ld-fh-element relative mb-0/5em">Case Studies</h2>
									</div>
									<div class="ld-fancy-heading relative">
										<p class="ld-fh-element mb-0/5em inline-block relative text-16 leading-1/6em">Passionate about solving problems through creative communications. </p>
									</div>
								</div>
								<div class="col col-12">
									<div class="lqd-pf-grid">
										<div class="liquid-filter-items items-center justify-between">
											<div class="liquid-filter-items-inner flex-grow-1">
												<span class="liquid-filter-items-label">Filter by</span>
												<ul class="filter-list filter-list-inline flex items-center md:hidden" id="pf-filter-case-stuies">
													<li class="active text-black" data-filter="*">
														<span>All</span>
														<sup class="lqd-filter-counter"></sup>
													</li>
													<li class="text-black" data-filter=".branding">
														<span>Branding</span>
														<sup class="lqd-filter-counter"></sup>
													</li>
													<li class="text-black" data-filter=".digital-design">
														<span>Digital Design</span>
														<sup class="lqd-filter-counter"></sup>
													</li>
													<li class="text-black" data-filter=".ecommerce">
														<span>Ecommerce</span>
														<sup class="lqd-filter-counter"></sup>
													</li>
												</ul>
												<div class="lqd-filter-dropdown hidden md:block" data-form-options='{ "dropdownAppendTo":  "self" }'>
													<div class="lqd-select-dropdown">
														<div class="ui-selectmenu-menu ui-front">
															<ul aria-hidden="true" aria-labelledby="lqd-filter-dropdown-pf-filter-case-stuies-button" id="lqd-filter-dropdown-pf-filter-case-stuies-menu" role="listbox" tabindex="0" class="ui-menu ui-corner-bottom ui-widget ui-widget-content"></ul>
														</div>
													</div>
													<span tabindex="0" id="lqd-filter-dropdown-pf-filter-case-stuies-button" role="combobox" aria-expanded="false" aria-autocomplete="list" aria-owns="lqd-filter-dropdown-pf-filter-case-stuies-menu" aria-haspopup="true" class="ui-selectmenu-button ui-selectmenu-button-closed ui-corner-all ui-button ui-widget">
														<span class="ui-selectmenu-icon ui-icon ui-icon-triangle-1-s"></span>
														<span class="ui-selectmenu-text">All</span>
													</span>
												</div>
												<a href="#contact-modal" class="btn btn-naked btn-icon-right text-15 font-medium text-gray-400 hover:text-primary" data-lity="#contact-modal">
													<span class="flex items-center">
														<span class="btn-txt" data-text="See More">See More</span>
														<span class="btn-icon">
															<i class="lqd-icn-ess icon-md-arrow-forward"></i>
														</span>
													</span>
												</a>
											</div>
										</div>
										<div class="lqd-pf-row row flex flex-wrap relative -mr-10 -ml-10" data-liquid-masonry="true" data-masonry-options='{ "filtersID":  "#pf-filter-case-stuies" ,  "filtersCounter":  true }'>
											<div class="lqd-pf-column col-md-6 col-12 col-xs-12 masonry-item digital-design ecommerce portfolio-single py-0 px-10">
												<article class="lqd-pf-item lqd-pf-item-style-1 lqd-pf-dark pf-details-h-end relative overflow-hidden liquid-portfolio type-liquid-portfolio status-publish format-standard has-post-thumbnail hentry liquid-portfolio-category-digital-design liquid-portfolio-category-ecommerce liquid-portfolio-category-portfolio-single mb-25 rounded-10">
													<div class="lqd-pf-item-inner">
														<div class="lqd-pf-img">
															<figure>
																<figure class="w-full">
																	<img width="1116" height="524" src="./assets/images/demo/start-hub-2/case-study/pf-1-1.jpg" class="w-full" alt="case Studies">
																</figure>
															</figure>
														</div>
														<div class="lqd-pf-details flex flex-wrap relative">
															<span class="lqd-pf-overlay-bg lqd-overlay flex"></span>
															<div class="lqd-pf-info flex flex-wrap items-center justify-between w-full px-1/5em py-1/5em bg-white rounded-4">
																<h5 class="lqd-pf-title mt-0 mb-0">Nexa Mobile</h5>
																<ul class="reset-ul inline-nav lqd-pf-cat inline-flex relative z-2">
																	<li><a href="#">Digital Design</a></li>
																</ul>
															</div>
														</div>
														<a href="./assets/images/demo/start-hub-2/case-study/pf-1-1.jpg" class="lqd-overlay flex lqd-pf-overlay-link fresco" data-fresco-group="portfolio"></a>
													</div>
												</article>
											</div>
											<div class="lqd-pf-column col-md-6 col-12 col-xs-12 masonry-item ecommerce masonry portfolio-single py-0 px-10">
												<article class="lqd-pf-item lqd-pf-item-style-1 lqd-pf-dark pf-details-h-end relative overflow-hidden liquid-portfolio type-liquid-portfolio status-publish format-standard has-post-thumbnail hentry liquid-portfolio-category-ecommerce liquid-portfolio-category-masonry liquid-portfolio-category-portfolio-single mb-25 rounded-10">
													<div class="lqd-pf-item-inner">
														<div class="lqd-pf-img">
															<figure>
																<figure class="w-full">
																	<img width="1116" height="1106" src="./assets/images/demo/start-hub-2/case-study/pf-2.jpg" class="w-full" alt="case Studies">
																</figure>
															</figure>
														</div>
														<div class="lqd-pf-details flex flex-wrap relative">
															<span class="lqd-pf-overlay-bg lqd-overlay flex"></span>
															<div class="lqd-pf-info flex flex-wrap items-center justify-between w-full px-1/5em py-1/5em bg-white rounded-4">
																<h5 class="lqd-pf-title mt-0 mb-0">Aliens do 3D Automobile</h5>
																<ul class="reset-ul inline-nav lqd-pf-cat inline-flex relative z-2">
																	<li><a href="#">Ecommerce</a></li>
																</ul>
															</div>
														</div>
														<a href="./assets/images/demo/start-hub-2/case-study/pf-2.jpg" class="lqd-overlay flex lqd-pf-overlay-link fresco" data-fresco-group="portfolio"></a>
													</div>
												</article>
											</div>
											<div class="lqd-pf-column col-md-6 col-lg-3 col-12 col-xs-12 masonry-item branding custom-print masonry portfolio-single py-0 px-10">
												<article class="lqd-pf-item lqd-pf-item-style-1 lqd-pf-dark pf-details-h-end relative overflow-hidden liquid-portfolio type-liquid-portfolio status-publish format-standard has-post-thumbnail hentry liquid-portfolio-category-branding liquid-portfolio-category-custom-print liquid-portfolio-category-masonry liquid-portfolio-category-portfolio-single mb-25 rounded-10">
													<div class="lqd-pf-item-inner">
														<div class="lqd-pf-img">
															<figure>
																<figure class="w-full">
																	<img width="520" height="520" src="./assets/images/demo/start-hub-2/case-study/pf-3.jpg" class="w-full" alt="case Studies">
																</figure>
															</figure>
														</div>
														<div class="lqd-pf-details flex flex-wrap relative">
															<span class="lqd-pf-overlay-bg lqd-overlay flex"></span>
															<div class="lqd-pf-info flex flex-wrap items-center justify-between w-full px-1/5em py-1/5em bg-white rounded-4">
																<h5 class="lqd-pf-title mt-0 mb-0">Photo Retouching</h5>
																<ul class="reset-ul inline-nav lqd-pf-cat inline-flex relative z-2">
																	<li><a href="#">Branding</a></li>
																</ul>
															</div>
														</div>
														<a href="./assets/images/demo/start-hub-2/case-study/pf-3.jpg" class="lqd-overlay flex lqd-pf-overlay-link fresco" data-fresco-group="portfolio"></a>
													</div>
												</article>
											</div>
											<div class="lqd-pf-column col-md-6 col-lg-3 col-12 col-xs-12 masonry-item branding digital-design masonry portfolio-single py-0 px-10">
												<article class="lqd-pf-item lqd-pf-item-style-1 lqd-pf-dark pf-details-h-end relative overflow-hidden liquid-portfolio type-liquid-portfolio status-publish format-standard has-post-thumbnail hentry liquid-portfolio-category-branding liquid-portfolio-category-digital-design liquid-portfolio-category-masonry liquid-portfolio-category-portfolio-single mb-25 rounded-10">
													<div class="lqd-pf-item-inner">
														<div class="lqd-pf-img">
															<figure>
																<figure class="w-full">
																	<img width="520" height="520" src="./assets/images/demo/start-hub-2/case-study/pf-4.jpg" class="w-full" alt="case Studies">
																</figure>
															</figure>
														</div>
														<div class="lqd-pf-details flex flex-wrap relative">
															<span class="lqd-pf-overlay-bg lqd-overlay flex"></span>
															<div class="lqd-pf-info flex flex-wrap items-center justify-between w-full px-1/5em py-1/5em bg-white rounded-4">
																<h5 class="lqd-pf-title mt-0 mb-0">Kontrast</h5>
																<ul class="reset-ul inline-nav lqd-pf-cat inline-flex relative z-2">
																	<li><a href="#">Branding</a></li>
																</ul>
															</div>
														</div>
														<a href="./assets/images/demo/start-hub-2/case-study/pf-4.jpg" class="lqd-overlay flex lqd-pf-overlay-link fresco" data-fresco-group="portfolio"></a>
													</div>
												</article>
											</div>
										</div>
									</div>
								</div>
								<div class="col col-12 text-center">
									<a href="#" class="btn btn-naked btn-icon-right btn-icon-circle btn-icon-custom-size btn-icon-solid btn-icon-ripple text-black" target="_blank">
										<span class="btn-txt" data-text="See more projects">See more projects</span>
										<span class="btn-icon w-30 h-30 text-black bg-slate-100">
											<i aria-hidden="true" class="lqd-icn-ess icon-ion-ios-add"></i>
										</span>
									</a>
								</div>
							</div>
						</div>
					</section> --}}
					<!-- End Case Studies -->
@include('components_layout.how_it_works')

					<!-- Start Experiences -->
					<section class="lqd-section experiences pt-45 pb-95 relative">
						<div class="container">
							<div class="row">
								<div class="w-40percent flex lg:w-full p-0" data-custom-animations="true" data-ca-options='{"animationTarget": "img", "startDelay" : 200, "ease": "power4.out", "initValues": {"y": "45px", "opacity" : 0} , "animations": {"y": "0px", "opacity" : 1}}'>
									<div class="w-full flex flex-wrap items-center justify-center relative p-15">
										<div class="w-auto absolute top-0 module-img-1" data-parallax="true" data-parallax-options='{"ease": "linear", "start": "top bottom", "end": "bottom+=0px top"}' data-parallax-from='{"x": "45px"}' data-parallax-to='{"x": "0px"}'>
											<img width="90" height="65" src="./assets/images/demo/start-hub-2/3D/patt.svg" alt="3D Shape dots">
										</div>
										<div class="w-auto absolute top-0 module-img-2" data-parallax="true" data-parallax-options='{"ease": "linear", "start": "top bottom", "end": "bottom-=100% top"}' data-parallax-from='{"x": "48px", "y": "200px"}' data-parallax-to='{"x": "0px", "y": "0px"}'>
											<img width="121" height="121" src="./assets/images/demo/start-hub-2/experience/thumb-6.png" alt="experiences">
										</div>
										<div class="w-auto absolute -top-10percent module-img-3" data-parallax="true" data-parallax-options='{"ease": "linear", "start": "top bottom", "end": "bottom-=100% top"}' data-parallax-from='{"x": "-90px", "y": "230px"}' data-parallax-to='{"x": "0px", "y": "0px"}'>
											<img width="127" height="127" src="./assets/images/demo/start-hub-2/experience/Group-30499@2x.png" alt="experiences">
										</div>
										<div class="w-auto relative z-1 module-img-4" data-parallax="true" data-parallax-options='{"ease": "linear", "start": "top bottom", "end": "bottom-=100% top"}' data-parallax-from='{"y": "95px"}' data-parallax-to='{"x": "0px", "y": "0px"}'>
											<img width="213" height="213" src="./assets/images/demo/start-hub-2/experience/deecfe7e5b08bc77341f2b4318f55340.png" alt="experiences">
										</div>
										<div class="w-auto absolute bottom-25percent z-1 module-img-5" data-parallax="true" data-parallax-options='{"ease": "linear", "start": "top bottom", "end": "bottom+=0px top"}' data-parallax-from='{"x": "-80px", "y": "65px", "scaleX" : 1.2, "scaleY" : 1.2}' data-parallax-to='{"x": "0px", "y": "0px", "scaleX" : 1, "scaleY" : 1}'>
											<img width="34" height="34" src="./assets/images/demo/start-hub-2/3D/circle.svg" alt="3D Shape circle">
										</div>
									</div>
								</div>
								<div class="w-60percent flex flex-col p-15 lg:w-full" data-custom-animations="true" data-ca-options='{"animationTarget": ".animation-element", "startDelay" : 200, "ease": "power4.out", "initValues": {"x": "-30px", "opacity" : 0} , "animations": {"x": "0px", "opacity" : 1}}'>
									<div class="w-full flex flex-wrap bg-white rounded-10 shadow-md transition-all">
										<div class="w-33percent sm:w-full">
											<div class="flex flex-col border-right border-black-10 pt-45 px-30 pb-60 sm:border-right-0 sm:border-bottom animation-element">
												<div class="ld-fancy-heading relative">
													<h2 class="ld-fh-element ld-gradient-heading relative bg-transparent mb-0/5em" style="background-image: linear-gradient(180deg, #4452F2 0%, #F2DFDF 100%);">10+</h2>
												</div>
												<div class="ld-fancy-heading relative">
													<h6 class="ld-fh-element relative mb-2em">Years of Operation</h6>
												</div>
												<div class="ld-fancy-heading relative">
													<p class="ld-fh-element mb-0/5em inline-block relative text-16 leading-1/6em">Our team have been running well about 10 years and keep going.</p>
												</div>
											</div>
										</div>
										<div class="w-33percent sm:w-full">
											<div class="flex flex-col border-right border-black-10 pt-45 px-30 pb-60 sm:border-right-0 sm:border-bottom animation-element">
												<div class="ld-fancy-heading relative">
													<h2 class="ld-fh-element ld-gradient-heading relative bg-transparent mb-0/5em" style="background-image: linear-gradient(180deg, #4452F2 0%, #F2DFDF 100%);">98%</h2>
												</div>
												<div class="ld-fancy-heading relative">
													<h6 class="ld-fh-element relative mb-2em">Positive Feedback</h6>
												</div>
												<div class="ld-fancy-heading relative">
													<p class="ld-fh-element mb-0/5em inline-block relative text-16 leading-1/6em">Our team have been running well about 10 years and keep going.</p>
												</div>
											</div>
										</div>
										<div class="w-33percent sm:w-full">
											<div class="flex flex-col pt-45 px-30 pb-60 animation-element">
												<div class="ld-fancy-heading relative">
													<h2 class="ld-fh-element ld-gradient-heading relative bg-transparent mb-0/5em" style="background-image: linear-gradient(180deg, #4452F2 0%, #F2DFDF 100%);">2,664</h2>
												</div>
												<div class="ld-fancy-heading relative">
													<h6 class="ld-fh-element relative mb-2em">Projects Completed</h6>
												</div>
												<div class="ld-fancy-heading relative">
													<p class="ld-fh-element mb-0/5em inline-block relative text-16 leading-1/6em">Our team have been running well about 10 years and keep going.</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
					<!-- End Experiences -->

					<!-- Start Clients -->
					{{-- <section class="lqd-section clients py-30" id="clients" data-custom-animations="true" data-ca-options='{"animationTarget": "p, .animation-element", "ease": "power4.out", "initValues": {"y": "45px", "opacity" : 0} , "animations": {"y": "0px", "opacity" : 1}}'>
						<div class="container p-0">
							<div class="row m-0">
								<div class="col col-12 text-start p-0">
									<div class="mb-10 ld-fancy-heading relative p">
										<p class="ld-fh-element mb-0/5em inline-block relative text-14 font-medium">These world-class teams are already using Hub</p>
									</div>
								</div>
								<div class="col col-12 p-0" data-custom-animations="true" data-ca-options='{"animationTarget": "img", "duration" : 1800, "delay" : 120, "ease": "power4.out", "initValues": {"scaleX" : 1.3, "scaleY" : 1.3, "opacity" : 0} , "animations": {"scaleX" : 1, "scaleY" : 1, "opacity" : 1}}'>
									<div class="py-35 px-10 border-1 border-black-10 rounded-4 animation-element">
										<div class="container-fluid">
											<div class="row items-center">
												<div class="col col-6 col-md-2 text-center p-10 module-col">
													<img width="111" height="33" src="./assets/images/demo/start-hub-2/client/spotify-1-1.svg" alt="spotify">
												</div>
												<div class="col col-6 col-md-2 text-center p-10 module-col">
													<img width="65" height="23" src="./assets/images/demo/start-hub-2/client/nike-1.svg" alt="nike">
												</div>
												<div class="col col-6 col-md-2 text-center p-10 module-col">
													<img width="75" height="17" src="./assets/images/demo/start-hub-2/client/amd-logo-1-1.svg" alt="amd">
												</div>
												<div class="col col-6 col-md-2 text-center p-10 module-col">
													<img width="73" height="19" src="./assets/images/demo/start-hub-2/client/Path-43398.svg" alt="apper">
												</div>
												<div class="col col-6 col-md-2 text-center p-10">
													<img width="85" height="25" src="./assets/images/demo/start-hub-2/client/logitech-2-1-1.svg" alt="logitech">
												</div>
												<div class="col col-6 col-md-2 text-center p-10">
													<img width="74" height="36" src="./assets/images/demo/start-hub-2/client/levis.svg" alt="levis">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section> --}}
					<!-- End Clients -->

{{-- @include('components_layout.testimonials') --}}
@include('components_layout.latest_blog')

					<!-- Start Connect Top -->
					<section class="lqd-section connect-top pt-10 relative">
						<div class="ld-particles-container w-full lqd-particles-as-bg lqd-overlay flex lqd-particle pointer-events-none">
							<div class="ld-particles-inner lqd-overlay flex" id="lqd-particle" data-particles="true" data-particles-options='{"particles": {"number": {"value" : 6} , "color": {"value" : ["#FDA44C", "#604CFD", "#0FBBB4", "#F85976"]} , "shape": {"type" : ["circle"]} , "opacity": {"value" : 1} , "size": {"value" : 4} , "move": {"enable": true, "direction": "none", "out_mode": "bounce"}} , "interactivity" : [], "retina_detect": true}'></div>
						</div>
						<div class="container">
							<div class="row">
								<div class="col col-12 text-center" data-custom-animations="true" data-ca-options='{"animationTarget": "h2, p, .btn", "ease": "power4.out", "initValues": {"y": "45px", "rotationY" : 65, "opacity" : 0} , "animations": {"y": "0px", "rotationY" : 0, "opacity" : 1}}'>
									<div class="ld-fancy-heading relative">
										<h2 class="ld-fh-element relative heading-title lqd-highlight-custom lqd-highlight-custom-2 text-46 mb-0/75em text-gray-600" data-inview="true" data-transition-delay="true" data-delay-options='{"elements": ".lqd-highlight-inner", "delayType": "transition"}'>
											<span>Have a project in mind? Let's </span>
											<mark class="lqd-highlight">
												<span class="lqd-highlight-txt">connect</span>
												<span class="lqd-highlight-inner bottom-0 left-0">
													<svg class="lqd-highlight-pen" width="51" height="51" viewbox="0 0 51 51" xmlns="http://www.w3.org/2000/svg">
														<path d="M36.204 1.044C32.02 2.814 5.66 31.155 4.514 35.116c-.632 2.182-1.75 5.516-2.483 7.409-3.024 7.805-1.54 9.29 6.265 6.265 1.893-.733 5.227-1.848 7.41-2.477 3.834-1.105 4.473-1.647 19.175-16.27 0 0 10.63-10.546 15.21-15.125C53 8.997 42.021-1.418 36.203 1.044Zm7.263 5.369c3.56 3.28 4.114 4.749 2.643 6.995l-1.115 1.7-4.586-4.543-4.585-4.544 1.42-1.157C39.311 3.18 40.2 3.4 43.467 6.413ZM37.863 13.3l4.266 4.304-11.547 11.561-11.547 11.561-4.48-4.446-4.481-4.447 11.404-11.418c6.273-6.28 11.566-11.42 11.762-11.42.197 0 2.277 1.938 4.623 4.305ZM12.016 39.03l3.54 3.584-3.562 1.098-5.316 1.641c-1.665.516-1.727.455-1.211-1.21l1.614-5.226c1.289-4.177.685-4.191 4.935.113Z"></path>
													</svg>
													<svg class="lqd-highlight-brush-svg lqd-highlight-brush-svg-2" width="233" height="13" viewbox="0 0 233 13" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveaspectratio="none">
														<path d="m.624 9.414-.312-2.48C0 4.454.001 4.454.002 4.454l.035-.005.102-.013.398-.047c.351-.042.872-.102 1.557-.179 1.37-.152 3.401-.368 6.05-.622C13.44 3.081 21.212 2.42 31.13 1.804 50.966.572 79.394-.48 113.797.24c34.387.717 63.927 2.663 84.874 4.429a1048.61 1048.61 0 0 1 24.513 2.34 641.605 641.605 0 0 1 8.243.944l.432.054.149.02-.318 2.479-.319 2.48-.137-.018c-.094-.012-.234-.03-.421-.052a634.593 634.593 0 0 0-8.167-.936 1043.26 1043.26 0 0 0-24.395-2.329c-20.864-1.76-50.296-3.697-84.558-4.413-34.246-.714-62.535.332-82.253 1.556-9.859.612-17.574 1.269-22.82 1.772-2.622.251-4.627.464-5.973.614a213.493 213.493 0 0 0-1.901.22l-.094.01-.028.004Z"></path>
													</svg>
												</span>
											</mark>
										</h2>
									</div>
									<div class="mb-25">
										<p class="text-18 font-medium leading-1/15em">
											<span class="text-blue-400">We have three projects with this template and that is because we love the design,</span>
											<span>the large number of possibilities.</span>
										</p>
									</div>
									<a href="#contact-modal" class="btn btn-solid btn-hover-txt-liquid-y btn-icon-right btn-hover-reveal rounded-100 bg-transparent py-20 px-50 text-white" data-lity="#contact-modal">
										<span class="btn-txt" data-text="Send a Message" data-split-text="true" data-split-options='{"type":  "chars, words"}'>Send a Message</span>
										<span class="btn-icon text-1em">
											<i aria-hidden="true" class="lqd-icn-ess icon-md-arrow-forward"></i>
										</span>
									</a>
								</div>
							</div>
						</div>
					</section>
					<!-- End Connect Top -->

					<!-- Start Connect Bottom -->
					<section class="lqd-section connect-bottom relative -mb-200 z-2" id="contact">
						<div class="container">
							<div class="row items-center">
								<div class="w-25percent lg:w-20percent"></div>
								<div class="w-50percent lg:w-60percent sm:w-full">
									<div class="w-full relative flex p-15">
										<div class="w-full flex flex-wrap bg-white transition-all shadow-md -mb-90 mt-0 rounded-6">
											<div class="w-50percent flex flex-col sm:w-full">
												<div class="module py-35 pr-50 pl-65 border-right border-black-10 transition-all sm:border-right-0 sm:border-bottom">
													<div class="ld-fancy-heading relative">
														<h6 class="ld-fh-element relative font-normal mb-0/75em">Project Offers</h6>
													</div>
													<div class="ld-fancy-heading relative">
														<h2 class="ld-fh-element relative text-nightblue text-20 mb-0">info.liquid.com</h2>
													</div>
												</div>
											</div>
											<div class="w-50percent flex flex-col sm:w-full">
												<div class="module py-35 pr-50 pl-65 transition-all">
													<div class="ld-fancy-heading relative">
														<h6 class="ld-fh-element relative font-normal mb-0/75em">Consultation</h6>
													</div>
													<div class="ld-fancy-heading relative">
														<h2 class="ld-fh-element relative text-nightblue text-20 mb-0">+ 1 223 38 87</h2>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="w-25percent lg:w-20percent sm:hidden">
									<div class="lqd-imggrp-single block relative" data-float="ease-in">
										<div class="lqd-imggrp-img-container inline-flex relative items-center justify-center">
											<figure class="w-full relative">
												<img width="500" height="552" src="./assets/images/demo/start-hub-2/3D/img.png" alt="shape">
											</figure>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
					<!-- End Connect Bottom -->

				</div>
			</main>

			<footer id="site-footer" class="main-footer">
				<section class="lqd-section footer-content pt-270 pb-100 relative bg-transparent transition-all" style="background-image: linear-gradient(180deg, #E5DFFC 0%, #fff 100%);">
					<div class="lqd-shape lqd-shape-top" data-negative="false">
						<svg class="lqd-custom-shape -rotate-180 h-220" fill="none" height="461" viewbox="0 0 1440 461" width="1440" xmlns="http://www.w3.org/2000/svg" preserveaspectratio="none">
							<path fill="#fff" class="lqd-shape-fill" d="m0 131.906 34.4-20.017c34.4-19.9 103.2-59.936 171.68-82.979 68.64-23.043 136.8-29.328003 205.44-4.306 68.48 25.022 137.28 81.35 205.76 80.768 68.64-.582 136.8-58.074 205.44-84.608 68.48-26.535 137.28-22.345 205.76-16.06 68.64 6.168 136.8 14.315 205.44 22.811 68.48 8.612 137.28 17.457 171.68 22l34.4 4.422v396.851h-1440z" fill-opacity=".09">
								<animate repeatcount="indefinite" fill="freeze" attributename="d" dur="10s" values="M0 131.906L34.4 111.889C68.8 91.989 137.6 51.953 206.08 28.91C274.72 5.867 342.88 -0.418001 411.52 24.604C480 49.626 548.8 105.954 617.28 105.372C685.92 104.79 754.08 47.298 822.72 20.764C891.2 -5.771 960 -1.581 1028.48 4.704C1097.12 10.872 1165.28 19.019 1233.92 27.515C1302.4 36.127 1371.2 44.972 1405.6 49.515L1440 53.937V450.788H0L0 131.906Z; M0 122.906L36.5 109C71.5 96.372 102.52 67.98 171 44.937C239.64 21.894 354.36 51.478 423 76.5C491.48 101.522 546.52 19.097 615 18.515C683.64 17.933 799.36 58.534 868 32C936.48 5.46499 1039.52 54.715 1108 61C1176.64 67.168 1190.36 -6.996 1259 1.5C1327.48 10.112 1371.2 35.972 1405.6 40.515L1440 44.937V441.788H0L0 122.906Z; M0 131.906L34.4 111.889C68.8 91.989 137.6 51.953 206.08 28.91C274.72 5.867 342.88 -0.418001 411.52 24.604C480 49.626 548.8 105.954 617.28 105.372C685.92 104.79 754.08 47.298 822.72 20.764C891.2 -5.771 960 -1.581 1028.48 4.704C1097.12 10.872 1165.28 19.019 1233.92 27.515C1302.4 36.127 1371.2 44.972 1405.6 49.515L1440 53.937V450.788H0L0 131.906Z">
								</animate>
							</path>
							<path fill="#fff" class="lqd-shape-fill" d="M0 154.75L34.4 142.201C68.8 129.53 137.6 104.433 206.08 99.072C274.72 93.833 342.88 108.453 411.52 122.099C480 135.622 548.8 148.293 617.28 142.811C685.92 137.329 754.08 113.693 822.72 113.693C891.2 113.693 960 137.329 1028.48 152.68C1097.12 168.153 1165.28 175.463 1233.92 184.966C1302.4 194.591 1371.2 206.287 1405.6 212.257L1440 218.105V452.025H0L0 154.75Z" fill-opacity=".28">
								<animate repeatcount="indefinite" fill="freeze" attributename="d" dur="8s" values="M0 154.75C0 154.75 12.8 142.902 34.4 142.201C56 141.5 140.02 160.111 208.5 154.75C277.14 149.511 334.36 112.57 403 126.216C471.48 139.739 552.52 190.448 621 184.966C689.64 179.484 745.36 116 814 116C882.48 116 950.52 161.149 1019 176.5C1087.64 191.973 1154.36 123.997 1223 133.5C1291.48 143.125 1371.2 206.287 1405.6 212.257L1440 218.105V452.025H0L0 154.75Z; M0 154.75C0 154.75 33.4 177.201 55 176.5C76.6 175.799 137.52 110.361 206 105C274.64 99.761 332.86 141.104 401.5 154.75C469.98 168.273 527.52 206.982 596 201.5C664.64 196.018 747.86 75 816.5 75C884.98 75 956.52 118.149 1025 133.5C1093.64 148.973 1163.36 87.497 1232 97C1300.48 106.625 1371.2 206.287 1405.6 212.257L1440 218.105V452.025H0L0 154.75Z; M0 154.75C0 154.75 12.8 142.902 34.4 142.201C56 141.5 140.02 160.111 208.5 154.75C277.14 149.511 334.36 112.57 403 126.216C471.48 139.739 552.52 190.448 621 184.966C689.64 179.484 745.36 116 814 116C882.48 116 950.52 161.149 1019 176.5C1087.64 191.973 1154.36 123.997 1223 133.5C1291.48 143.125 1371.2 206.287 1405.6 212.257L1440 218.105V452.025H0L0 154.75Z">
								</animate>
							</path>
							<path fill="#fff" class="lqd-shape-fill" d="M0 340.22L34.4 333.92C68.8 327.52 137.6 314.92 206.08 312.22C274.72 309.52 342.88 316.92 411.52 319.72C480 322.52 548.8 320.92 617.28 318.92C685.92 316.92 754.08 314.52 822.72 316.02C891.2 317.52 960 322.92 1028.48 309.42C1097.12 295.92 1165.28 263.52 1233.92 251.02C1302.4 238.52 1371.2 245.92 1405.6 249.52L1440 253.22V453.22H0L0 340.22Z">
								<animate repeatcount="indefinite" fill="freeze" attributename="d" dur="6.5s" values="M0 340.22L34.4 333.92C68.8 327.52 139.02 281.2 207.5 278.5C276.14 275.8 351.86 331.12 420.5 333.92C488.98 336.72 554.52 289 623 287C691.64 285 756.86 332.42 825.5 333.92C893.98 335.42 960 322.92 1028.48 309.42C1097.12 295.92 1163.36 236 1232 223.5C1300.48 211 1371.2 245.92 1405.6 249.52L1440 253.22V453.22H0L0 340.22Z; M0 340.22L37.5 323C71.9 316.6 137.52 336.62 206 333.92C274.64 331.22 339.86 272.2 408.5 275C476.98 277.8 551.02 304 619.5 302C688.14 300 759.36 266.5 828 268C896.48 269.5 962.02 336.5 1030.5 323C1099.14 309.5 1156.36 232.5 1225 220C1293.48 207.5 1364.1 249.62 1398.5 253.22L1440 253.22V453.22H0L0 340.22Z; M0 340.22L34.4 333.92C68.8 327.52 139.02 281.2 207.5 278.5C276.14 275.8 351.86 331.12 420.5 333.92C488.98 336.72 554.52 289 623 287C691.64 285 756.86 332.42 825.5 333.92C893.98 335.42 960 322.92 1028.48 309.42C1097.12 295.92 1163.36 236 1232 223.5C1300.48 211 1371.2 245.92 1405.6 249.52L1440 253.22V453.22H0L0 340.22Z">
								</animate>
							</path>
							<path fill="#fff" class="lqd-shape-fill" d="M1440 337.719L1405.6 340.219C1371.2 342.719 1302.4 347.719 1233.92 350.419C1165.28 353.019 1097.12 353.419 1028.48 352.219C960 351.019 891.2 348.419 822.72 357.019C754.08 365.719 685.92 385.719 617.28 395.919C548.8 406.019 480 406.419 411.52 395.919C342.88 385.419 274.72 364.019 206.08 359.419C137.6 354.719 68.8 366.719 34.4 372.719L0 378.719V460.719H1440V337.719Z">
								<animate repeatcount="indefinite" fill="freeze" attributename="d" dur="5.5s" values="M1440 337.719L1405.6 340.219C1371.2 342.719 1303.98 362.8 1235.5 365.5C1166.86 368.1 1090.14 324.2 1021.5 323C953.02 321.8 889.48 383.4 821 392C752.36 400.7 678.64 368.519 610 378.719C541.52 388.819 473.48 414.5 405 404C336.36 393.5 273.64 342.319 205 337.719C136.52 333.019 68.8 366.719 34.4 372.719L0 378.719V460.719H1440V337.719Z; M1440 337.719L1405.6 340.219C1371.2 342.719 1295.98 326.3 1227.5 329C1158.86 331.6 1081.64 391.2 1013 390C944.52 388.8 874.48 364.119 806 372.719C737.36 381.419 675.14 296.3 606.5 306.5C538.02 316.6 471.48 383.219 403 372.719C334.36 362.219 272.64 320.6 204 316C135.52 311.3 68.8 366.719 34.4 372.719L0 378.719V460.719H1440V337.719Z; M1440 337.719L1405.6 340.219C1371.2 342.719 1303.98 362.8 1235.5 365.5C1166.86 368.1 1090.14 324.2 1021.5 323C953.02 321.8 889.48 383.4 821 392C752.36 400.7 678.64 368.519 610 378.719C541.52 388.819 473.48 414.5 405 404C336.36 393.5 273.64 342.319 205 337.719C136.52 333.019 68.8 366.719 34.4 372.719L0 378.719V460.719H1440V337.719Z">
								</animate>
							</path>
						</svg>
					</div>
					<div class="container">
						<div class="row items-center">
							<div class="col col-12 col-md-3 flex items-center justify-start">
								<img width="145" height="21" src="./assets/images/demo/start-hub-2/logo/logo-d-1.svg" alt="logo hub">
							</div>
							<div class="col col-12 col-md-9">
								<div class="flex flex-wrap alogn-items-center justify-end">
									<div class="w-auto lg:w-full lg:justify-start module-btn">
										<a href="#contact-modal" class="btn btn-solid text-9 font-bold uppercase tracking-1 py-5 px-15 mr-25 text-secondary rounded-4 bg-blue-50 hover:text-white hover:bg-secondary" data-lity="#contact-modal">
											<span class="btn-txt" data-text="Apply">Apply</span>
										</a>
									</div>
									<div class="flex justify-end text-end lqd-fancy-menu lqd-custom-menu relative text-end lqd-menu-td-none link-bold link-10 link-black-80 lg:w-full sm:text-start module-menu">
										<ul class="reset-ul inline-ul uppercase">
											<li class="tracking-1 mr-35">
												<a class="uppercase tracking-1/5" href="#">
													<span class="link-icon inline-flex hide-if-empty left-icon icon-next-to-label"></span>
													Management
												</a>
											</li>
											<li class="tracking-1 mr-35">
												<a class="uppercase tracking-1/5" href="#">
													<span class="link-icon inline-flex hide-if-empty left-icon icon-next-to-label"></span>
													Reporting
												</a>
											</li>
											<li class="tracking-1 mr-35">
												<a class="uppercase tracking-1/5" href="#">
													<span class="link-icon inline-flex hide-if-empty left-icon icon-next-to-label"></span>
													Tracking
												</a>
											</li>
											<li class="tracking-1 mr-35">
												<a class="uppercase tracking-1/5" href="#">
													<span class="link-icon inline-flex hide-if-empty left-icon icon-next-to-label"></span>
													Subscribe
												</a>
											</li>
											<li class="tracking-1 mr-35">
												<a class="uppercase tracking-1/5" href="#">
													<span class="link-icon inline-flex hide-if-empty left-icon icon-next-to-label"></span>
													Company
												</a>
											</li>
											<li class="tracking-1 mr-35">
												<a class="uppercase tracking-1/5" href="#">
													<span class="link-icon inline-flex hide-if-empty left-icon icon-next-to-label"></span>
													Careers
												</a>
											</li>
											<li class="tracking-1 mr-0">
												<a class="uppercase tracking-1/5" href="#">
													<span class="link-icon inline-flex hide-if-empty left-icon icon-next-to-label"></span>
													Press
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col col-12 mt-5 p-15">
								<span class="divider w-full flex border-top border-lightgray"></span>
							</div>
							<div class="col col-12 col-md-8">
								<div class="ld-fancy-heading relative">
									<p class="ld-fh-element mb-0/5em inline-block relative text-12 leading-1/75em">These Terms will be applied fully and affect to your use of this Website. By using this Website, you agreed to accept all terms and conditions written in here. You must not use this Website if you disagree with any of these Website Standard Terms and Conditions.</p>
								</div>
							</div>
							<div class="col col-12 col-md-4">
								<div class="flex flex-row justify-end items-center gap-10 sm:justify-start">
									<a class="icon social-icon animation-grow mr-25 text-24 w-25 h-25 leading-24" href="#" target="_blank">
										<span class="sr-only">Instagram</span>
										<svg class="w-1em h-1em relative block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
											<path fill="#5F7A9E" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
										</svg>
									</a>
									<a class="icon social-icon animation-grow text-24 w-25 h-25 leading-24" href="#" target="_blank">
										<span class="sr-only">Twitter</span>
										<svg class="w-1em h-1em relative block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
											<path fill="#5F7A9E" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z" />
										</svg>
									</a>
								</div>
							</div>
						</div>
					</div>
				</section>
			</footer>
		</div>

		<!-- Contact Modal -->
		<div id="contact-modal" class="lity-modal lqd-modal lity-hide" data-modal-type="fullscreen">
			<div class="lqd-modal-inner">
				<div class="lqd-modal-head"></div>
				<div class="lqd-modal-content link-black">
					<div class="container">
						<div class="row min-h-100vh items-center">
							<div class="w-55percent p-10 sm:w-full">
								<div class="flex flex-col w-full pr-90 lg:pr-0">
									<div class="ld-fancy-heading relative">
										<h2 class="ld-fh-element mb-0/5em inline-block relative text-120 font-medium leading-0/8em text-blue-600">Send a message</h2>
									</div>
									<div class="ld-fancy-heading relative">
										<p class="ld-fh-element mb-0/5em inline-block relative text-18">We're here to answer any question you may have.</p>
									</div>
									<div class="w-full flex flex-wrap">
										<div class="w-50percent flex flex-col p-10 sm:w-full">
											<div class="mb-10 ld-fancy-heading relative">
												<h6 class="ld-fh-element mb-0/5em inline-block relative text-black text-14 font-bold tracking-0">careers</h6>
											</div>
											<div class="mb-10 ld-fancy-heading relative">
												<p class="ld-fh-element mb-0/5em inline-block relative text-16 leading-1/25em">Would you like to join our growing team?</p>
											</div>
											<div class="ld-fancy-heading relative">
												<p class="ld-fh-element mb-0/5em inline-block relative">
													<a href="#" class="text-16 font-bold leading-1/2em">careers@hub.com </a>
												</p>
											</div>
										</div>
										<div class="w-50percent flex flex-col p-10 sm:w-full">
											<div class="mb-10 ld-fancy-heading relative">
												<h6 class="ld-fh-element mb-0/5em inline-block relative text-black text-14 font-bold tracking-0">careers</h6>
											</div>
											<div class="mb-10 ld-fancy-heading relative">
												<p class="ld-fh-element mb-0/5em inline-block relative text-16 leading-1/25em">Would you like to join our growing team?</p>
											</div>
											<div class="ld-fancy-heading relative">
												<p class="ld-fh-element mb-0/5em inline-block relative">
													<a href="#" class="text-16 font-bold leading-1/2em">careers@hub.com </a>
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="w-45percent sm:w-full">
								<div class="lqd-contact-form lqd-contact-form-inputs-underlined lqd-contact-form-button-block lqd-contact-form-button-lg lqd-contact-form-button-border-none">
									<div role="form" lang="en-US">
										<div class="screen-reader-response">
											<p role="status" aria-live="polite" aria-atomic="true"></p>
										</div>
										<form action="./assets/php/mailer.php" method="post" class="lqd-cf-form" novalidate="novalidate" data-status="init">
											<div class="row">
												<div class="col col-xs-12 col-sm-6 relative py-0">
													<i class="lqd-icn-ess icon-lqd-user"></i>
													<span class="lqd-form-control-wrap">
														<input class="text-13 text-black border-black-20" type="text" name="name" value="" size="40" aria-required="true" aria-invalid="false" placeholder="What's your name?">
													</span>
												</div>
												<div class="col col-xs-12 col-sm-6 relative py-0">
													<i class="lqd-icn-ess icon-lqd-envelope"></i>
													<span class="lqd-form-control-wrap">
														<input class="text-13 text-black border-black-20" type="email" name="email" value="" size="40" aria-required="true" aria-invalid="false" placeholder="Email address">
													</span>
												</div>
												<div class="col col-xs-12 col-sm-6 relative py-0">
													<i class="lqd-icn-ess icon-speech-bubble"></i>
													<span class="lqd-form-control-wrap">
														<input class="text-13 text-black border-black-20" type="text" name="topic" value="" size="40" aria-required="true" aria-invalid="false" placeholder="Select a Discussion Topic">
													</span>
												</div>
												<div class="col col-xs-12 col-sm-6 relative py-0">
													<i class="lqd-icn-ess icon-lqd-dollar"></i>
													<span class="lqd-form-control-wrap">
														<input class="text-13 text-black border-black-20" type="text" name="budget" value="" size="40" aria-required="true" aria-invalid="false" placeholder="What's your budget?">
													</span>
												</div>
												<div class="col col-12 lqd-form-textarea relative py-0">
													<i class="lqd-icn-ess icon-lqd-pen-2"></i>
													<span class="lqd-form-control-wrap">
														<textarea class="text-13 text-black border-black-20" name="message" cols="10" rows="6" aria-required="true" aria-invalid="false" placeholder="A brief description about your project/request/consultation"></textarea>
													</span>
												</div>
												<div class="col col-xs-12 text-center relative py-0">
													<input class="bg-primary text-white text-17 font-medium leading-1/5em hover:bg-primary hover:text-white rounded-100" type="submit" value="— send message">
													<p class="mt-1em text-black">
														<span>— copy email:</span>
														<a href="#">info@liquid-themes.com </a>
													</p>
												</div>
											</div>
										</form>
										<div class="lqd-cf-response-output"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="lqd-modal-foot"></div>
			</div>
		</div>
		<!-- Contact Modal -->

		<script src="./assets/vendors/jquery.min.js"></script>
		<script src="./assets/vendors/jquery-ui/jquery-ui.min.js"></script>
		<script src="./assets/vendors/bootstrap/js/bootstrap.min.js"></script>
		<script src="./assets/vendors/fastdom/fastdom.min.js"></script>
		<script src="./assets/vendors/fresco/js/fresco.js"></script>
		<script src="./assets/vendors/lity/lity.min.js"></script>
		<script src="./assets/vendors/gsap/minified/gsap.min.js"></script>
		<script src="./assets/vendors/gsap/utils/CustomEase.min.js"></script>
		<script src="./assets/vendors/gsap/minified/DrawSVGPlugin.min.js"></script>
		<script src="./assets/vendors/gsap/minified/ScrollTrigger.min.js"></script>
		<script src="./assets/vendors/draw-shape/liquidDrawShape.min.js"></script>
		<script src="./assets/vendors/animated-blob/liquidAnimatedBlob.min.js"></script>
		<script src="./assets/vendors/fontfaceobserver.js"></script>
		<script src="./assets/vendors/tinycolor-min.js"></script>
		<script src="./assets/vendors/gsap/utils/SplitText.min.js"></script>
		<script src="./assets/vendors/isotope/isotope.pkgd.min.js"></script>
		<script src="./assets/vendors/isotope/packery-mode.pkgd.min.js"></script>
		<script src="./assets/vendors/flickity/flickity.pkgd.min.js"></script>
		<script src="./assets/vendors/draggabilly.pkgd.min.js"></script>
		<script src="./assets/vendors/particles.min.js"></script>
		<script src="./assets/js/liquid-gdpr.min.js"></script>
		<script src="./assets/js/theme.min.js"></script>
		<script src="./assets/js/liquid-ajax-contact-form.min.js"></script>

		<!-- Start custom cursor -->
		<div class="lqd-cc lqd-cc--inner fixed pointer-events-none"></div>
		<div class="lqd-cc--el lqd-cc-solid lqd-cc-explore flex items-center justify-center rounded-full fixed pointer-events-none">
			<div class="lqd-cc-solid-bg flex absolute lqd-overlay"></div>
			<div class="lqd-cc-solid-txt flex justify-center text-center relative">
				<div class="lqd-cc-solid-txt-inner">Explide</div>
			</div>
		</div>
		<div class="lqd-cc--el lqd-cc-solid lqd-cc-drag flex items-center justify-center rounded-full fixed pointer-events-none">
			<div class="lqd-cc-solid-bg flex absolute lqd-overlay"></div>
			<div class="lqd-cc-solid-ext lqd-cc-solid-ext-left inline-flex items-center">
				<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" style="width: 1em; height: 1em;">
					<path fill="currentColor" d="M19.943 6.07L9.837 14.73a1.486 1.486 0 0 0 0 2.25l10.106 8.661c.96.826 2.457.145 2.447-1.125V7.195c0-1.27-1.487-1.951-2.447-1.125z"></path>
				</svg>
			</div>
			<div class="lqd-cc-solid-txt flex justify-center text-center relative">
				<div class="lqd-cc-solid-txt-inner">Drag</div>
			</div>
			<div class="lqd-cc-solid-ext lqd-cc-solid-ext-right inline-flex items-center">
				<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" style="width: 1em; height: 1em;">
					<path fill="currentColor" d="M11.768 25.641l10.106-8.66a1.486 1.486 0 0 0 0-2.25L11.768 6.07c-.96-.826-2.457-.145-2.447 1.125v17.321c0 1.27 1.487 1.951 2.447 1.125z"></path>
				</svg>
			</div>
		</div>
		<div class="lqd-cc--el lqd-cc-arrow inline-flex items-center fixed top-0 left-0 pointer-events-none">
			<svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M60.4993 0V4.77005H8.87285L80 75.9207L75.7886 79.1419L4.98796 8.35478V60.4993H0V0H60.4993Z" />
			</svg>
		</div>
		<div class="lqd-cc--el lqd-cc-custom-icon rounded-full fixed pointer-events-none">
			<div class="lqd-cc-ci inline-flex items-center justify-center rounded-full relative">
				<svg width="32" height="32" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" style="width: 1em; height: 1em;">
					<path fill="currentColor" fill-rule="evenodd" clip-rule="evenodd" d="M16.03 6a1 1 0 0 1 1 1v8.02h8.02a1 1 0 1 1 0 2.01h-8.02v8.02a1 1 0 1 1-2.01 0v-8.02h-8.02a1 1 0 1 1 0-2.01h8.02v-8.01a1 1 0 0 1 1.01-1.01z"></path>
				</svg>
			</div>
		</div>
		<div class="lqd-cc lqd-cc--outer fixed top-0 left-0 pointer-events-none"></div>
		<!-- End custom cursor -->

		<template id="lqd-temp-snickersbar">
			<div class="lqd-snickersbar flex flex-wrap lqd-snickersbar-in" data-item-id>
				<div class="lqd-snickersbar-inner flex flex-wrap items-center">
					<div class="lqd-snickersbar-detail">
						<p class="lqd-snickersbar-addding-temp mt-0 mb-0 hidden">Adding  to cart</p>
						<p class="lqd-snickersbar-added-temp mt-0 mb-0 hidden">Added to cart</p>
						<p class="lqd-snickersbar-msg flex items-center mt-0 mb-0"></p>
						<p class="lqd-snickersbar-msg-done flex items-center mt-0 mb-0"></p>
					</div>
					<div class="lqd-snickersbar-ext ml-1/5em"></div>
				</div>
			</div>
		</template>
		<template id="lqd-temp-sticky-header-sentinel">
			<div class="lqd-sticky-sentinel invisible absolute pointer-events-none"></div>
		</template>
		<div class="lity hidden" role="dialog" aria-label="Dialog Window (Press escape to close)" tabindex="-1" data-modal-type="default">
			<div class="lity-backdrop"></div>
			<div class="lity-wrap" data-lity-close role="document">
				<div class="lity-loader" aria-hidden="true">Loading...</div>
				<div class="lity-container">
					<div class="lity-content"></div>
				</div>
				<button class="lity-close" type="button" aria-label="Close (Press escape to close)" data-lity-close>&times;</button>
			</div>
		</div>

	</body>

</html>
