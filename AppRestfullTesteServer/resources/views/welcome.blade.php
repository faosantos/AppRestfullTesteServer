@extends("layouts.landing")
@section('title', "Pessoas de todo o Brasil")
@section('content')
<header class="bg-gradient" id="home">
    <div class="container mt-5">
        <h1>{{config('app.name')}}</h1>
        <p class="tagline"> O melhor app de relacionamento do Brasil. Apenas cadastre-se e você estará pronto para começar. </p>
    </div>
    <div class="img-holder mt-3"><img src="images/iphonex.png" alt="phone" class="img-fluid"></div>
</header>
<!--div class="client-logos my-5">
    <div class="container text-center">
        <img src="images/client-logos.png" alt="client logos" class="img-fluid">
    </div>
</div-->
<div class="section light-bg" id="features">
    <div class="container">
        <div class="section-title">
            <small>DESTAQUES</small>
            <h3>Perfil que você vai adorar</h3>
        </div>
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="card features">
                    <div class="card-body">
                        <div class="media">
                            <span class="ti-face-smile gradient-fill ti-3x mr-3"></span>
                            <div class="media-body">
                                <h4 class="card-title">Simplicidade</h4>
                                <p class="card-text">Através do 99 Club, com poucos toques na tela você pode encontrar a pessoa ideal para o seu gosto, simplificando o processo através da praticidade. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card features">
                    <div class="card-body">
                        <div class="media">
                            <span class="ti-map-alt gradient-fill ti-3x mr-3"></span>
                            <div class="media-body">
                                <h4 class="card-title">Encontros Próximos</h4>
                                <p class="card-text">Com o nosso sistema de geolocalização você pode encontrar as pessoas online mais próximas de você em todo o território brasileiro, agilizando o seu processo de busca. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card features">
                    <div class="card-body">
                        <div class="media">
                            <span class="ti-lock gradient-fill ti-3x mr-3"></span>
                            <div class="media-body">
                                <h4 class="card-title">Seguro</h4>
                                <p class="card-text">O 99 Club é o local ideal para quem busca companhias, portanto sempre combine os detalhes através do chat, aproveitando para conhecer ainda mais a pessoa escolhida.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-6">
                <div class="box-icon"><span class="ti-mobile gradient-fill ti-3x"></span></div>
                <h2>Descubra mais</h2>
                <p class="mb-4"> O {{config('app.name')}} é o aplicativo ideal para você criar novos laços sociais. <wbr/>
                Através dele, você pode filtrar pessoas por região e iniciar uma conversa. <wbr/>
                É a melhor oportunidade para expandir o seu ciclo social e até mesmo encontrar uma parceira(o).
                </p>
                <p id="readmore">
                </p>
                <a href="javascript:;" id="showmore" class="btn btn-primary">Mais</a>
            </div>
        </div>
        <div class="perspective-phone">
            <img src="images/perspective.png" alt="perspective phone" class="img-fluid">
        </div>
    </div>
</div>
<div class="section light-bg">
    <div class="container">
        <div class="section-title">
            <small>CARACTERÍSTICAS</small>
            <h3>Encontre o que você precisa.</h3>
        </div>
        <ul class="nav nav-tabs nav-justified" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#communication">Comunicação</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#schedule">Facilidade</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#messages">Galerias</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#livechat">Chat</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="communication">
                <div class="d-flex flex-column flex-lg-row">
                    <img src="images/graphic.png" alt="graphic" class="img-fluid rounded align-self-start mr-lg-5 mb-5 mb-lg-0">
                    <div>
                        <h2>Conheça pessoas novas</h2>
                        <p class="lead">Aumente seu raio de encontros</p>
                        <p>O 99 Club é o aplicativo ideal para você criar novos laços sociais. É a melhor oportunidade para expandir o seu ciclo social e até mesmo encontrar uma parceira (o). Você pode escolher de acordo com o seu gosto e de onde você estiver.
                        </p>
                        <p> Para os usuários, é importante ficar o maior tempo possível disponível, facilitando para que seja encontrado mais rapidamente. Para os usuários, o 99 facilita todo o seu processo de busca, tornando o processo mais rápido e prático.
                        </p>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="schedule">
                <div class="d-flex flex-column flex-lg-row">
                    <div>
                        <h2>É só teclar</h2>
                        <p class="lead">Tudo que você quiser ao alcance das suas mãos.</p>
                        <p>O aplicativo funciona em todo o território nacional, portanto, mesmo que precise fazer uma viagem você poderá seguir interagindo com as pessoas dessa determinada região. Basicamente, você só precisa se cadastrar e iniciar as buscas ou esperar que outros usuários de sua preferência o encontrem.
                        </p>
                        <p> É a praticidade de um aplicativo facilitando a sua vida e te proporcionando diversas oportunidades.
                        </p>
                    </div>
                    <img src="images/graphic.png" alt="graphic" class="img-fluid rounded align-self-start mr-lg-5 mb-5 mb-lg-0">
                </div>
            </div>
            <div class="tab-pane fade" id="messages">
                <div class="d-flex flex-column flex-lg-row">
                    <img src="images/img_1.svg" alt="graphic"  style="widht:210px; height:266px" class="img-fluid rounded align-self-start mr-lg-5 mb-5 mb-lg-0">
                    <div>
                        <h2>UMA VITRINE PESSOAL</h2>
                        <p class="lead">A primeira impressão é a que fica</p>
                        <p> Através das suas fotosos clientes poderão ser impactados por você. Portanto, capriche no seu álbum mas sem esquecer as regras básicas. Escolha as melhores dentro das possibilidades e faça bom uso das mesmas, pronta (o) para surpreender o seu próximo cliente.
                        </p>
                        <p> Além disso, não esqueça de apresentar o aplicativo para as suas amigas (os), o 99 Club é uma grande vitrine e tem espaço para todas (os).
                        </p>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="livechat">
                <div class="d-flex flex-column flex-lg-row">
                    <div>
                        <h2>CHAT INTEGRADO</h2>
                        <p class="lead">Chat ao vivo quando você precisar</p>
                        <p>Através do chat você pode conhecer melhor a pessou por quem se interessou, conversando, enviando fotos e combinando os detalhes do seu encontro.
                        </p>
                        <p> É nele que você terá o primeiro contato com a (o) modelo, portanto, seja educado e não abuse dos pedidos. Use o chat para facilitar ainda mais a organização dos seus encontros.
                        </p>
                    </div>
                    <img src="images/img_2.svg" alt="graphic" style="widht:210px; height:266px" class="img-fluid rounded align-self-start mr-lg-5 mb-5 mb-lg-0">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="images/dualphone.png" alt="dual phone" class="img-fluid">
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <div>
                    <div class="box-icon">
                        <span class="ti-rocket gradient-fill ti-3x"></span>
                    </div>
                    <h2>Experimente o app</h2>
                    <p class="mb-4"> O {{config('app.name')}} tem ótimas formas de pagamento além de uma vastidão de potenciais parceiros(as).</p>
                    <!-- <a href="#" class="btn btn-primary">Read more</a> -->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section light-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-8 d-flex align-items-center">
                <ul class="list-unstyled ui-steps">
                    <li class="media">
                        <div class="circle-icon mr-4">1</div>
                        <div class="media-body">
                            <h5>Crie uma conta</h5>
                            <p>Ao registrar-se no {{config('app.name')}} você ficará automáticamente disponível na sua região. Podendo mudar seu status caso deseje.</p>
                        </div>
                    </li>
                    <li class="media my-4">
                        <div class="circle-icon mr-4">2</div>
                        <div class="media-body">
                            <h5>Compartilhe</h5>
                            <p>Compartilhe o {{config('app.name')}} com pessoas que você gostaria de encontrar pelo app.</p>
                        </div>
                    </li>
                    <li class="media">
                        <div class="circle-icon mr-4">3</div>
                        <div class="media-body">
                            <h5>Aproveite</h5>
                            <p>Assim que tiver o {{config('app.name')}} estiver instalado e você tiver sua conta, basta navegar e curtir o app.</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <img src="images/iphonex-min.png" alt="iphone" class="img-fluid">
            </div>
        </div>
    </div>
</div>
<!--div class="section">
    <div class="container">
        <div class="section-title">
            <small>TESTIMONIALS</small>
            <h3>What our Customers Says</h3>
        </div>
        <div class="testimonials owl-carousel">
            <div class="testimonials-single">
                <img src="images/client.png" alt="client" class="client-img">
                <blockquote class="blockquote">Uniquely streamline highly efficient scenarios and 24/7 initiatives. Conveniently embrace multifunctional ideas through proactive customer service. Distinctively conceptualize 2.0 intellectual capital via user-centric partnerships.</blockquote>
                <h5 class="mt-4 mb-2">Crystal Gordon</h5>
                <p class="text-primary">United States</p>
            </div>
            <div class="testimonials-single">
                <img src="images/client.png" alt="client" class="client-img">
                <blockquote class="blockquote">Uniquely streamline highly efficient scenarios and 24/7 initiatives. Conveniently embrace multifunctional ideas through proactive customer service. Distinctively conceptualize 2.0 intellectual capital via user-centric partnerships.</blockquote>
                <h5 class="mt-4 mb-2">Crystal Gordon</h5>
                <p class="text-primary">United States</p>
            </div>
            <div class="testimonials-single">
                <img src="images/client.png" alt="client" class="client-img">
                <blockquote class="blockquote">Uniquely streamline highly efficient scenarios and 24/7 initiatives. Conveniently embrace multifunctional ideas through proactive customer service. Distinctively conceptualize 2.0 intellectual capital via user-centric partnerships.</blockquote>
                <h5 class="mt-4 mb-2">Crystal Gordon</h5>
                <p class="text-primary">United States</p>
            </div>
        </div>
    </div>
</div-->
<div class="section light-bg" id="gallery">
    <div class="container">
        <div class="section-title">
            <small>GALERIA</small>
            <h3>Telas do app</h3>
        </div>
        <div class="img-gallery owl-carousel owl-theme">
            <img src="images/screen1.jpg" alt="image">
            <img src="images/screen2.jpg" alt="image">
            <img src="images/screen3.jpg" alt="image">
            <img src="images/screen1.jpg" alt="image">
        </div>
    </div>
</div>
<!--div class="section" id="pricing">
    <div class="container">
        <div class="section-title">
            <small>PRICING</small>
            <h3>Upgrade to Pro</h3>
        </div>
        <div class="card-deck">
            <div class="card pricing">
                <div class="card-head">
                    <small class="text-primary">PERSONAL</small>
                    <span class="price">$14<sub>/m</sub></span>
                </div>
                <ul class="list-group list-group-flush">
                    <div class="list-group-item">10 Projects</div>
                    <div class="list-group-item">5 GB Storage</div>
                    <div class="list-group-item">Basic Support</div>
                    <div class="list-group-item"><del>Collaboration</del></div>
                    <div class="list-group-item"><del>Reports and analytics</del></div>
                </ul>
                <div class="card-body">
                    <a href="#" class="btn btn-primary btn-lg btn-block">Choose this Plan</a>
                </div>
            </div>
            <div class="card pricing popular">
                <div class="card-head">
                    <small class="text-primary">FOR TEAMS</small>
                    <span class="price">$29<sub>/m</sub></span>
                </div>
                <ul class="list-group list-group-flush">
                    <div class="list-group-item">Unlimited Projects</div>
                    <div class="list-group-item">100 GB Storage</div>
                    <div class="list-group-item">Priority Support</div>
                    <div class="list-group-item">Collaboration</div>
                    <div class="list-group-item">Reports and analytics</div>
                </ul>
                <div class="card-body">
                    <a href="#" class="btn btn-primary btn-lg btn-block">Choose this Plan</a>
                </div>
            </div>
            <div class="card pricing">
                <div class="card-head">
                    <small class="text-primary">ENTERPRISE</small>
                    <span class="price">$249<sub>/m</sub></span>
                </div>
                <ul class="list-group list-group-flush">
                    <div class="list-group-item">Unlimited Projects</div>
                    <div class="list-group-item">Unlimited Storage</div>
                    <div class="list-group-item">Collaboration</div>
                    <div class="list-group-item">Reports and analytics</div>
                    <div class="list-group-item">Web hooks</div>
                </ul>
                <div class="card-body">
                    <a href="#" class="btn btn-primary btn-lg btn-block">Choose this Plan</a>
                </div>
            </div>
        </div>
    </div>
</div-->
<!--div class="section pt-0">
    <div class="container">
        <div class="section-title">
            <small>FAQ</small>
            <h3>Frequently Asked Questions</h3>
        </div>
        <div class="row pt-4">
            <div class="col-md-6">
                <h4 class="mb-3">Can I try before I buy?</h4>
                <p class="light-font mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer rutrum, urna eu pellentesque pretium, nisi nisi fermentum enim, et sagittis dolor nulla vel sapien. Vestibulum sit amet mattis ante. </p>
                <h4 class="mb-3">What payment methods do you accept?</h4>
                <p class="light-font mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer rutrum, urna eu pellentesque pretium, nisi nisi fermentum enim, et sagittis dolor nulla vel sapien. Vestibulum sit amet mattis ante. </p>
            </div>
            <div class="col-md-6">
                <h4 class="mb-3">Can I change my plan later?</h4>
                <p class="light-font mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer rutrum, urna eu pellentesque pretium, nisi nisi fermentum enim, et sagittis dolor nulla vel sapien. Vestibulum sit amet mattis ante. </p>
                <h4 class="mb-3">Do you have a contract?</h4>
                <p class="light-font mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer rutrum, urna eu pellentesque pretium, nisi nisi fermentum enim, et sagittis dolor nulla vel sapien. Vestibulum sit amet mattis ante. </p>
            </div>
        </div>
    </div>
</div-->

<div id="download" class="section bg-gradient">
    <div class="container">
        <div class="call-to-action">
            <div class="box-icon"><span class="ti-mobile gradient-fill ti-3x"></span></div>
            <h2>Baixe em qualquer dispisitivo</h2>
            <p class="tagline">Dispinível para as maiores distribuidoras de apps. Encontre o {{config('app.name')}} em qualquer plataforma. </p>
            <div class="my-4">
                <a href="https://itunes.apple.com/us/app/99club/id1440825901?l=pt&ls=1&mt=8" class="btn btn-light">
                    <img src="images/appleicon.png" alt="icon"> App Store
                </a>
                <a href="https://play.google.com/store/apps/details?id=com.rsxglobal.clubapp" class="btn btn-light">
                    <img src="images/playicon.png" alt="icon"> Google play
                </a>
            </div>
            <!-- <p class="text-primary"><small><i>*Works on iOS 10.0.5+, Android Kitkat and above. </i></small></p> -->
        </div>
    </div>
</div>

<div class="light-bg py-5" id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 text-center text-lg-left">
                <!--p class="mb-2"> <span class="ti-location-pin mr-2"></span> 1485 Pacific St, Brooklyn, NY 11216 USA</p-->
                <!--div class=" d-block d-sm-inline-block">
                    <p class="mb-2">
                        <span class="ti-email mr-2"></span> <a class="mr-4" href="mailto:support@mobileapp.com">support@mobileapp.com</a>
                    </p>
                </div-->
                <!--div class="d-block d-sm-inline-block">
                    <p class="mb-0">
                        <span class="ti-headphone-alt mr-2"></span> <a href="tel:51836362800">518-3636-2800</a>
                    </p>
                </div-->
            </div>
            <div class="col-lg-6">
                <div class="social-icons">
                    <a href="https://www.facebook.com/99clubb/"><span class="ti-facebook"></span></a>
                    <!-- <a href="#"><span class="ti-twitter-alt"></span></a> -->
                    <a href="https://www.instagram.com/99clubb/"><span class="ti-instagram"></span></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- // end .section -->
<footer class="my-5 text-center">
    <!-- Copyright removal is not prohibited! -->
    <p class="mb-2"><small>COPYRIGHT © 2017. ALL RIGHTS RESERVED. MOBAPP TEMPLATE BY <a href="https://colorlib.com">COLORLIB</a></small></p>

    <!--small>
        <a href="#" class="m-2">PRESS</a>
        <a href="#" class="m-2">TERMS</a>
        <a href="#" class="m-2">PRIVACY</a>
    </small-->
</footer>
@endsection
@section('script')
    <script>
        let data = ` 
                Basicamente, você só precisa se cadastrar e iniciar as buscas.<br/>
                O aplicativo funciona em todo o território nacional, portanto,
                mesmo que precise fazer uma viagem você poderá seguir interagindo com as pessoas dessa 
                determinada região. <br/>
                Inicie conversas através do chat, envie selfies e façam planos.<br/> 
                O {{config('app.name')}} facilita todo o processo.
            `;
        $('#showmore').click(()=>{
            $('#readmore').html(data);
            $('#showmore').hide();
        })
    </script>
@endsection