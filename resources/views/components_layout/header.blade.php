<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="HTML Template, site template, seo, marketing, creative, corporate, modern, multipurpose, one page, business, responsive, minimal, saas, startup">
		<meta name="author" content="LiquidThemes">
		<meta name="description" content="Hub is a HTML template with high performance, and award-winning design collection.">
		<meta property="og:title" content="Hub HTML template">
		<meta property="og:description" content="Hub is a HTML template with high performance, and award-winning design collection.">
		<meta property="og:type" content="website">
		<meta property="og:image" content="./assets/images/common/og-image.jpg">

		<link rel="stylesheet" href="./assets/vendors/liquid-icon/lqd-essentials/lqd-essentials.min.css">
		<link rel="stylesheet" href="./assets/css/theme.min.css">
		<link rel="stylesheet" href="./assets/css/utility.min.css">
		<link rel="stylesheet" href="./assets/css/demo/start-hub-2.css">

		<!-- Fonts -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;700&display=swap" rel="stylesheet">

		<title>Зроби Сам</title>
	</head>

	<body data-mobile-nav-breakpoint="1199" data-mobile-nav-style="modern" data-mobile-nav-scheme="dark" data-mobile-nav-trigger-alignment="right" data-mobile-header-scheme="gray" data-mobile-logo-alignment="default" data-mobile-header-builder="true" data-overlay-onmobile="true" data-disable-animations-onmobile="true">
		<div id="wrap">

			<div class="lqd-sticky-placeholder hidden"></div>
			<header id="site-header" class="main-header main-header-overlay" data-sticky-header="true" data-sticky-values-measured="false">
				<div class="border-bottom text-white-10 pl-30 pr-10 module-header">
					<div class="container-fluiud flex items-center justify-between">
						<div class="w-25percent flex items-center justify-start xl:w-15percent lg:w-40percent">
							<div class="flex navbar-brand-plain py-20 sm:hidden">
								<a class="navbar-brand flex p-0 relative" href="./index-start-hub-2.html" rel="home">
									<span class="navbar-brand-inner post-rel">
                                                  <img src="images/logo.png" alt="Логотип" class="h-90 w-auto">
										{{-- <img class="logo-sticky" src="./assets/images/demo/start-hub-2/logo/logo-d-1.svg" alt="StartHub"> --}}
										{{-- <img class="logo-default" src="./assets/images/demo/start-hub-2/logo/logo.svg" alt="StartHub"> --}}
									</span>
								</a>
							</div>
							<div class="navbar-brand-plain py-20 xxl:hidden xl:hidden sm:flex">
								<a class="navbar-brand flex p-0 relative" href="./index-start-hub-2.html" rel="home">
									<span class="navbar-brand-inner post-rel">
                                        <img src="images/logo.png" alt="Логотип" class="h-20 w-auto">
										{{-- <img class="logo-sticky" src="./assets/images/demo/start-hub-2/logo/logo-mob-d.svg" alt="StartHub"> --}}
										{{-- <img class="logo-default" src="./assets/images/demo/start-hub-2/logo/logo-mob.svg" alt="StartHub"> --}}
									</span>
								</a>
							</div>
						</div>
						<div class="w-50percent flex items-center justify-center header-desktop xl:w-55percent lg:hidden">
							<div class="module-primary-nav flex link-14">
								<div class="link-font-medium navbar-collapse inline-flex p-0 lqd-submenu-default-style" aria-expanded="false" role="navigation">
									<ul class="main-nav flex reset-ul inline-ul lqd-menu-counter-right lqd-menu-items-inline main-nav-hover-fill lqd-submenu-toggle-hover link-white" data-submenu-options='{"toggleType": "fade", "handler": "mouse-in-out"}' data-localscroll="true" data-localscroll-options='{"itemsSelector":"> li > a", "trackWindowScroll": true, "includeParentAsOffset": true}'>
										<li class="menu-item-home is-active">
											<a href="{{ route('home') }}">
												<span>Головна</span>
												<span class="link-icon inline-flex hide-if-empty right-icon">
													<i class="lqd-icn-ess icon-ion-ios-arrow-down"></i>
												</span>
											</a>
										</li>
										<li>
											<a href="#about">
												<span>Про нас</span>
												<span class="link-icon inline-flex hide-if-empty right-icon">
													<i class="lqd-icn-ess icon-ion-ios-arrow-down"></i>
												</span>
											</a>
										</li>
										<li class="menu-item-has-children position-applied">
											<a href="#services">
												<span>Послуги</span>
												<span class="submenu-expander">
													<svg xmlns="http://www.w3.org/2000/svg" width="21" height="32" viewBox="0 0 21 32" style="width: 1em; height: 1em;">
														<path fill="currentColor" d="M10.5 18.375l7.938-7.938c.562-.562 1.562-.562 2.125 0s.562 1.563 0 2.126l-9 9c-.563.562-1.5.625-2.063.062L.437 12.562C.126 12.25 0 11.876 0 11.5s.125-.75.438-1.063c.562-.562 1.562-.562 2.124 0z"></path>
													</svg>
												</span>
												<span class="link-icon inline-flex hide-if-empty right-icon">
													<i class="lqd-icn-ess icon-ion-ios-arrow-down"></i>
												</span>
											</a>
										</li>
										<li>
											<a href="#info">
												<span>Інформація</span>
												<span class="link-icon inline-flex hide-if-empty right-icon">
													<i class="lqd-icn-ess icon-ion-ios-arrow-down"></i>
												</span>
											</a>
										</li>
										<li>
											<a href="#contact">
												<span>Контакти</span>
												<span class="link-icon inline-flex hide-if-empty right-icon">
													<i class="lqd-icn-ess icon-ion-ios-arrow-down"></i>
												</span>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="w-25percent flex items-center justify-end mr-20 lg:w-60percent lg:mr-0">
							<div class="flex items-center justify-end">
								<div class="module-social lg:hidden">
									<div class="social-icons-wrapper justify-end">
										<span class="grid-item">
											<a href="#" class="icon social-icon animation-pulse-grow items-center text-15 text-white-30" target="_blank">
												<span class="sr-only">Facebook</span>
												<svg class="text-15" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" fill="currentColor"><path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"/></svg>
											</a>
										</span>
										<span class="grid-item">
											<a href="#" class="icon social-icon animation-pulse-grow items-center text-15 text-white-30" target="_blank">
												<span class="sr-only">Twitter</span>
												<svg class="text-15" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" fill="currentColor"><path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"/></svg>
											</a>
										</span>
										<span class="grid-item">
											<a href="#" class="icon social-icon animation-pulse-grow items-center text-15 text-white-30" target="_blank">
												<span class="sr-only">Github</span>
												<svg class="text-15" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 496 512" fill="currentColor"><path d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z"/></svg>
											</a>
										</span>
									</div>
								</div>
                                @if (Route::has('login'))
                                <nav class="-mx-3 flex flex-1 justify-end">
                                    @auth
                                        <a
                                            href="{{ url('/dashboard') }}"
                                            class="btn btn-solid text-white bg-gray-600 rounded-100 ml-10 text-15 font-medium bg-gray-600 hover:text-black hover:bg-white module-btn-sm"
                                        >
                                            Дошка оголошень
                                        </a>
                                    @else
                                        <a
                                            href="{{ route('login') }}"
                                            class="btn btn-solid text-white bg-gray-600 rounded-100 ml-10 text-15 font-medium bg-gray-600 hover:text-black hover:bg-white module-btn-sm"
                                        >
                                            Увійти
                                        </a>

                                        @if (Route::has('register'))
                                            <a
                                                href="{{ route('register') }}"
                                                class="btn btn-solid text-white bg-gray-600 rounded-100 ml-10 text-15 font-medium bg-gray-600 hover:text-black hover:bg-white module-btn-sm"
                                            >
                                                Зареєструватись
                                            </a>
                                        @endif
                                    @endauth
                                </nav>
                            @endif
								{{-- <a href="#contact-modal" class="btn btn-solid text-white bg-gray-600 rounded-100 ml-10 text-15 font-medium bg-gray-600 hover:text-black hover:bg-white module-btn-sm" data-lity="#contact-modal">
									<span class="btn-txt" data-text="Send a message">Send a message</span>
								</a> --}}
								<div class="ml-15 ld-module-sd ld-module-sd-hover ld-module-sd-right xxl:hidden lg:block">
									<button class="bg-transparent border-none nav-trigger flex relative items-center justify-center style-6 collapsed" role="button" type="button" data-ld-toggle="true" data-toggle-options='{"cloneTriggerInTarget": false, "type": "click"}' data-bs-toggle="collapse" data-bs-target="#lqd-drawer-mobile" aria-expanded="false">
										<span class="bars inline-block relative z-1">
											<span class="bars-inner flex flex-col w-full h-full">
												<span class="bar inline-block relative"></span>
												<span class="bar inline-block relative"></span>
												<span class="bar inline-block relative"></span>
											</span>
										</span>
									</button>
									<div class="ld-module-dropdown collapse absolute" id="lqd-drawer-mobile">
										<div class="ld-sd-wrap">
											<div class="p-40 ld-sd-inner justify-center flex-col">
												<div class="module-primary-nav flex">
													<div class="w-full navbar-collapse inline-flex p-0 lqd-submenu-default-style" id="main-header-collapse" aria-expanded="false" role="navigation">
														<ul id="primary-nav" class="main-nav flex reset-ul lqd-menu-counter-right lqd-menu-items-block main-nav-hover-default" data-submenu-options='{"toggleType": "slide", "handler": "click"}' data-localscroll="true" data-localscroll-options='{"itemsSelector":"> li > a", "trackWindowScroll": true, "includeParentAsOffset": true}'>
															<li class="menu-item-home is-active">
																<a class="w-full text-20 text-black font-medium leading-1/5em" href="#banner">
																	<span>Home</span>
																	<span class="link-icon inline-flex hide-if-empty right-icon">
																		<i class="lqd-icn-ess icon-ion-ios-arrow-down"></i>
																	</span>
																</a>
															</li>
															<li>
																<a class="w-full text-20 text-black font-medium leading-1/5em" href="#about">
																	<span>About</span>
																	<span class="link-icon inline-flex hide-if-empty right-icon">
																		<i class="lqd-icn-ess icon-ion-ios-arrow-down"></i>
																	</span>
																</a>
															</li>
															<li class="menu-item-has-children">
																<a class="w-full text-20 text-black font-medium leading-1/5em" href="#services">
																	<span>Services</span>
																	<span class="submenu-expander absolute inline-flex right-0"></span>
																</a>
															</li>
															<li>
																<a class="w-full text-20 text-black font-medium leading-1/5em" href="#clients">
																	<span>Customer Stories</span>
																	<span class="link-icon inline-flex hide-if-empty right-icon">
																		<i class="lqd-icn-ess icon-ion-ios-arrow-down"></i>
																	</span>
																</a>
															</li>
															<li>
																<a class="w-full text-20 text-black font-medium leading-1/5em" href="#contact">
																	<span>Contact</span>
																	<span class="link-icon inline-flex hide-if-empty right-icon">
																		<i class="lqd-icn-ess icon-ion-ios-arrow-down"></i>
																	</span>
																</a>
															</li>
														</ul>
													</div>
												</div>
												<div class="flex justify-start mt-25 gap-25">
													<a class="icon social-icon social-icon-facebook animation-pulse-grow text-26 w-25" href="#" target="_blank">
														<span class="sr-only">Facebook</span>
														<svg class="w-1em h-1em relative block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#0000003D">
															<path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z" />
														</svg>
													</a>
													<a class="icon social-icon social-icon-twitter animation-pulse text-26 w-25-grow" href="#" target="_blank">
														<span class="sr-only">Twitter</span>
														<svg class="w-1em h-1em relative block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#0000003D">
															<path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z" />
														</svg>
													</a>
													<a class="icon social-icon social-icon-github animation-pulse-grow text-26 w-25" href="#" target="_blank">
														<span class="sr-only">Github</span>
														<svg class="w-1em h-1em relative block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" fill="#0000003D">
															<path d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z" />
														</svg>
													</a>
												</div>
											</div>
										</div>
									</div>
									<div class="lqd-module-backdrop"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="lqd-stickybar-wrap lqd-stickybar-right w-auto items-end pointer-events-none">
					<div class="static flex flex-col flex-grow-1 items-end justify-center vertical-rl p-10 mr-60">
						<a href="#contact-modal" class="btn btn-solid btn-sm btn-icon-left btn-icon-circle btn-icon-custom-size btn-icon-solid pointer-events-auto horizontal-tb -ml-60 bg-white text-15 font-medium text-gray-600 shadow-md rounded-100 hover:text-white hover:bg-primary" data-lity="#contact-modal">
							<span class="btn-txt" data-text="Contact us">Зв'язок з нами</span>
							<span class="btn-icon mr-15 w-35 h-35 text-blue-300 bg-blue-100">
								<svg class="w-20" xmlns="http://www.w3.org/2000/svg" width="19.955" height="16.522" viewbox="0 0 19.955 16.522" fill="currentColor">
									<g transform="translate(-6.045 -8.06)">
										<path d="M7.546,14.774l-.158,0a7.354,7.354,0,0,1-4.107-1.245L1.539,14.577c-.637.382-1.049.1-.92-.63l.474-2.69a7.389,7.389,0,0,1,11.055-9.52,7.725,7.725,0,0,0-4.6,13.038Z" transform="translate(6.045 8.06)" fill="#6abbd7"></path>
										<path d="M0,7.5a7.5,7.5,0,1,1,13.891,3.927l.492,2.79c.124.706-.274.983-.89.612l-1.824-1.095A7.5,7.5,0,0,1,0,7.5Z" transform="translate(11 9.582)" fill="#008aba"></path>
									</g>
								</svg>
							</span>
						</a>
					</div>
				</div>
			</header>
