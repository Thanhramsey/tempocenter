<div class="container" style="margin-top:20px;background-color: #d9e8f1;border-radius: 20px">
	<div class="row">
		<div class="col-md-3 col-sm-3 hidden-xs">
		</div>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<form action="" accept-charset="UTF-8" action="" id="reset_password" method="post">
				<div id="login">
				<h2 class="text-beauty text-bold acc_content" style="color:#fc2a40">Quên mật khẩu</h2>
					<?php 
					if(isset($success))
						echo '<h4 style="color:green;">'.$success.'</h4>';
					?>
					<div class="acc_content clearfix" style="display: block;">
						<div class="col_full">
							<label for="login-form-password">Email :<span class="require_symbol">* </span></label>
							<input type="email" id="login-form-password" name="email" value="" class="form-control">
							<div class="error" id="password_error"><?php echo form_error('email')?></div>
						</div>
						<button class="hvr-bounce-in button button-3d button-black nomargin pull-left" id="login-form-submit" name="login-form-submit" type="submit" value="login">Tiếp tục</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>