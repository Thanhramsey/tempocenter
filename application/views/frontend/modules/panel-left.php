<div class="menu-pri">
	<!-- <div class="panel-left" style="background: #262144;">
            MOBILE
            <nav class="navbar hidden-md hidden-lg" role="navigation">
                <div class="container-fluid" style="background-color: #262144;">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar primary-color"></span>
                            <span class="icon-bar primary-color"></span>
                            <span class="icon-bar primary-color"></span>
                        </button>
                        <a class="navbar-brand" style="color: #fff;" href="#">Danh mục sản phẩm</a>
                    </div>
                    <div class="collapse navbar-collapse navbar-ex1-collapse hidden-md hidden-lg">
                        <?php
						$listcat = $this->Mcategory->category_menu(0);
						$html_menu = '<ul class="nav navbar-nav">';
						foreach ($listcat as $menu) {
							$parentid = $menu['id'];
							$submenu = $this->Mcategory->category_menu($parentid);
							$html_menu .= '<li class="dropdown">';
							$html_menu .= "<a href='san-pham/" . $menu['link'] . "' class='dropdown-toggle' data-toggle='dropdown'>";
							$html_menu .= $menu['name'];
							if (!empty($submenu)) {
								$html_menu .= '<i class="fa fa-angle-right pull-right" aria-hidden="true">';
								$html_menu .= '</i>';
							}
							$html_menu .= "</a>";
							if (count($submenu)) {
								$html_menu .= '<ul class="dropdown-menu">';
								foreach ($submenu as $menu1) {
									$html_menu .= '<li>';
									$html_menu .= "<a href='san-pham/" . $menu1['link'] . "'> " . $menu1['name'] . "</a>";
									$html_menu .= "</li>";
								}
								$html_menu .= "</ul>";
							}
							$html_menu .= "</li>";
						}
						$html_menu .= "</ul>";
						echo $html_menu;
						?>
                    </div>

                </div>
       		</nav> -->
	<!--MD LG-->
</div>
<div class="navbar col-md-12 col-lg-12 panel-right hidden-xs text-center" style="background: #262144;">
	<ul class="menu-right" style="display: inline-block;">
		<li class="pull-left "><a href="" class="hvr-sweep-to-right"> <i class="fas fa-home fa-sm"></i>  Trang chủ</a></li>
		<li class="pull-left nav-item dropdown">
			<a href="#" class="hvr-sweep-to-right dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-globe fa-spin fa-sm"></i>  Thương hiệu <span class="caret"></span></a>
			<ul class="dropdown-menu fade-down">
				<?php
				$listXa = $this->Mproducer->producer_list();
				$html = '';
				foreach ($listXa as $xa) {
					$html = "<li  class='sub-link'>";
					$html .= "<a class='hvr-pulse-shrink' href='san-pham/db/" . $xa['code'] . " '>";
					$html .= $xa['name'];
					$html .= "</a>";
					$html .= '</li>';
					echo $html;
				}
				?>
			</ul>
		</li>
		<li class="pull-left nav-item dropdown">
			<a href="#" class="dropdown-toggle hvr-sweep-to-right" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-cube fa-sm"></i>  Loại sản phẩm <span class="caret"></span></a>
			<ul class="dropdown-menu fade-down">
				<?php
				$listcat = $this->Mcategory->category_menu(0);
				$html = '';
				foreach ($listcat as $menu) {
					$html = "<li  class='sub-link'>";
					$html .= "<a class='hvr-pulse-shrink' href='san-pham/" . $menu['link'] . " '>";
					$html .= $menu['name'];
					$html .= "</a>";
					$html .= '</li>';
					echo $html;
				}
				?>
			</ul>
		</li>
		<li class="pull-left"><a class="hvr-sweep-to-right" href="lichhoc"><i class="fas fa-calendar fa-sm"></i>  Lịch học</a></li>
		<!-- <li class="pull-left"><a href="ketnoicungcau">Kết nối cung cầu</a></li> -->
		<li class="pull-left"><a class="hvr-sweep-to-right"  href="san-pham"><i class="fas fa-music fa-sm"></i>  Sản phẩm</a></li>
		<li class="pull-left"><a class="hvr-sweep-to-right" href="tin-tuc/1"><i class="fas fa-newspaper fa-sm"></i>  Tin tức</a></li> 
		<li class="pull-left"><a class="hvr-sweep-to-right"  href="van-ban"><i class="fas fa-tablet fa-sm"></i>  Chính Sách</a></li>
		<li class="pull-left nav-item dropdown">
		<a href="#" class="dropdown-toggle hvr-sweep-to-right" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-info-circle fa-sm"></i>  Liên hệ <span class="caret"></span></a>
			<ul class="dropdown-menu fade-down">
				<li class="sub-link"><a class='hvr-pulse-shrink' href="lien-he">Liên hệ</a></li>
				<li class="sub-link"><a class='hvr-pulse-shrink' href="chinhsachbaomat">Chính sách bảo mật</a></li>
				<li class="sub-link"><a class='hvr-pulse-shrink' href="dieukhoanbaohanh">Điều khoản bảo hành</a></li>
				<li class="sub-link"><a class='hvr-pulse-shrink' href="questions">Câu hỏi thường gặp</a></li>
			</ul>
		</li>
	</ul>
</div>

