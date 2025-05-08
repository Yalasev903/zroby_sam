		<!-- Send Message -->
		<div id="contact-modal" class="lity-modal lqd-modal lity-hide" data-modal-type="fullscreen">
			<div class="lqd-modal-inner">
				<div class="lqd-modal-head"></div>
				<div class="lqd-modal-content link-black">
					<div class="container">
						<div class="row min-h-100vh items-center">
							<div class="w-55percent p-10 sm:w-full">
								<div class="flex flex-col w-full pr-90 lg:pr-0">
									<div class="ld-fancy-heading relative">
										<h2 class="ld-fh-element mb-0/5em inline-block relative text-98 font-medium leading-0/8em text-blue-600">Відправьте повідомлення</h2>
									</div>
									<div class="ld-fancy-heading relative">
										<p class="ld-fh-element mb-0/5em inline-block relative text-18">Ми тут, щоб відповісти на будь-які ваші запитання.</p>
									</div>
									<div class="w-full flex flex-wrap">
										<div class="w-50percent flex flex-col p-10 sm:w-full">
											<div class="mb-10 ld-fancy-heading relative">
												<h6 class="ld-fh-element mb-0/5em inline-block relative text-black text-14 font-bold tracking-0">Співпраця</h6>
											</div>
											<div class="mb-10 ld-fancy-heading relative">
												<p class="ld-fh-element mb-0/5em inline-block relative text-16 leading-1/25em">
                                                    Якщо ви хочете співпрацювати або у вас є пропозиції щодо розвитку
                                                </p>
											</div>
											<div class="ld-fancy-heading relative">
												<p class="ld-fh-element mb-0/5em inline-block relative">
													<a href="#" class="text-16 font-bold leading-1/2em">robotapro@gmail.com </a>
												</p>
											</div>
										</div>
										{{-- <div class="w-50percent flex flex-col p-10 sm:w-full">
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
										</div> --}}
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
														<input class="text-13 text-black border-black-20" type="text" name="name" value="" size="40" aria-required="true" aria-invalid="false" placeholder="Ваше Ім'я?">
													</span>
												</div>
												<div class="col col-xs-12 col-sm-6 relative py-0">
													<i class="lqd-icn-ess icon-lqd-envelope"></i>
													<span class="lqd-form-control-wrap">
														<input class="text-13 text-black border-black-20" type="email" name="email" value="" size="40" aria-required="true" aria-invalid="false" placeholder="Ваш Email">
													</span>
												</div>
												<div class="col col-xs-12 col-sm-6 relative py-0">
													<i class="lqd-icn-ess icon-speech-bubble"></i>
													<span class="lqd-form-control-wrap">
														<input class="text-13 text-black border-black-20" type="text" name="topic" value="" size="40" aria-required="true" aria-invalid="false" placeholder="Виберіть тему для обговорення">
													</span>
												</div>
												<div class="col col-xs-12 col-sm-6 relative py-0">
													<i class="lqd-icn-ess icon-lqd-dollar"></i>
													<span class="lqd-form-control-wrap">
														<input class="text-13 text-black border-black-20" type="text" name="budget" value="" size="40" aria-required="true" aria-invalid="false" placeholder="Який ваш бюджет?">
													</span>
												</div>
												<div class="col col-12 lqd-form-textarea relative py-0">
													<i class="lqd-icn-ess icon-lqd-pen-2"></i>
													<span class="lqd-form-control-wrap">
														<textarea class="text-13 text-black border-black-20" name="message" cols="10" rows="6" aria-required="true" aria-invalid="false" placeholder="Короткий опис вашого проекту/запиту/консультації"></textarea>
													</span>
												</div>
												<div class="col col-xs-12 text-center relative py-0">
													<input class="bg-primary text-white text-17 font-medium leading-1/5em hover:bg-primary hover:text-white rounded-100" type="submit" value="— відправити повідомлення">
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
		<!-- Send Message -->
