<?php echo form_open('dang-ky'); ?>
<section id="product-detail" style="margin-top:20px">
	<div class="container" style="background-color: #d9e8f1;border-radius: 20px;">
		<div class="col-md-3 col-sm-3 hidden-xs"></div>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="products-wrap">
				<div class="accordion accordion-lg divcenter nobottommargin clearfix" style="max-width: 650px;">
					<div id="register">
						<div class="row">
								<div class="col-md-12" style="padding: 0px 10px !important;margin-top:10px">
									<h2 class="text-beauty text-bold" style="color:#fc2a40">Đăng ký tài khoản</h2>
									<?php
									if(isset($success))
										echo '<h4 style="color:green;">'.$success.'</h4>';
									?>
								</div>
						</div>
						<div style="display: block;">
							<form accept-charset="UTF-8" action="" id="customer_register" method="post">
								<input name="FormType" type="hidden" value="customer_register">
								<input name="utf8" type="hidden" value="true">
								<div class="row">
									<div class="col-md-6" style="padding: 0px 10px !important">
										<label for="first_name">Tên đăng nhập:<span class="require_symbol">*</span></label>
										<input type="text" id="first_name" name="username" value="" class="form-control" placeholder="Tên đăng nhập">
										<div class="error" id="username_error"><?php echo form_error('username')?></div>
									</div>
									<div class="col-md-6" style="padding: 0px 10px !important">
										<label for="register-form-email">Email:<span class="require_symbol">*</span></label>
										<input type="text" id="register-form-email" name="email" class="form-control" placeholder="Nhập email">
										<div class="error" id="email_error"><?php echo form_error('email')?></div>
									</div>
								</div>	
								<div class="row">
								<div class="col-md-6" style="padding: 0px 10px !important;margin-top:10px">
									<label for="register-form-password">Mật khẩu:<span class="require_symbol">*</span></label>
									<input type="password" id="register-form-password" name="password" placeholder="Mật khẩu" class="form-control">
									<div class="error" id="password_error"><?php echo form_error('password')?></div>
								</div>

								<div class="col-md-6" style="padding: 0px 10px !important;margin-top:10px">
									<label for="register-form-repassword">Nhập lại mật khẩu:<span class="require_symbol">* </span></label>
									<input type="password" id="register-form-repassword" name="re_password" value="" class="form-control" placeholder="Nhập lại mật khẩu">
									<div class="error" id="re_password_error"><?php echo form_error('re_password')?></div>
								</div>
								</div>
								<div class="row">	
								<div class="col-md-6" style="padding: 0px 10px !important;margin-top:10px">
									<label for="first_name">Họ tên:<span class="require_symbol">*</span></label>
									<input type="text" id="first_name" name="name" placeholder="Họ tên" class="form-control">
									<div class="error" id="name_error"><?php echo form_error('name')?></div>
								</div>
								
								<div class="col-md-6" style="padding: 0px 10px !important;margin-top:10px">
									<label for="first_name">Số điện thoại:<span class="require_symbol">*</span></label>
									<input type="text" id="first_name" name="phone" placeholder="Số điện thoại" class="form-control">
									<div class="error" id="name_error"><?php echo form_error('phone')?></div>
								</div>
								</div>
								<div class="row">
									<div class="col-md-12" style="padding: 0px 10px !important;margin-top:10px">
									<button class="hvr-bounce-in button button-3d button-black nomargin" id="register-form-submit" name="register-form-submit" type="submit" style="margin-bottom: 20px; margin-top:10px;border-radius:10px">Đăng ký</button>
									<ul>
										<li class="right" style="font-size: 18px;">Nếu đã có tài khoản, hãy <a href="<?php echo base_url()?>dang-nhap" style="font-size: 19px; color: #262144;">Đăng nhập</a></li>
									</ul>
								</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-3 hidden-xs"></div>
	</div>
</section>
