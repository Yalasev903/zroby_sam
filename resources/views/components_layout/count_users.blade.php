                    <!-- Start Count Users -->
                    <section class="lqd-section experiences pt-45 pb-95 relative">
                        <div class="container">
                            <div class="row">
                                <div class="w-40percent flex lg:w-full p-0" data-custom-animations="true" data-ca-options='{"animationTarget": "img", "startDelay" : 200, "ease": "power4.out", "initValues": {"y": "45px", "opacity" : 0} , "animations": {"y": "0px", "opacity" : 1}}'>
                                    <div class="w-full flex flex-wrap items-center justify-center relative p-15">
                                        <div class="w-auto absolute top-0 module-img-1" data-parallax="true" data-parallax-options='{"ease": "linear", "start": "top bottom", "end": "bottom+=0px top"}' data-parallax-from='{"x": "45px"}' data-parallax-to='{"x": "0px"}'>
                                            <img width="90" height="65" src="./assets/images/demo/start-hub-2/3D/patt.svg" alt="3D Shape dots">
                                        </div>
                                        <div class="w-auto absolute top-0 module-img-2" data-parallax="true" data-parallax-options='{"ease": "linear", "start": "top bottom", "end": "bottom-=100% top"}' data-parallax-from='{"x": "48px", "y": "200px"}' data-parallax-to='{"x": "0px", "y": "0px"}'>
                                            <img width="121" height="121" src="./assets/images/demo/start-hub-2/experience/registration.png" alt="experiences">
                                        </div>
                                        <div class="w-auto absolute -top-10percent module-img-3" data-parallax="true" data-parallax-options='{"ease": "linear", "start": "top bottom", "end": "bottom-=100% top"}' data-parallax-from='{"x": "-90px", "y": "230px"}' data-parallax-to='{"x": "0px", "y": "0px"}'>
                                            <img width="127" height="127" src="./assets/images/demo/start-hub-2/experience/registrations.png" alt="experiences">
                                        </div>
                                        <div class="w-auto relative z-1 module-img-4" data-parallax="true" data-parallax-options='{"ease": "linear", "start": "top bottom", "end": "bottom-=100% top"}' data-parallax-from='{"y": "95px"}' data-parallax-to='{"x": "0px", "y": "0px"}'>
                                            <img width="213" height="213" src="./assets/images/demo/start-hub-2/experience/phone.png" alt="experiences">
                                        </div>
                                        <div class="w-auto absolute bottom-25percent z-1 module-img-5" data-parallax="true" data-parallax-options='{"ease": "linear", "start": "top bottom", "end": "bottom+=0px top"}' data-parallax-from='{"x": "-80px", "y": "65px", "scaleX" : 1.2, "scaleY" : 1.2}' data-parallax-to='{"x": "0px", "y": "0px", "scaleX" : 1, "scaleY" : 1}'>
                                            <img width="34" height="34" src="./assets/images/demo/start-hub-2/3D/circle.svg" alt="3D Shape circle">
                                        </div>
                                    </div>
                                </div>
                                <div class="w-60percent flex flex-col p-15 lg:w-full" data-custom-animations="true" data-ca-options='{"animationTarget": ".animation-element", "startDelay" : 200, "ease": "power4.out", "initValues": {"x": "-30px", "opacity" : 0} , "animations": {"x": "0px", "opacity" : 1}}'>
                                    <div class="w-full flex flex-wrap bg-white rounded-10 shadow-md transition-all">
                                        <!-- Блок: Загальна кількість користувачів -->
                                        <div class="w-33percent sm:w-full">
                                            <div class="flex flex-col border-right border-black-10 pt-45 px-30 pb-60 sm:border-right-0 sm:border-bottom animation-element">
                                                <div class="ld-fancy-heading relative">
                                                    <h2 class="ld-fh-element ld-gradient-heading relative bg-transparent mb-0/5em" style="background-image: linear-gradient(180deg, #4452F2 0%, #F2DFDF 100%);">
                                                        {{ \App\Models\User::count() }}
                                                    </h2>
                                                </div>
                                                <div class="ld-fancy-heading relative">
                                                    <h6 class="ld-fh-element relative mb-2em">Загальна кількість користувачів</h6>
                                                </div>
                                                <div class="ld-fancy-heading relative">
                                                    <p class="ld-fh-element mb-0/5em inline-block relative text-16 leading-1/6em">
                                                        Кількість зареєстрованих користувачів на платформі, що демонструє охоплення нашої спільноти.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Блок: Загальна кількість виконавців -->
                                        <div class="w-33percent sm:w-full">
                                            <div class="flex flex-col border-right border-black-10 pt-45 px-30 pb-60 sm:border-right-0 sm:border-bottom animation-element">
                                                <div class="ld-fancy-heading relative">
                                                    <h2 class="ld-fh-element ld-gradient-heading relative bg-transparent mb-0/5em" style="background-image: linear-gradient(180deg, #4452F2 0%, #F2DFDF 100%);">
                                                        {{ \App\Models\User::where('role', 'executor')->count() }}
                                                    </h2>
                                                </div>
                                                <div class="ld-fancy-heading relative">
                                                    <h6 class="ld-fh-element relative mb-2em">Загальна кількість виконавців</h6>
                                                </div>
                                                <div class="ld-fancy-heading relative">
                                                    <p class="ld-fh-element mb-0/5em inline-block relative text-16 leading-1/6em">
                                                        Кількість користувачів, які пропонують свої професійні послуги на платформі.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Блок: Загальна кількість оголошень -->
                                        <div class="w-33percent sm:w-full">
                                            <div class="flex flex-col pt-45 px-30 pb-60 animation-element">
                                                <div class="ld-fancy-heading relative">
                                                    <h2 class="ld-fh-element ld-gradient-heading relative bg-transparent mb-0/5em" style="background-image: linear-gradient(180deg, #4452F2 0%, #F2DFDF 100%);">
                                                        {{ \App\Models\Ad::count() }}
                                                    </h2>
                                                </div>
                                                <div class="ld-fancy-heading relative">
                                                    <h6 class="ld-fh-element relative mb-2em">Загальна кількість оголошень</h6>
                                                </div>
                                                <div class="ld-fancy-heading relative">
                                                    <p class="ld-fh-element mb-0/5em inline-block relative text-16 leading-1/6em">
                                                        Всі оголошення, розміщені на платформі, що демонструють активність користувачів у пропозиції та пошуку послуг.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- End Count Users -->
