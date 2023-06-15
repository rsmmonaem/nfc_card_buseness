<style>
	
.card {
  position: relative;
  overflow: hidden;
  text-align: left;
  line-height: 1.4em;
  border-radius: 19px;
  background-color: #141414;
  color: ;
}

.card * {
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  -webkit-transition: all 0.25s ease;
  transition: all 0.25s ease;
}

.card .card-bg {
    max-width: 100%;
    width: 100%;
    vertical-align: top;
    opacity: 0.85;
}

.card figcaption {
  width: 100%;
  padding: 25px;
  position: relative;
  background-color: #ffffff;
}

.card figcaption:before {
  position: absolute;
  content: '';
  bottom: 100%;
  left: 0;
  width: 0;
  height: 0;
  border-style: solid;
  border-width: 174px 0 0 441px;
  border-color: transparent transparent transparent #dee2e6;
}

.card figcaption a:hover {
  opacity: 1;
}

.card .profile {
    border-radius: 50%;
    position: absolute;
    bottom: 100%;
    left: 33px;
    z-index: 1;
    width: 164px;
    height: 164px;
	top: -216px;
    opacity: 1;
    box-shadow: 0 0 15px rgb(0 0 0 / 30%);
}

.card h2 {
  margin: 0 0 5px;
  font-weight: 400;
}

.card h2 span {
  display: block;
  font-size: 0.5em;
  color: #2980b9;
}

.card p {
  margin: 0 0 10px;
  font-size: 0.8em;
  letter-spacing: 1px;
  color: #ffffff;
}

.contact-details .icon-circle {
    display: flex;
    text-align: center;
    justify-content: center;
    align-items: center;
    background-color: #6610f2;
    font-size: 21px;
    height: 42px;
    width: 42px;
    border-radius: 100%;
    padding: 0 10px;
}

.contact-details .icon-circle i {
  font-size: 29px !important;
  background: #ffffff;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.btn-outline-dark {
  color: #ffffff;
  background-color: transparent;
  background-image: none;
  border-color: #ffffff;
}

.article .article-header .article-title h2 a {
  color: #4608ad;
}

.product-item .product-name {
  color: #4608ad;
}

.article.article-style-b .article-details p {
  color: #4608ad;
}

.article .article-header .article-badge .article-badge-item{
  background: #141414;
  color: #4608ad;
}
li {
    list-style: none;
}
.contact-details-item {
  color: #4608ad;
  }
</style>

<div class="content-wrapper">
				<!-- <div class="content-header">
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1 class="m-0">user</h1>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-right">
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item active">Create user</li>
								</ol>
							</div>
						</div>
					</div>
				</div> -->
    <section class="content">
	<div class="container">


<div class="row d-flex justify-content-center">
	<div class="col-md-5 p-0">
		<div class="card shadow m-0 mt-1">


	<figure class="custom-card m-0">
		<img src="<?= base_url() ?>assets/user/assets/uploads/card-banner/1683095063-284792808_717869502692945_5643469103008369407_n.jpg"
			class="card-bg">
		<figcaption>
			<img src="<?= base_url() ?>uploads/institute/<?= $data->inst_logo ?>" alt="<?= $data->inst_logo ?>"
				class="profile">
			<h2 class="mb-3"><?= $data->inst_name ?><span><?= $data->education ?></span></h2>
			<p><?= $data->bio ?></p>

			<ul class="contact-details">

				<li>
					<a href="tel:<?= $data->whatsapp ?>" class="media contact-details-item">
						<span class="mr-3 icon-circle"><i class="m-0 fas fa-mobile-alt"></i></span>
						<h6 class="mt-0 mb-0 text-left"><?= $data->whatsapp ?></h6>
					</a>
				</li>

				<br>
				
				<li>
					<a href="mailto:<?= $data->email ?>" class="media contact-details-item">
						<span class="mr-3 icon-circle"><i class="m-0 far fa-envelope"></i></span>
						<h6 class="mt-0 mb-0 text-left"><?= $data->email ?></h6>
					</a>
				</li>
				<br>

				<li>
					<a href="https://goo.gl/maps/tUhrNPDxa7Z99ZpQ6?coh=178572&amp;amp;entry=tt"
						target="_blank" class="media contact-details-item">
						<span class="mr-3 icon-circle"><i class="m-0 fas fa-map-marker-alt"></i></span>
						<h6 class="mt-0 mb-0 text-left"><?= $data->map_address?></h6>
					</a>
				</li>
				<br>

				<li>
					<a href="<?= $data->facebook ?>" target="_blank"
						class="media contact-details-item">
						<span class="mr-3 icon-circle"><i class="m-0 fab fa-facebook"></i></span>
						<h6 class="mt-0 mb-0 text-left">Facebook</h6>
					</a>
				</li>
				<br>

				<li>
					<a href="<?= $data->instagram ?>" target="_blank"
						class="media contact-details-item">
						<span class="mr-3 icon-circle"><i class="m-0 fab fa-instagram"></i></span>
						<h6 class="mt-0 mb-0 text-left">Instagram</h6>
					</a>
				</li>
				<br>

				<li>
					<a href="<?= $data->linkedin ?>" target="_blank"
						class="media contact-details-item">
						<span class="mr-3 icon-circle"><i class="m-0 fab fa-linkedin-in"></i></span>
						<h6 class="mt-0 mb-0 text-left">LinkedIn</h6>
					</a>
				</li>
				<br>

				<li>
					<a href="<?= $data->github ?>" target="_blank"
						class="media contact-details-item">
						<span class="mr-3 icon-circle"><i class="m-0 fab fa-github"></i></span>
						<h6 class="mt-0 mb-0 text-left">Github</h6>
					</a>
				</li>
				<br>

				<li>
					<a href="<?= $data->facebook_page ?>" target="_blank"
						class="media contact-details-item">
						<span class="mr-3 icon-circle"><i class="m-0 fab fa-facebook-f"></i></span>
						<h6 class="mt-0 mb-0 text-left">Facebook Page - LinkMe NFC Card</h6>
					</a>
				</li>
				<br>


				<li>
					<a href="https://wa.me/<?= $data->whatsapp ?>" target="_blank"
						class="media contact-details-item">
						<span class="mr-3 icon-circle"><i class="m-0 fab fa-whatsapp"></i></span>
						<h6 class="mt-0 mb-0 text-left">WhatsApp</h6>
					</a>
				</li>


			</ul>
			<hr>
			<div class="social-buttons mt-3 text-center">
				<a id="download-file" download="" href="#"
					class="btn btn-sm btn-icon icon-left btn-outline-light col-md-5 mt-1 mr-1 ml-1"><i
						class="fas fa-download"></i> Add to Phone Book</a>
				<!-- <a data-toggle="modal" data-target="#socialShare" href="#"
					class="btn btn-sm btn-icon icon-left btn-outline-light col-md-5 mt-1 mr-1 ml-1"><i
						class="fas fa-share-alt"></i> Share</a> -->
			</div>
		</figcaption>
	</figure>
</div>
</div>
    </section>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js">
    </script>
