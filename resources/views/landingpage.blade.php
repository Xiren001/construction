@extends('layouts.main')
@section('mainContent')

<div id="top" class="main container-fluid" style="background: linear-gradient(90deg, rgba(0,0,0,0.4990371148459384) 0%, rgba(0,0,0,0.4990371148459384) 100%) , url('{{ asset('assets/image/main2.jpg') }}'); background-size:100%; background-position:center; background-repeat: no-repeat;">
    <div class="main1" data-aos="fade-right" data-aos-duration="2000">
        <p class="main-p"> <strong style="color: #EBBA5A;">- Help you to build your dream - </strong></p>
        <h1 class="main-h1">Ground<strong style="color: #EBBA5A;">Work</strong>.</h1>
        <p class="main-p">Building Dreams, One Brick at a Time – Constructing the Future with Precision and Passion.</p>
        <div class="btn-appointment">
            <a href="{{ route('workload.readOnly') }}">
                <div>View Your Request</div>
                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path fill="#ffffff" d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                </svg>
            </a>
        </div>
    </div>
</div>


<div class="container-fluid service-hover">
    <div class="content-service">
        <div class="ser-con">
            <div class="con">
                <h5>Lorem</h5>
                <ul>
                    <li>
                        Lorem
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo voluptatem mollitia doloribus, possimus iusto explicabo corporis et autem, quasi voluptates dolor a temporibus. Architecto tenetur eveniet aliquam praesentium veritatis eaque.</p>
                    </li>
                    <li>
                        Lorem
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente unde perferendis ea illo, harum mollitia veniam minus aliquid earum velit architecto eum laborum omnis ut voluptate officia, doloremque quasi. Eius.</p>
                    </li>
                    <li>
                        Lorem
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim aliquid numquam reprehenderit fuga suscipit non quisquam ad maxime! Cum nemo esse debitis nobis, iste animi rem voluptatem! Vero, possimus eos.</p>
                    </li>
                    <li>
                        Lorem
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsa illum consequuntur illo, porro asperiores aut ipsam cumque eius a distinctio, fugit explicabo amet officiis. Neque delectus unde sunt atque laborum.</p>
                    </li>
                </ul>
            </div>
            <div class="con">
                <h5>Prosthodontics</h5>
                <ul>
                    <li>
                        Lorem
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Libero ipsam illum, commodi blanditiis dolores adipisci consectetur vitae eveniet repellat error obcaecati sunt ipsum voluptas quasi. Tempore asperiores excepturi beatae molestias.</p>
                    </li>
                    <li>
                        Lorem
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus consequatur eaque numquam atque unde minus dolore tempore laudantium ea impedit architecto dolores asperiores recusandae, vel, ullam eos magni quaerat sapiente.</p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="ser-con">
            <div class="con">
                <h5>lorem</h5>
                <ul>
                    <li>
                        lorem
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et, necessitatibus dignissimos corporis totam molestias, harum perspiciatis expedita facere dolor amet quam repellendus sint at fugit libero perferendis placeat ipsum explicabo!</p>
                    </li>
                    <li>
                        lorem
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem distinctio tempora hic ea beatae, maiores explicabo quos cum alias laudantium maxime harum atque ducimus doloribus porro similique voluptatum nulla laboriosam!</p>
                    </li>
                </ul>
                <div class="con2">
                    <h5>lorem</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas earum harum totam. At expedita officiis quos laudantium eaque numquam beatae, fugit neque magnam ea facilis quasi maxime omnis aliquid repudiandae!</p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid main-content">

    <div class="box">
        <div class="box-image">
            <img src="{{ asset('assets/image/tool.png') }}" alt="">
            <img src="{{ asset('assets/image/1.png') }}" alt="" width="30" height="30">
        </div>
        <h3>Architecture and Construction Work</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus illum ab tenetur dicta eaque.</p>
        <p><strong style="color:#EBBA5A; font-weight:bold;">See More</strong></p>
    </div>
    <div class="box">
        <div class="box-image">
            <img src="{{ asset('assets/image/ruler.png') }}" alt="">
            <img src="{{ asset('assets/image/2.png') }}" alt="" width="30" height="30">
        </div>
        <h3>Renovation and Material Supply</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus illum ab tenetur dicta eaque.</p>
        <p><strong style="color:#EBBA5A; font-weight:bold;">See More</strong></p>
    </div>
    <div class="box">
        <div class="box-image">
            <img src="{{ asset('assets/image/floor.png') }}" alt="">
            <img src="{{ asset('assets/image/3.png') }}" alt="" width="30" height="30">
        </div>
        <h3>Home Interior and Exterior Design</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus illum ab tenetur dicta eaque.</p>
        <p><strong style="color:#EBBA5A; font-weight:bold;">See More</strong></p>
    </div>


</div>


<div class="container-fluid main-content2">
    <div class="marquee-wrapper">
        <h1 data-aos="fade-up">Latest <strong style="color:#EBBA5A;">News</strong>.</h1>
        <div class="container-fluid">
            <div class="marquee-block">
                <div class="marquee-inner to-left">
                    <span>
                        <div class="marquee-item" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
                            <img class="marquee-img" src="{{ asset('assets/image/d1.jpeg') }}" width="200" alt="Maxino Dental Clinic">
                            <div class="marquee-item-div">
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                        </div>
                        <div class="marquee-item" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
                            <img class="marquee-img" src="{{ asset('assets/image/d2.jpeg') }}" width="200" alt="Maxino Dental Clinic">
                            <div class="marquee-item-div">
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit."</p>
                            </div>
                        </div>
                        <div class="marquee-item" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
                            <img class="marquee-img" src="{{ asset('assets/image/d3.jpeg') }}" width="200" alt="Maxino Dental Clinic">
                            <div class="marquee-item-div">
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                        </div>
                        <div class="marquee-item" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
                            <img class="marquee-img" src="{{ asset('assets/image/d4.jpeg') }}" width="200" alt="Maxino Dental Clinic">
                            <div class="marquee-item-div">
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                        </div>
                        <div class="marquee-item" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
                            <img class="marquee-img" src="{{ asset('assets/image/d5.jpeg') }}" width="200" alt="Maxino Dental Clinic">
                            <div class="marquee-item-div">
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                        </div>
                    </span>
                    <span>
                        <div class="marquee-item" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
                            <img class="marquee-img" src="{{ asset('assets/image/d1.jpeg') }}" width="200" alt="Maxino Dental Clinic">
                            <div class="marquee-item-div">
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                        </div>
                        <div class="marquee-item" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
                            <img class="marquee-img" src="{{ asset('assets/image/d2.jpeg') }}" width="200" alt="Maxino Dental Clinic">
                            <div class="marquee-item-div">
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                        </div>
                        <div class="marquee-item" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
                            <img class="marquee-img" src="{{ asset('assets/image/d3.jpeg') }}" width="200" alt="Maxino Dental Clinic">
                            <div class="marquee-item-div">
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit."</p>
                            </div>
                        </div>
                        <div class="marquee-item" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
                            <img class="marquee-img" src="{{ asset('assets/image/d4.jpeg') }}" width="200" alt="Maxino Dental Clinic">
                            <div class="marquee-item-div">
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                        </div>
                        <div class="marquee-item" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
                            <img class="marquee-img" src="{{ asset('assets/image/d5.jpeg') }}" width="200" alt="Maxino Dental Clinic">
                            <div class="marquee-item-div">
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                        </div>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection