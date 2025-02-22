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
@include('components_layout.count_users')


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
@include('components_layout.connect_message')
@include('components_layout.footer')
@include('components_layout.send_message')
@include('components_layout.script_connect')




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
