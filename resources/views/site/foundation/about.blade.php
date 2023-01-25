@extends('layouts.site')
@section('meta')
<title>{{ config('app.name') }}</title>

<meta name="title" content="{{ config('app.name') }}" />
<meta name="robots" content="all" />

<meta property="og:site_name" content="{{ config('app.name') }}" />
<meta property="og:image" content="{{ asset('assets/images/logo1.png') }}" />
<meta property="og:image:width" content="180" />
<meta property="og:image:height" content="50" />

<meta property="og:type" content=website />
<meta property="og:title" content="{{ config('app.name') }}" />

<meta name="twitter:title" content="{{ config('app.name') }}" />
<meta name="twitter:image" content="{{ asset('assets/images/logo1.png') }}" />
@endsection
@section('css')
<style>
	.img-1-text {
		font-size: 13px;
		color: #022d62;
	}
	.iframe-youtube-video{
		height: 350px;
		border: 3px solid #6c066c;
	}
	.border-left-0{
		border-left: none !important;
	}
</style>
@endsection
@section('content')
<!--================================= About 1-->
<section class="space-pt" id="about">
	<div class="container">
		<div class="row align-items-center mb-4 mb-md-5">
			<div class="col-lg-6 mb-4 mb-lg-0">
				<iframe class="border-radius iframe-youtube-video" src="https://www.youtube.com/embed/unDNTG3T1H0?rel=0" frameborder="0"></iframe>
			</div>
			<div class="col-lg-6">
				<h5 class="text-uppercase text-primary">What is MACS doing?</h5>
				<p class="mb-4">
					MACS's work focuses on five key areas: policy dialogue, capacity building, data collection, research, and advocacy. MACS Charity Foundation is working in line with UNFPA to facilitates the development
					of evidence-based policies to ensure that older people’s issues are addressed.</p>
				<p>MACS aims to create a society for all ages in which people everywhere are able to age with security, dignity, and full rights.</p>
				<p>In so doing,MACS have since her conception offer daily weekly and monthly support to hundreds of age
					people 78% of whom are in the grass-field locality in Cameroon by providing them with essential need
					like food items amongst which is breakfast,warm clothing’s and nursing caregivers.</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 mb-4 mb-md-0">
				<div class="feature-info feature-info-style-03">
					<div class="feature-info-content">
						<h4 class="mb-3 fw-normal feature-info-title">WHO ARE WE?</h4>
						<p class="mb-0">A non-governmental organization working to meet up with the UNICEP policy of the
							right of every child.</p>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="feature-info feature-info-style-03">
					<div class="feature-info-content">
						<h4 class="mb-3 fw-normal feature-info-title">Our Core Values</h4>
						<p class="mb-0">Service beyond self
							Empowerment,
							Accountability,
							Integrity,
							Transparency,
							Sustainable partnership,
							Local outreach.</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 mb-4 mb-md-0">
				<div class="feature-info feature-info-style-03">
					<div class="feature-info-content">
						<h4 class="mb-3 fw-normal feature-info-title">Our Mission </h4>
						<p class="mb-0">To support development in Africa through access to quality livelihood,education
							and economic opportunities.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="row mt-5 mb-5">
			<div class="col-md-4">
				<div class="feature-info feature-info-style-03">
					<div class="feature-info-content">
						<h4 class="mb-3 fw-normal feature-info-title">Our Vision</h4>
						<p class="mb-0">To see that through donating to the less Privilege,we can secure the youth with
							education beyond basic level,and enjoy economic inclusion.</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 mb-4 mb-md-0">
				<div class="feature-info feature-info-style-03">
					<div class="feature-info-content">
						<h4 class="mb-3 fw-normal feature-info-title">Our Goal</h4>
						<p class="mb-0">To provide sustainable and life-changing interventions,which significantly
							reduces starvation,illiteracy in under-represented children and promoting economic equality
							in Africa.</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 mb-4 mb-md-0">
				<div class="feature-info feature-info-style-03">
					<div class="feature-info-content">
						<h4 class="mb-3 fw-normal feature-info-title">Our Focus</h4>
						<p>Donations of basic amenities,
							Protecting the interest of woman & children,
							Caring for the aging,
							Education and Training,
							Research and Advocacy.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--=================================  About -->

<!--=================================About 2-->
<section class="imageblock-section mb-0 mb-md-5 mt-5">
	<div class="col-md-6 imageblock-section-img">
		<div class="background-image-holder">
			{{-- style="background: url({{asset('assets/images/bg/04.jpg')}})no-repeat center center / cover; opacity: 1;"> --}}
			<iframe class="iframe-youtube-video border-left-0 h-100" src="https://www.youtube.com/embed/unDNTG3T1H0?rel=0" frameborder="0"></iframe>
		</div>
	</div>
	<div class="container">
		<div class="row justify-content-end">
			<div class="col-md-6 ps-md-4">
				<div class="py-5">
					<h2 class="text-dark">About</h2>
					<div class="mb-3 d-flex">
						<i class="fas fa-arrow-right pe-3 pt-2 text-dark"></i>
						<div>
							<h6 class="text-dark">MACS Charity Foundation is a non-governmental organisation.</h6>
							<p class="mb-0">MACS Charity Foundation is a non-governmental organisation established since
								2015 when the President and Founder Mr Atanga Marcellus decided to extend his act of
								humanitarian outreach which has been part of him since his University day’s,and for
								successes,he has dedicated to creating a realistic and effective difference in the lives
								of underprivileged people across Africa,amongst whom are women,children and the ageing.
							</p>
						</div>
					</div>
					<div class="mb-3 d-flex">
						<i class="fas fa-arrow-right pe-3 pt-2 text-dark"></i>
						<div>
							<h6 class="text-dark">MACS Charity Foundation point of contentious for over six (6) years
								today is tilted in Cameroon Northwest and Southwest region where millions of people
								especially women and children have flee from their homes due to socio-political issues
								in and about the anglophone region of Cameroon which has been a matter of contention
								through out the post -colonial period.</h6>
							<p>This crises has cause hundreds of thousands to flee the country with others internally
								displaced.This people are so ancient and mysterious about,with over 70.000 refugees who
								have fled to  seek refuge in Nigeria,majority being women and children.In addition to
								these,MACS is also extending their support to the people of Northern Nigeria,who are
								also heavily affected by the attacks of the boko haram insurgent with majority of whom
								are women and children.</p>
						</div>
					</div>
					<div class="d-flex">
						<i class="fas fa-arrow-right pe-3 pt-2 text-dark"></i>
						<div>
							<p class="mb-0">MACS Charity Foundation has for sometime now,worked so hard to see that they
								can in their on small way savage the humanitarian situation of the population which was
								fast deteriorating and causing them a serious consequences on livelihood and living
								conditions.</p>
							<p>We do this through our different focus areas; Eg:Food </p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--=================================   About -->

<!--=================================About 3-->
	<section class="imageblock-section mb-0 mb-md-5 ">
		<div class="col-md-6 imageblock-section-img">
			<div class="background-image-holder">
				<iframe class="iframe-youtube-video border-left-0 h-100" src="https://www.youtube.com/embed/pY4Hl4J_vtM?rel=0" frameborder="0"></iframe>
			</div>
		</div>
		<div class="container">
			<div class="row justify-content-end">
				<div class="col-md-6 ps-md-4">
					<div class="py-5">
						<h2 class="text-dark">Empowerment</h2>
						<div class="mb-3 d-flex">
							<i class="fas fa-arrow-right pe-3 pt-2 text-dark"></i>
							<div>
								<h6 class="text-dark">Donation,Water,Shelter,clothings,sanitation and hygiene
									services,Medical Facilities for some of this children separated from their parents need
									psycho-social care,Education and Training, and also Economic Empowerment.</h6>
								<p class="mb-0">Under our Education and Training focus, we provide access to quality
									alternative education for disadvantaged and out-of-school through MACS Charity
									Foundation Radio School and Safe spaces since the conflict has cause the damage and
									closure of schools and hospitals disrupting access to education and health services thus
									leaving children even more vulnerable and robbing them of their future.We provide access
									to quality education for public schoolchildren through our Learning Resource Centers.
								</p>
								<p>Under our Economic Empowerment focus, we provide rural women entrepreneurs with small
									scale loans through our Women Support Programme,and looking forth in creating a
									Microcredit Programme,We empower young women to start their fashion design businesses
									through our Business Empowerment for Women Programme. We also conduct yearly seminars,
									workshops and youth empowerment programmes.</p>
							</div>
						</div>
						<div class="mb-3 d-flex">
							<i class="fas fa-arrow-right pe-3 pt-2 text-dark"></i>
							<div>
								<h6 class="text-dark">MACS Charity Foundation is on the ground across Cameroon and Nigeria
									to safe the children lives Particularly,to help them cope with the impact of the
									conflict,and to help them to recover and resume their childhoods.Conflict and violence
									has been a push factor of many families of getting into poverty and deprivation.</h6>
								<p class="mb-0">With this,children under the age of 5yrs in most of the refugees camps
									suffers from acute malnutrition which is a call for concern to our organization.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<!--=================================   About -->

<!--================================= About 4 -->
<section class="imageblock-section space-pb">
	<div class="col-md-6 imageblock-section-img">
		<div class="background-image-holder">
			<iframe class="iframe-youtube-video border-left-0 h-100" src="https://www.youtube.com/embed/QfqZLiRsiow?rel=0" frameborder="0"></iframe>
		</div>
	</div>
	<div class="container">
		<div class="row justify-content-end">
			<div class="col-md-6 ps-md-4">
				<div class="pt-5 pb-0">
					<div class="d-flex">
						<i class="fas fa-arrow-right pe-3 pt-2 text-dark"></i>
						<div>
							<h6 class="text-dark">At MACS Charity Foundation,donating to global charity is an act of
								humanitarian outreach,therefore the Foundation had taken the responsibility of working
								towards savaging some of the major problems face by the underprivileged and vulnerable
								through their assistance and building resilience and also an improved local
								sustainability.Providing nutritious diets and also offering Emergency relief Programme.
							</h6>
							<p class="mb-0">Humanitarian needs are multiplying by the hour as the conflict
								intensifies.Children have been killed some wounded and some of this children have fled
								for their lives and have been separated from their loved ones,the more reason they need
								our help.</p>
							<p>The ward philanthropist meaning to love people,through the act of voluntary
								giving,therefore,we wish to thank the different organizations,groups and also
								individuals alike for thier donations through MACS Charity Foundation for promoting the
								common good of humanity.</p>
						</div>
					</div>
					<div class="d-flex">
						<i class="fas fa-arrow-right pe-3 pt-2 text-dark"></i>
						<div>
							<h6 class="text-dark">MACS Charity Foundation is working tirelessly...</h6>
							<p class="mb-0">MACS Charity Foundation is working tirelessly in seeing that the young
								African Population living in total desperation and arc-jet poverty do to
								hostility,conflict zones,most especially in Cameroon and in particular the Northwest and
								Southwest region,and also in Northern Nigeria are given access to quality Education,and
								also vocational training’s wherein this will help to reduce the rate of crime wave this
								group of people may get into if allowed to,and the effect their society and the world at
								large may get from them.
								Donate today and make a meaning to once life.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--=================================   About -->

<!--================================= About 5-->
	<section class="space-pt" id="it-consultancy-about">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6 mb-4 mb-lg-0">
					<h5 class="mb-4"> MACS Charity Foundation For The Ageing</h5>
					<p class="mb-4"> The world is ageing rapidly. People aged 60 and older make up 12.3 per cent of the
						global population,this ratio may raise in the years to come.Ageing is a triumph of development:
						People are living longer because of better nutrition, sanitation, health care, education and
						economic well-being. Although an ageing world poses social and economic challenges, the right set of
						policies can equip individuals, families and societies to address these challenges and to reap its
						benefits.</p>
					<p>MACS is working with UNFPA polices to raise awareness about population ageing and the need to harness
						its opportunities and address its challenges.MACS Charity Foundation also supports research and data
						collection to provide a solid base for policies and planning, and makes sure ageing issues are
						integrated into national development programmes and poverty reduction strategies.</p>
				</div>
				<div class="col-lg-6">
					<iframe class="border-radius iframe-youtube-video" src="https://www.youtube.com/embed/nc0o_QgkPPc?rel=0" frameborder="0"></iframe>
				</div>
			</div>
		</div>
	</section>
<!--================================= About -->

<!--=================================   About 6-->
<section class="space-ptb">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-9">
				<div class="section-title text-center">
					<h5 class="text-muted">An ageing world</h5>
					<h4>Preserving the health, safety and independence of older persons MACS is working in line with
						with this</h4>
					<p class="mb-4">Population ageing is one of the most significant trends of the 21st century. One in
						eight people in the world are aged 60 or over. As long as fertility rates continue to decline
						and life expectancy continues to rise, older people will steadily increase as a proportion of
						the population. And while population ageing is a global phenomenon, it is progressing fastest in
						developing countries – including those with large youth populations.The contributions of older
						persons to society are invaluable. Many such contributions cannot be measured in economic terms
						– such as caregiving, volunteering, and passing cultural traditions to younger generations.</p>
					<p> Older persons are also important as leaders, often playing a role in conflict resolution within
						families, in communities and even in emergency situations.</p>
					<p>Yet they are also often vulnerable. They may have weak social support networks, lack income, or
						be subject to discrimination and abuse. Older women, in particular, are vulnerable to
						discrimination, social exclusion and denial of the right to inherit property. Women also tend to
						live longer than men, and may experience deepening poverty as they age.
					</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 mb-4 mb-sm-0">
				<iframe class="border-radius iframe-youtube-video" src="https://www.youtube.com/embed/Z0SC4kZXVhs?rel=0" frameborder="0"></iframe>
			</div>
			<div class="col-sm-6">
				<iframe class="border-radius iframe-youtube-video" src="https://www.youtube.com/embed/ho-6zTHqkKc?rel=0" frameborder="0"></iframe>
			</div>
		</div>
</section>
<!--=================================  About -->
@endsection