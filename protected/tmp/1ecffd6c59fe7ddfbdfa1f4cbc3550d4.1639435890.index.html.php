<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title> 南素里基督教会(SOUTH SURREY CHRISTIAN ASSEMBLY) </title>

	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/i/images/logo.png" />

	<!-- Styles -->
	<link rel="stylesheet" href="<?php echo htmlspecialchars($common['cssfolder'], ENT_QUOTES, "UTF-8"); ?>/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo htmlspecialchars($common['cssfolder'], ENT_QUOTES, "UTF-8"); ?>/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo htmlspecialchars($common['cssfolder'], ENT_QUOTES, "UTF-8"); ?>/et-line.css">
	<link rel="stylesheet" href="<?php echo htmlspecialchars($common['cssfolder'], ENT_QUOTES, "UTF-8"); ?>/magnific-popup.css">
	<link rel="stylesheet" href="<?php echo htmlspecialchars($common['cssfolder'], ENT_QUOTES, "UTF-8"); ?>/owl.carousel.min.css">
	<link rel="stylesheet" href="<?php echo htmlspecialchars($common['cssfolder'], ENT_QUOTES, "UTF-8"); ?>/owl.theme.default.min.css">
	<link rel="stylesheet" href="<?php echo htmlspecialchars($common['cssfolder'], ENT_QUOTES, "UTF-8"); ?>/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo htmlspecialchars($common['cssfolder'], ENT_QUOTES, "UTF-8"); ?>/style.css">
	<link rel="stylesheet" href="<?php echo htmlspecialchars($common['cssfolder'], ENT_QUOTES, "UTF-8"); ?>/responsive.css">
    <link rel="stylesheet" href="<?php echo htmlspecialchars($common['cssfolder'], ENT_QUOTES, "UTF-8"); ?>/paging.css">
    

</head>
<body id="wrap" data-spy='scroll' data-target='#navbar-header' data-offset='0'>
	<!-- preloader-wrapper start -->
	<div class="preloader-wrapper">
		<div class="spinner"></div>
	</div>
	<!-- preloader-wrapper end -->

	<!-- Header-area -->
	<header id="header-area" data-scroll-index="0" class="header-img-bg">

		<!-- header-navigation -->
		<div class="container z-index">
			<nav id="navbar-header" class="navbar navbar-expand-lg">
				<a class="navbar-brand" href="index.html">南素里基督教会</a>
				<button class="responsive-nav-btn navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="ion-navicon"></span>
				</button>

				<div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
					<ul class="navbar-nav mr-right">
						<li class="nav-item active">
							<a class="nav-link"  href="<?php echo url(array('c'=>'main', 'a'=>'index', ));?>">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-scroll-nav="1" href="#">主日信息</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-scroll-nav="2" href="#">福音信息</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-scroll-nav="3" href="#">特别聚会</a>
						</li>
                        <li class="nav-item">
                            <a class="nav-link" data-scroll-nav="4" href="#">儿童圣经故事</a>
                        </li>
						<li class="nav-item">
							<a class="nav-link" data-scroll-nav="5" href="#">联系我们</a>
						</li>
					</ul>
				</div>
			</nav>
		</div> <!-- /header-navigation -->

		<!-- header-bottom -->
		<div class="header-bottom">
			<div class="container">
				<div class="row">
					<div class="owl-carousel owl-slider">
                        <div class="col-md-8 item">
							<h2>南素里基督教会</h2>
                            <p><a href="<?php echo url(array('c'=>'hymns', 'a'=>'index', ));?>">赞美诗选</a></p>
							<p>主日网上聚会信息：</p>
                            <p>开始时间: 三月29日 15时</p>
                            <p>加入ZOOM会议: <a href="https://us04web.zoom.us/j/3924743928">点击此处加入</a></p>
                            <p>ZOOM 会议ID: 392 474 3928</p>
                            <p>ZOOM 会议密码: 232338</p>
                            <p>网上聚会视频直播链接: <a href="https://youtu.be/DoNtHtJtpGo" style="margin-left: 10px;text-decoration:underline;">主日信息直播</a></p>
						</div>
                        <!--
						<div class="col-md-8 item">
							<h2>南素里基督教会</h2>
							<p>南素里基督教会于主历2014年3月9日开始于加拿大BC省的南素里地区，我们的异象：在南素里这块地方广传福音，造就圣徒。</p>
							<a href="#sunday-message-section" class="h-btn">主日信息</a>
						</div>
                        <div class="col-md-8 item">
							<h2>主日敬拜</h2>
							<p>每个主日下午 2：30 ～ 3：10，掰饼聚会，按着主耶稣被卖的那一晚所吩咐的，众圣徒在主的桌子前一同唱诗、祷告、感谢、纪念主耶稣为我们所成就的一切。</p>
                            <p>每个主日下午 3：15 ～ 4：30，信息聚会，按着神圣言的真理教导、牧养所有属神的儿女。</p>
							<a href="#gospel-message-section" class="h-btn">福音信息</a>
						</div>
                        <div class="col-md-8 item">
							<h2>查经小组</h2>
							<p>每个周五晚上7：30 ～ 21：00，中英文三个查经小组，研读神的话语，分享信仰生活的实际。</p>
							<a href="#special-message-section" class="h-btn">特别聚会</a>
						</div>
						<div class="col-md-8 item">
							<h2>聚会时间</h2>
							<p>周四(7:30 pm) -- 祷告聚会</p>
                            <p>周五(7:30 pm) -- 查经聚会</p>
                            <p>主日(2:30 pm) -- 真理慕道班</p>
                            <p>主日(2:30 pm) -- 掰饼聚会</p>
                            <p>主日(3:30 pm) -- 信息聚会</p>
                            
							<a href="#contact-area" class="h-btn">联系我们</a>
						</div>
-->
					</div>
				</div>
			</div>
		</div>
		<!-- /header-bottom -->
	</header><!-- /Header-area -->

	<!-- features-area -->
	<section id="features-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-6">
					<div class="single-features">
						<div class="feature-icon">
							<span class="et-icon icon-telescope"></span>
						</div>
						<h4>
							我们的信仰
						</h4>
						<p>整本圣经是那位创造宇宙万有的神对人的完整启示，圣经启示的中心是神的独生爱子，我们所信靠的主耶稣基督，我们信他曾在十字架上为我们的罪而死，被埋葬，第三日靠着永生神的大能从死里复活，并升天坐在荣耀父神的右边，为普天下的圣徒代求。我们信靠他。</p>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="single-features">
						<div class="feature-icon">
							<i class="et-icon icon-upload"></i>
						</div>
						<h4>
							我们的盼望
						</h4>
						<p>我们相信教会是基督的身体，基督爱教会，为教会舍己，并用水藉着道把教会洗净，成为圣洁，献给自己，作个荣耀的教会。我们盼望当日期满足，荣耀的耶稣基督必将再次降临，来迎娶他圣洁的新娘--由众圣徒组成的教会到天上与他同享荣耀。</p>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="single-features">
						<div class="feature-icon">
							<i class="et-icon icon-browser"></i>
						</div>
						<h4>
							我们的使命
						</h4>
						<p>末后的世代，仇敌如吼叫的狮子，遍地游行，寻找可吞吃的人。我们接受主耶稣复活以后交给门徒的使命，为他做见证，广传福音，造就圣徒。在日趋堕落的世代，愿南素里基督教会成为当地的金灯台，照亮仍在黑暗中灵魂，吸引他们归向永生神的儿子：主耶稣基督。</p>
					</div>
				</div>
			</div>
		</div>
	</section> <!-- /features-area -->

	<!-- sunday-message-section -->
	<section id="sunday-message-section" data-scroll-index="1">
		<div class="container">
			<div class="row">
				<div class="col-lg" id="sundaymsg_container">
				</div>
			</div>
		</div>
	</section>
    <script type="text/template" id="sundaymsg-tpl">
    <h3 style="text-align:center;">主日信息</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th style="width:120px;">日期/讲员</th>
                <th>主题</th>
                <th style="text-align:center;">播放音频</th>
				<th style="text-align:center;">视频链接</th>
            </tr>
        </thead>
        <tbody>
            {@each list as v}
            <tr>
            <td style="text-align:center;">${v.date}<p>${v.speaker}<p></td>
            <td>${v.theme}</td>
            <td align="center"><a href="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/messages/sundaymsg/${v.audio_file}"><i class="et-icon ion-social-youtube-outline"></i></a></td>
			<td align="center">
			{@if v.has_video==1}
			<a target="_blank" href="${v.youtube_link}"><img src="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/i/images/youtube.png" style="width:30px;height:30px;" /></a>
			{@/if}
			</td>
            </tr>
            {@/each}
        </tbody>
    </table>
    </script>
	<!-- /sunday-message-section -->

    <div style="clear:both;height:20px;"></div>
	<!-- gospel-message-section start -->
	<section id="gospel-message-section" data-scroll-index="2">
		<div class="container">
			<div class="row">
				<div class="col-lg" id="gospelmsg_container">
				</div>
			</div>
		</div>
	</section> 
    <script type="text/template" id="gospelmsg-tpl">
    <h3 style="text-align:center;">福音信息</h3>
    <p style="text-align:center;">每月第四个主日为教会传福音主日</p>
    <table class="table table-striped">
        <thead>
            <tr>
                <th style="width:110px;">日期/讲员</th>
                <th>主题</th>
                <th style="text-align:center;">播放音频</th>
				<th style="text-align:center;">视频链接</th>
            </tr>
        </thead>
        <tbody>
            {@each list as v}
            <tr>
            <td style="text-align:center;">${v.date}<p>${v.speaker}<p></td>
            <td>${v.theme}</td>
            <td align="center"><a href="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/messages/sundaymsg/${v.audio_file}"><i class="et-icon ion-social-youtube-outline"></i></a></td>
			<td align="center">
			{@if v.has_video==1}
			<a target="_blank" href="${v.youtube_link}"><img src="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/i/images/youtube.png" style="width:30px;height:30px;" /></a>
			{@/if}
			</td>
            </tr>
            {@/each}
        </tbody>
    </table>
    </script>
    <!-- gospel-message-section end -->

	<div style="clear:both;height:20px;"></div>
	<!-- speical-message-section start -->
	<section id="special-message-section" data-scroll-index="3">
		<div class="container">
			<div class="row">
				<div class="col-lg" id="specialmsg_container">
				</div>
			</div>
		</div>
	</section> 
    <script type="text/template" id="specialmsg-tpl">
    <h3 style="text-align:center;">特别聚会信息</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th style="width:110px;">日期/讲员</th>
                <th>主题</th>
                <th style="text-align:center;">播放音频</th>
				<th style="text-align:center;">视频链接</th>
            </tr>
        </thead>
        <tbody>
            {@each list as v}
            <tr>
            <td style="text-align:center;">${v.date}<p>${v.speaker}<p></td>
            <td>${v.theme}</td>
            <td align="center"><a href="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/messages/specialmsg/${v.audio_file}"><i class="et-icon ion-social-youtube-outline"></i></a></td>
			<td align="center">
			{@if v.has_video==1}
			<a target="_blank" href="${v.youtube_link}"><img src="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/i/images/youtube.png" style="width:30px;height:30px;" /></a>
			{@/if}
			</td>
            </tr>
            {@/each}
        </tbody>
    </table>
    </script>
    <!-- special-message-section end -->

    <!-- children bible stories -->
    <div style="clear:both;height:20px;"></div>
	<!-- speical-message-section start -->
	<section id="children-bible-section" data-scroll-index="4">
		<div class="container">
			<div class="row">
				<div class="col-lg" id="children_bible_container">
                <h3 style="text-align:center;">儿童圣经故事</h3>
                <table class="table table-striped">
                <thead>
                <tr>
                <th style="width:90px;">序号</th>
                <th>主题</th>
                <th>播放</th>
                </tr>
                </thead>
                <tbody>
                <?php $_foreach_story_counter = 0; $_foreach_story_total = count($children_stories);?><?php foreach( $children_stories as $story ) : ?><?php $_foreach_story_index = $_foreach_story_counter;$_foreach_story_iteration = $_foreach_story_counter + 1;$_foreach_story_first = ($_foreach_story_counter == 0);$_foreach_story_last = ($_foreach_story_counter == $_foreach_story_total - 1);$_foreach_story_counter++;?>
                <tr>
                <td><?php echo htmlspecialchars($story['id'], ENT_QUOTES, "UTF-8"); ?></td>
                <td><?php echo htmlspecialchars($story['theme'], ENT_QUOTES, "UTF-8"); ?></td>
                <td><a href="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/lullaby/<?php echo htmlspecialchars($story['id'], ENT_QUOTES, "UTF-8"); ?>.mp3"><i class="et-icon ion-social-youtube-outline"></i></a></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
                </table>
				</div>
			</div>
		</div>
	</section>
	<!-- children bible stories  end-->

	<!-- separator-area -->
	<section id="separator-area">
		<div class="container z-index">
			<div class="row">
				<div class="col-md-12">
					<div class="separator-text">
						<p>耶稣说：我就是道路、真理、生命，若不藉着我，没有人能到父那里去。</p>
						<p>若您有信仰问题，请<a href="#contact-area">联系我们</a></p>
					</div>
				</div>
			</div>
		</div>
	</section><!-- /separator-area -->

	
	<!-- contact-area -->
	<section id="contact-area" data-scroll-index="5">
		<div class="container z-index">
			<div class="row">
				<div class="col-md-4">
					<div class="single-contact-text">
						<h4>电邮</h4>
						<p>myuan@ssca-bc.org<br />&nbsp;</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="single-contact-text">
						<h4>电话</h4>
						<p>778-321-7678<br />&nbsp;</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="single-contact-text">
						<h4>Address</h4>
						<p>17029 - 16th Avenue, Surrey, BC.,<br />Canada V3S 9M5</p>
					</div>
				</div>
			</div>

			<div class="contact-form">
				<div class="row">
					<div class="col-md-6">
						<form action="#">
							<input type="text" name="name" placeholder="Name">
							<input type="email" name="email" placeholder="Email">
							<textarea name="msg" id="msg" placeholder="Message" ></textarea>
							<button class="submit-icon" type="submit">
								SEND
								<i class="submit-icon ion-paper-airplane"></i>
							</button>
						</form>
					</div>
					<div class="col-md-6">
						<div id="map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2615.892315127115!2d-122.75295288478492!3d49.03165507930476!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5485c45c527fa9fd%3A0x76c3fe837938e0a5!2s17029+16+Ave%2C+Surrey%2C+BC+V3S+9M5!5e0!3m2!1sen!2sca!4v1534228715493" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe></div>
					</div>
				</div>
			</div>
		</div>
	</section><!-- /contact-area -->

	<!-- footer-area -->
	<footer id="footer-area">
		<div class="container">
			<div class="copyright-area">
				<div class="row">
					<div class="col-md-12">
						<h2>南素里基督教会</h2>
						<p>&copy; Copyright 2018 - All rights reserved <a href="http://www.ssca-bc.org">南素里基督教会</a></p>
                        <p>Developed By - <a href="http://www.flyyanet.com">FLYYANET TECHNOLOGY INC.</a></p>
						<div class="footer-social">
							<ul>
								<li><a href="#"><i class="social-icon ion-social-facebook"></i></a></li>
								<li><a href="#"><i class="social-icon ion-social-twitter"></i></a></li>
								<li><a href="#"><i class="social-icon ion-social-pinterest"></i></a></li>
								<li><a href="#"><i class="social-icon ion-social-googleplus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer><!-- /footer-area -->

	<!-- scripts -->
	<script src="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/i/js/jquery-3.2.1.min.js"></script>
	<script src="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/i/js/jquery-migrate-3.0.0.js"></script>
	<script src="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/i/js/popper-1.11.0.min.js"></script>
	<script src="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/i/js/bootstrap.min.js"></script>
	<script src="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/i/js/owl.carousel.min.js"></script>
	<script src="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/i/js/bootstrap-portfilter.min.js"></script>
	<script src="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/i/js/waypoints-2.0.3.min.js"></script>
	<script src="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/i/js/jquery.counterup.min.js"></script>
	<script src="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/i/js/jquery.magnific-popup.min.js"></script>
	<script src="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/i/js/jquery.scrollUp.min.js"></script>
	<script src="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/i/js/scrollIt.min.js"></script>
	<script src="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/i/js/map.js"></script>
	<script src="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/i/js/particles.min.js"></script>
	<script src="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/i/js/app.js"></script>
	<script src="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/i/js/active.js"></script>
    <script type="text/javascript" src="<?php echo htmlspecialchars($APP_PATH, ENT_QUOTES, "UTF-8"); ?>/i/js/juicer.js"></script>

<script type="text/javascript">
$(function(){ 
  searchSundayMsg(1);
  searchGospelMsg(1);
  searchSpecialMsg(1);
});
    
function searchSundayMsg(page_id){
  $('#sundaymsg_container').empty();
  var dataset = {
    page:page_id,
  };
  
  var url = "<?php echo url(array('c'=>'main', 'a'=>'sundayMsgApi', ));?>";
  $.ajax({
      type: 'post',
      dataType: 'json',
      url: url,
      data: dataset,
      beforeSend: function(){},
      success: function(data){
          if(data.status == 'success'){ 
             $('#sundaymsg_container').append(juicer($('#sundaymsg-tpl').html(), data));
             $('#sundaymsg_container tr:even').addClass('even');
             if(data.paging != null) { 
                $('#sundaymsg_container').append(juicer($('#sunday-paging-tpl').html(), data)); 
             }
          }
          else{
             $('#sundaymsg_container').append("<h3>未找到主日信息...</h3>"); 
          }
          
      },
      error: function(data){
        alert('处理请求时发生错误');
      }
    });
}

function sundayMsgPageturn(page_id){
    searchSundayMsg(page_id);
}
    
function searchGospelMsg(page_id){
  $('#gospelmsg_container').empty();
  var dataset = {
    page:page_id,
  };

  var url = "<?php echo url(array('c'=>'main', 'a'=>'gospelMsgApi', ));?>";
  $.ajax({
      type: 'post',
      dataType: 'json',
      url: url,
      data: dataset,
      beforeSend: function(){},
      success: function(data){
          if(data.status == 'success'){ 
             $('#gospelmsg_container').append(juicer($('#gospelmsg-tpl').html(), data));
             $('#gospelmsg_container tr:even').addClass('even');
             if(data.paging != null) { 
                $('#gospelmsg_container').append(juicer($('#gospel-paging-tpl').html(), data)); 
             }
          }
          else{
             $('#gospelmsg_container').append("<h3>未找到主日信息...</h3>"); 
          }
          
      },
      error: function(data){
        alert('处理请求时发生错误');
      }
    });
}
    
function searchSpecialMsg(page_id){
  $('#specialmsg_container').empty();
  var dataset = {
    page:page_id,
  };

  var url = "<?php echo url(array('c'=>'main', 'a'=>'specialMsgApi', ));?>";
  $.ajax({
      type: 'post',
      dataType: 'json',
      url: url,
      data: dataset,
      beforeSend: function(){},
      success: function(data){
          if(data.status == 'success'){ 
             $('#specialmsg_container').append(juicer($('#specialmsg-tpl').html(), data));
             $('#specialmsg_container tr:even').addClass('even');
             if(data.paging != null) { 
                $('#specialmsg_container').append(juicer($('#special-paging-tpl').html(), data)); 
             }
          }
          else{
             $('#specialmsg_container').append("<h3>未找到主日信息...</h3>"); 
          }
          
      },
      error: function(data){
        alert('处理请求时发生错误');
      }
    });
}


function gospelMsgPageturn(page_id){
    searchGospelMsg(page_id);
}
    
function specialMsgPageturn(page_id){
    searchSpecialMsg(page_id);
}
    
</script>
<?php include $_view_obj->compile('default/lib/sunday_paging.html'); ?>
<?php include $_view_obj->compile('default/lib/gospel_paging.html'); ?>
<?php include $_view_obj->compile('default/lib/special_paging.html'); ?>
</body>
</html>