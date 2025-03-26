@include('Chatify::layouts.headLinks')
<div class="messenger">
    {{-- ----------------------Users/Groups lists side---------------------- --}}
    <div class="messenger-listView {{ !!$id ? 'conversation-active' : '' }}">
        {{-- Header and search bar --}}
        <div class="m-header">
            <nav>
                <a href="#"><i class="fas fa-inbox"></i> <span class="messenger-headTitle">ПОВІДОМЛЕННЯ</span> </a>
                {{-- header buttons --}}
                <nav class="m-header-right">
                    <a href="#"><i class="fas fa-cog settings-btn"></i></a>
                    <a href="#" class="listView-x"><i class="fas fa-times"></i></a>
                </nav>
            </nav>
            {{-- Search input --}}
            <input type="text" class="messenger-search" placeholder="Search" />
        </div>
        {{-- tabs and lists --}}
        <div class="m-body contacts-container">
           <div class="show messenger-tab users-tab app-scroll" data-view="users">
               <div class="favorites-section">
                <p class="messenger-title"><span>Вибране</span></p>
                <div class="messenger-favorites app-scroll-hidden"></div>
               </div>
               <p class="messenger-title"><span>Ваше Пространство</span></p>
               {!! view('Chatify::layouts.listItem', ['get' => 'saved']) !!}
               <p class="messenger-title"><span>Усі Повідомлення</span></p>
               <div class="listOfContacts" style="width: 100%;height: calc(100% - 272px);position: relative;"></div>
           </div>
           <div class="messenger-tab search-tab app-scroll" data-view="search">
                <p class="messenger-title"><span>Пошук</span></p>
                <div class="search-records">
                    <p class="message-hint center-el"><span>Введіть для пошуку..</span></p>
                </div>
           </div>
        </div>
    </div>

    {{-- ----------------------Messaging side---------------------- --}}
    <div class="messenger-messagingView">
        {{-- header title [conversation name] and buttons --}}
        <div class="m-header m-header-messaging">
            <nav class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                <div class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                    <a href="#" class="show-listView"><i class="fas fa-arrow-left"></i></a>
                    <button onclick="window.history.back();" class="btn btn-danger">Назад</button>
                    <div class="avatar av-s header-avatar" style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;">
                        @if(Auth::check())
                            <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" style="width:40px; height:40px; object-fit:cover; border-radius:50%;">
                        @endif
                    </div>
                    <a href="#" class="user-name">{{ config('chatify.name') }}</a>
                </div>
                <nav class="m-header-right">
                    <a href="#" class="add-to-favorite"><i class="fas fa-star"></i></a>
                    <a href="/"><i class="fas fa-home"></i></a>
                    <a href="#" class="show-infoSide"><i class="fas fa-info-circle"></i></a>
                </nav>
            </nav>
            <div class="internet-connection">
                <span class="ic-connected">Підключено</span>
                <span class="ic-connecting">Підключення...</span>
                <span class="ic-noInternet">Немає доступу до Інтернету</span>
            </div>
        </div>

        {{-- Messaging area --}}
        <div class="m-body messages-container app-scroll">
            <div class="messages">
                <p class="message-hint center-el"><span>Виберіть чат, щоб почати обмін повідомленнями</span></p>
            </div>
            <div class="typing-indicator">
                <div class="message-card typing">
                    <div class="message">
                        <span class="typing-dots">
                            <span class="dot dot-1"></span>
                            <span class="dot dot-2"></span>
                            <span class="dot dot-3"></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        @include('Chatify::layouts.sendForm')
    </div>
    {{-- ---------------------- Info side ---------------------- --}}
    <div class="messenger-infoView app-scroll">
        <nav>
            <p>Відомості про користувача</p>
            <a href="#"><i class="fas fa-times"></i></a>
        </nav>
        {!! view('Chatify::layouts.info')->render() !!}
    </div>
</div>

@include('Chatify::layouts.modals')
@include('Chatify::layouts.footerLinks')
