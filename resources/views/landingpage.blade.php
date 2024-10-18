@extends('layouts.main')
@section('mainContent')

<div id="top" class="main container-fluid" style="background: linear-gradient(to left, rgba(255, 255, 255, 0), rgba(255, 255, 255, 1)), url('{{ asset('assets/image/bg.jpg') }}'); background-size: 70% 100%; background-position: right center; background-repeat: no-repeat;">
    <div class="main1" data-aos="fade-right" data-aos-duration="2000">
        <h1 class="main-h1">Maxino Dental Clinic</h1>
        <p class="main-p">An Oral Health Service Provider dedicated to offering an array of dental services and treatment options equipped with state-of-the-art equipments, along with trained staff and a highly recommended dentist, to ensure your optimal oral health.</p>
        <div class="btn-appointment">
            <a id="book-appointment" href="#">
                <div>Book Appointment</div>
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
                <h5>General Dentistry</h5>
                <ul>
                    <li>
                        Surgery
                        <p>Procedures such as tooth extractions or minor oral surgeries to address issues like impacted teeth.</p>
                    </li>
                    <li>
                        Periodontics
                        <p>Focuses on the health of the gums and structures supporting the teeth, including treatment for gum diseases.</p>
                    </li>
                    <li>
                        Restorative
                        <p>Involves repairing damaged or decayed teeth, using treatments like fillings or crowns to restore function.</p>
                    </li>
                    <li>
                        Root Canal Treatment
                        <p>A procedure to remove infected pulp from inside a tooth to prevent further decay and save the tooth.</p>
                    </li>
                </ul>
            </div>
            <div class="con">
                <h5>Prosthodontics</h5>
                <ul>
                    <li>
                        Crowns & Bridges
                        <p>Restorative treatments to replace missing teeth or cover damaged teeth with artificial crowns or bridges.</p>
                    </li>
                    <li>
                        Dentures
                        <p>Removable appliances used to replace missing teeth and restore a patient's smile and oral function.</p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="ser-con">
            <div class="con">
                <h5>Cosmetics </h5>
                <ul>
                    <li>
                        Veeners
                        <p>Veneers are thin, custom-made shells placed over the front of teeth to enhance their appearance, providing a more natural and uniform look.</p>
                    </li>
                    <li>
                        Diastema Closure
                        <p>Diastema closure is a dental procedure aimed at closing gaps between teeth, often using methods like bonding, veneers, or orthodontic treatments.</p>
                    </li>
                </ul>
                <div class="con2">
                    <h5>Orthodontics</h5>
                    <p>Orthodontics focuses on correcting misaligned teeth and jaws to improve dental function and aesthetics using methods like braces or aligners. Examples include traditional metal braces, which gradually move teeth into place, and Invisalign, a clear, removable aligner that straightens teeth discreetly.</p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid main-content">
    <div class="content-vid" data-aos="fade-up">
        <h1>
            Let's make your first visit as easy as possible.
        </h1>
        <div class="con-process">
            <div class="concon">
                <div>
                    <h4>Sign up</h4>
                    <p>Start by creating an account with us. Signing up is quick and easy, and it’s the first step to unlocking all our services. Once registered, you’ll be able to manage appointments, complete necessary forms, and choose your preferred payment method. Click the sign-up button to get started!</p>
                </div>
                <div>
                    <h4>Book Appointment</h4>
                    <p>With your account set up and forms completed, you’re ready to book your first appointment! Our easy-to-use online booking system allows you to select a time that works for you. Don’t miss out—secure your appointment today to take the next step toward better dental health.</p>
                </div>
            </div>
            <div class="concon">
                <div>
                    <h4>Email or Download our Patient form</h4>
                    <p>After signing up, you’ll need to fill out our patient form. You can either download it or receive it by email—whichever is more convenient for you. This form helps us understand your needs and ensure you get the best care possible. Complete this step to prepare for your first appointment.</p>
                </div>
                <div>
                    <h4>payment option</h4>
                    <p>Choose how you’d like to pay. We offer various payment methods, including cashless options like GCASH for your convenience. After booking your appointment, simply select your preferred payment method to complete the process. You're now all set for your visit!</p>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="container-fluid main-content2">
    <div class="marquee-wrapper">
        <h4 data-aos="fade-up">Here's what people are saying about the Maxino Dental Clinic!</h4>
        <div class="container-fluid">
            <div class="marquee-block">
                <div class="marquee-inner to-left">
                    <span>
                        <div class="marquee-item" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
                            <img class="marquee-img" src="{{ asset('assets/image/d1.jpg') }}" width="200" alt="Maxino Dental Clinic">
                            <div class="marquee-item-div">
                                <p>"I applied twice but failed, after smile make over with Maxino dental clinic, I made it on my 3rd try."</p>
                            </div>
                        </div>
                        <div class="marquee-item" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
                            <img class="marquee-img" src="{{ asset('assets/image/d2.jpg') }}" width="200" alt="Maxino Dental Clinic">
                            <div class="marquee-item-div">
                                <p>"Let your dreams take flight and soar to new heights by choosing the best dental clinic to help you achieve your best smile."</p>
                            </div>
                        </div>
                        <div class="marquee-item" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
                            <img class="marquee-img" src="{{ asset('assets/image/d3.jpg') }}" width="200" alt="Maxino Dental Clinic">
                            <div class="marquee-item-div">
                                <p>"Your confidence can reach new levels with a brighter, healthier smile. Choose the best dental care to make it happen."</p>
                            </div>
                        </div>
                        <div class="marquee-item" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
                            <img class="marquee-img" src="{{ asset('assets/image/d4.jpg') }}" width="200" alt="Maxino Dental Clinic">
                            <div class="marquee-item-div">
                                <p>"A great smile can change everything. Trust Maxino Dental Clinic to give you the smile you've always wanted."</p>
                            </div>
                        </div>
                        <div class="marquee-item" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
                            <img class="marquee-img" src="{{ asset('assets/image/d5.jpg') }}" width="200" alt="Maxino Dental Clinic">
                            <div class="marquee-item-div">
                                <p>"I always hesitated to smile in photos, but after visiting Maxino Dental Clinic, I can't stop smiling now."</p>
                            </div>
                        </div>
                    </span>
                    <span>
                        <div class="marquee-item" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
                            <img class="marquee-img" src="{{ asset('assets/image/d1.jpg') }}" width="200" alt="Maxino Dental Clinic">
                            <div class="marquee-item-div">
                                <p>"I applied twice but failed, after smile make over with Maxino dental clinic, I made it on my 3rd try."</p>
                            </div>
                        </div>
                        <div class="marquee-item" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
                            <img class="marquee-img" src="{{ asset('assets/image/d2.jpg') }}" width="200" alt="Maxino Dental Clinic">
                            <div class="marquee-item-div">
                                <p>"Let your dreams take flight and soar to new heights by choosing the best dental clinic to help you achieve your best smile."</p>
                            </div>
                        </div>
                        <div class="marquee-item" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
                            <img class="marquee-img" src="{{ asset('assets/image/d3.jpg') }}" width="200" alt="Maxino Dental Clinic">
                            <div class="marquee-item-div">
                                <p>"Your confidence can reach new levels with a brighter, healthier smile. Choose the best dental care to make it happen."</p>
                            </div>
                        </div>
                        <div class="marquee-item" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
                            <img class="marquee-img" src="{{ asset('assets/image/d4.jpg') }}" width="200" alt="Maxino Dental Clinic">
                            <div class="marquee-item-div">
                                <p>"A great smile can change everything. Trust Maxino Dental Clinic to give you the smile you've always wanted."</p>
                            </div>
                        </div>
                        <div class="marquee-item" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
                            <img class="marquee-img" src="{{ asset('assets/image/d5.jpg') }}" width="200" alt="Maxino Dental Clinic">
                            <div class="marquee-item-div">
                                <p>"I always hesitated to smile in photos, but after visiting Maxino Dental Clinic, I can't stop smiling now."</p>
                            </div>
                        </div>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection