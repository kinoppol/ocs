<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="<?php print site_url("images/handshake.png"); ?>" type="image/png">
        <title>OCS:ระบบฐานข้อมูลสำนักความร่วมมือ</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php print site_url("landing/css/bootstrap.css"); ?>">
        <link rel="stylesheet" href="<?php print site_url("landing/vendors/linericon/style.css"); ?>">
        <link rel="stylesheet" href="<?php print site_url("landing/css/font-awesome.min.css"); ?>">
        <link rel="stylesheet" href="<?php print site_url("landing/vendors/owl-carousel/owl.carousel.min.css"); ?>">
        <link rel="stylesheet" href="<?php print site_url("landing/vendors/lightbox/simpleLightbox.css"); ?>">
        <link rel="stylesheet" href="<?php print site_url("landing/vendors/animate-css/animate.css"); ?>">
        <link rel="stylesheet" href="<?php print site_url("landing/vendors/flaticon/flaticon.css"); ?>">
        <!-- main css -->
        <link rel="stylesheet" href="<?php print site_url("landing/css/style.css"); ?>">
		<link rel="stylesheet" href="<?php print site_url("landing/css/responsive.css"); ?>">

		<link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/dist/css/AdminLTE.min.css">

    <!-- JQuery DataTable Css -->
    <link href="<?php print site_url();?>template/adminbsb/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

	<link href="https://www.okler.net/previews/porto-admin/4.0.0/vendor/datatables/media/css/dataTables.bootstrap5.css" rel="stylesheet">
		
		<script>
			function order(){
				alert("นักเรียน-นักศึกษา ครู-อาจารย์ และบุคลากรทางการศึกษา ติดต่อขอใช้บริการได้ที่งานศูนย์ข้อมูลสารสนเทศ หรือที่ศูนย์บางนาอินเตอร์เน็ต");
			}
			</script>
		 <!-- Google Fonts -->
		 	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
			<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
			<link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
			<style>
				body{
					font-family: 'Kanit', sans-serif;
				}
				.row {
				display: flex;
				justify-content: space-between;
				}
				.row div { padding: 1em; }
			</style>
    </head>
    <body style="font-family: 'Kanit', sans-serif;">
        
        <!--================Header Menu Area =================-->
        <header class="header_area">
            <div class="main_menu">
            	<nav class="navbar navbar-expand-lg navbar-light">
					<div class="container box_1620">
						<!-- Brand and toggle get grouped for better mobile display -->
						<a class="navbar-brand logo_h" href="./"><img src="<?php print site_url("landing/img/ocs_logo.png"); ?>" alt="" width="100"></a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<ul class="nav navbar-nav menu_nav justify-content-center">
<li class="nav-item active"><a class="nav-link active" href="<?php print site_url("public/dashboard/index"); ?>">หน้าหลัก</a></li>
<!-- <li class="nav-item active"><a class="nav-link" href="<?php print site_url("public/dashboard/index"); ?>">ข้อมูลภาพรวม</a></li> -->
<li class="nav-item active"><a class="nav-link" href="<?php print site_url("public/dashboard/mou"); ?>">ค้นหา MOU</a></li>
<li class="nav-item active"><a class="nav-link" href="<?php print site_url("public/dashboard/business"); ?>">สถานประกอบการ</a></li>
<li class="nav-item active"><a class="nav-link" href="<?php print site_url("public/dashboard/school"); ?>">สถานศึกษา</a></li>
<li class="nav-item active"><a class="nav-link" href="<?php print site_url("public/dashboard/inv"); ?>">กรอ.อศ.</a></li>
<li class="nav-item active"><a class="nav-link" href="<?php print site_url("public/dashboard/about"); ?>">เกี่ยวกับระบบ</a></li>
</ul>
							<ul class="nav navbar-nav navbar-right">
								<!--
								
								<li class="nav-item"><a href="<?php print site_url("public/user/loginSelector"); ?>" class="tickets_btn">ลงชื่อเข้าใช้</a ></li>
								-->
								<li class="nav-item"><a href="<?php print site_url("public/user/loginSelector"); ?>" class="btn btn-primary">ลงชื่อเข้าใช้</a ></li>
							</ul>
						</div> 
					</div>
            	</nav>
            </div>
        </header>
        <!--================Header Menu Area =================-->
		<!--================Home Banner Area =================-->
        <section class="home_banner_area">
            <div class="banner_inner">
				<div class="container">
					<div class="row">
						<div class="col-lg-5">
							<div class="banner_content">
								<h2><br /></h2>
								<p></p>
							</div>
						</div>
						<div class="col-lg-7">
						</div>
					</div>
				</div>
            </div>
        </section>
        <!--================End Home Banner Area =================-->
        
        <?php print $content; ?>
        
        <!--================Footer Area =================-->
        <footer class="footer_area p_120">
        	<div class="container">
        		<div class="row footer_inner">
        			<div class="col-lg-5 col-sm-6">
        				<aside class="f_widget ab_widget">
        					<div class="f_title">
        						<h3>เกี่ยวกับเรา</h3>
        					</div>
        					<p><a href="http://boc2.vec.go.th" target="_blank">สำนักความร่วมมือ</a><br>
        					<a href="http://www.vec.go.th" target="_blank">สำนักงานคณะกรรมการการอาชีวศึกษา</a></p>
        				</aside>
        			</div>
        			<div class="col-lg-5 col-sm-6">
        				<aside class="f_widget news_widget">
							<!--
        					<div class="f_title">
        						<h3>รับข่าวสาร</h3>
        					</div>
        					<p>รับจดหมายอิเล็กทรอนิกส์</p>
        					<div id="mc_embed_signup">
                                <form target="_blank" action="news.php" method="get" class="subscribe_form relative">
                                	<div class="input-group d-flex flex-row">
                                        <input name="EMAIL" placeholder="Enter email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address '" required="" type="email">
                                        <button class="btn sub-btn"><span class="lnr lnr-arrow-right"></span></button>		
                                    </div>				
                                    <div class="mt-10 info"></div>
                                </form>
                            </div>
			-->
        				</aside>
        			</div>
        			<div class="col-lg-2">
        				<aside class="f_widget social_widget">
        					<div class="f_title">
        						<h3>ติดตามเรา</h3>
        					</div>
        					<p>บนโซเชียลมีเดีย</p>
        					<ul class="list">
        						<li><a href="#"><i class="fa fa-facebook"></i></a></li>
        						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
        						<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
        						<li><a href="#"><i class="fa fa-behance"></i></a></li>
        					</ul>
        				</aside>
        			</div>
        		</div>
        	</div>
        </footer>
        <!--================End Footer Area =================-->
        
        
        
        
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="<?php print site_url("landing/js/jquery-3.2.1.min.js"); ?>"></script>
        <script src="<?php print site_url("landing/js/popper.js"); ?>"></script>
        <script src="<?php print site_url("landing/js/bootstrap.min.js"); ?>"></script>
        <script src="<?php print site_url("landing/js/stellar.js"); ?>"></script>
        <script src="<?php print site_url("landing/vendors/lightbox/simpleLightbox.min.js"); ?>"></script>
        <script src="<?php print site_url("landing/vendors/isotope/imagesloaded.pkgd.min.js"); ?>"></script>
        <script src="<?php print site_url("landing/vendors/isotope/isotope-min.js"); ?>"></script>
        <script src="<?php print site_url("landing/vendors/owl-carousel/owl.carousel.min.js"); ?>"></script>
        <script src="<?php print site_url("landing/js/jquery.ajaxchimp.min.js"); ?>"></script>
        <script src="<?php print site_url("landing/vendors/counter-up/jquery.waypoints.min.js"); ?>"></script>
        <script src="<?php print site_url("landing/vendors/counter-up/jquery.counterup.min.js"); ?>"></script>
        <script src="<?php print site_url("landing/js/mail-script.js"); ?>"></script>
        <!--gmaps Js-->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
        <script src="<?php print site_url("landing/js/gmaps.min.js"); ?>"></script>
        <script src="<?php print site_url("landing/js/theme.js"); ?>"></script>

		    <!-- Jquery DataTable Plugin Js -->
	<script src="<?php print site_url();?>template/adminbsb/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <!--<script src="<?php print site_url();?>template/adminbsb/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="<?php print site_url();?>template/adminbsb/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="<?php print site_url();?>template/adminbsb/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="<?php print site_url();?>template/adminbsb/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="<?php print site_url();?>template/adminbsb/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="<?php print site_url();?>template/adminbsb/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="<?php print site_url();?>template/adminbsb/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="<?php print site_url();?>template/adminbsb/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script> -->

<script>
	$(function () {
    //$('.js-example-basic-single').select2();
    $('.dataTable').DataTable( {
                    "oLanguage": {
                    "sLengthMenu": "แสดง&nbsp; _MENU_ &nbsp;รายการ ต่อหน้า",
                    "sZeroRecords": "ไม่พบข้อมูลที่ค้นหา",
                    "sInfo": "แสดงรายการที่ &nbsp; _START_ &nbsp;ถึง&nbsp; _END_ &nbsp;จากทั้งหมด&nbsp; _TOTAL_ &nbsp;รายการ",
                    "sInfoEmpty": "แสดงรายการที่&nbsp; 0 &nbsp;ถึงรายการที่&nbsp; 0 &nbsp;จากทั้งหมด&nbsp; 0 &nbsp;รายการ",
                    "sInfoFiltered": "(จากรายการทั้งหมด&nbsp; _MAX_ &nbsp;รายการ)",
                    "sSearch": "<i class=\"material-icons\">filter_list</i> กรอง :",

                                  },
								  dom: 'Bfrtip',
        responsive: true,
        buttons: [
             'excel', { // กำหนดพิเศษเฉพาะปุ่ม pdf
                "extend": 'pdf', // ปุ่มสร้าง pdf ไฟล์
                "text": 'PDF', // ข้อความที่แสดง
                "pageSize": 'A4',   // ขนาดหน้ากระดาษเป็น A4           
                "pageOrientation": 'landscape', 
                "customize":function(doc){ // ส่วนกำหนดเพิ่มเติม ส่วนนี้จะใช้จัดการกับ pdfmake
                    // กำหนด style หลัก
                    doc.defaultStyle = {
                        font:'THSarabun',
                        fontSize:16                                 
                    };
                }
            }, // สิ้นสุดกำหนดพิเศษปุ่ม pdf
             'print'
        ]
                });
			}
	);
	<?php print $_SESSION['FOOTSCRIPT']; ?>
			</script>
            <?php print $_SESSION['FOOTSYSTEM']; ?>
    </body>
</html>
