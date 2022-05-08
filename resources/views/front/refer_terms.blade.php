@extends('front.master.main')


@section('content')
    <br/>
    <br/>
    <style>
        ul li{
            margin-bottom: 10px;
            list-style: outside;
        }
    </style>
    <div class="main-container container" id="main-container">

        <h2 class="text-center">SportCo Referral Program</h2>
        <hr/>
        <h4>How does it work? The Basics.</h4>
        <div class="col">
            <ul>
            <li>
                <strong>What do you have to do? </strong><br/>
                Copy your unique referral link from the Profile section of the SportCo website and share with as many
                friends as you want.
            </li>
            <li>
                <strong>What does your friend have to do?</strong><br/>
                Your friend registers on the SportCo website using your referral link. Then they post an article or
                image on the website.
            </li>
            </ul>
        </div>
        <br/>
        <h4>The Referral Process</h4>
        <div class="col">
            {{--<small style="font-size:6px" class="align-middle mr-2"><i class="fas fa-circle"></i></small>--}}
            <ul>
            <li>Existing registered users of SportCo who have already registered on the SportCo website can access the
                SportCo referral code by visiting the Profile section of the website.</li>
            <li>You can share your Referral link with your family, friends and acquaintances (“Referrals”).</li>
            <li>The Referral will have to register on the SportCo website using your unique referral link and go through
                the e-mail verification process.</li>
            <li>Once your Referral has successfully registered on the SportCo website using your Unique referral link and
                had completed the e-mail verfication, you will receive the “Referral Tokens” i.e. 2 SportCo Tokens.</li>
            <li>Once your Referral posts an article or image on the SportCo website and it gets approved by the SportCo editorial team you will receive an additional “Referral Bonus ” i.e. 8 SportCo Tokens. This is applicable only for the first post.</li>
            </ul>
        </div>
        <br/>
        <h4>Terms & Conditions</h4>
        <div class="col">
            <ul>
            <li>The email ID through which the Referrals sign-up on Sportco website, must not have been used for signing
                up with the Sportco earlier.</li>
            <li>A sign up with a different email address using the same device will not qualify as a valid referral and
                will be revoked.</li>
            <li>If your friends use someone else's referral link, the person whose link was used by the Referrals to
                register on SportCo would get benefits, even though you had referred them first. The link used to
                register with SportCo by your friend would be considered for the referral bonus.</li>
            <li>Tokens earned through referral program will be added to your Tokens on the site. You can view your Token
                balance on your profile page.</li>
            <li>The Tokens credited under this Referral Program shall be used only to redeem the SportCo products and
                services on SportCo Website. Such products and services shall be subject to availability and the
                respective rules/policy governing usage of such products.</li>
            <li>Your unique referral links should only be used for personal and non-commercial purposes.</li>
            <li>SportCo has a right to revoke the referral bonus or suspend your SportCo account at any time if we feel
                that the account is being misused or that SportCo’s referral program or its terms are violated or
                abused. Referral bonus earned as a result of fraudulent activities or misuse will be revoked and deemed
                invalid.</li>
            <li>Multiple accounts with your email address or fake email IDs is a violation of our policy and can render
                your account invalid for any referral or promotional scheme along with suspension of access of SportCo
                product and services.</li>
            <li>SportCo reserves all rights to change the terms and the referral bonus amount under SportCo Referral
                Program at any point in time, without any prior notice. Modifications of these terms will be effective
                from the time they are updated. You are requested to regularly update yourself with the terms and
                conditions of this program.</li>
            <li>SportCo may suspend, terminate or discontinue the SportCo Referral Program or any user's ability to
                participate in the program at any time for any reason at their discretion, without any prior notice.</li>
            </ul>
        </div>
        <br/><br/>

    </div>


@endsection
