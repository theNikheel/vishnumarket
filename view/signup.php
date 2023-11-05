<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
	<div class="auth-content text-center">
		<img src="assets/images/logo.png" alt="" class="img-fluid mb-4">
		<div class="card borderless">
			<div class="row align-items-center ">
				<div class="col-md-12">
					<div class="card-body">
						<form id="signupForm" action="model/loginModel.php" method="post">
							<h4 class="f-w-400">Sign up</h4>
							<hr>
							<div class="form-group mb-3">
								<input required="required" onblur="checkDuplicateFun(this)" type="text" class="form-control" name="email" placeholder="Email address">
								<p class="mb-0 resAjaxCls"></p>
							</div>
							<div class="form-group mb-3">
								<input required="required" onblur="checkDuplicateFun(this)" type="text" class="form-control" name="contactNo" placeholder="Phone Number">
								<p class="mb-0 resAjaxCls"></p>
							</div>
							<div class="form-group mb-3">
								<input type="text" class="form-control" required="required" onblur="checkDuplicateFun(this)" name="username" placeholder="Username">
								<p class="mb-0 resAjaxCls"></p>
							</div>
							
							<div class="form-group mb-4">
								<input type="password" class="form-control" required="required" name="password" id="Password" placeholder="Password">
							</div>						
							
							<input type="submit" onclick="return submitForm()" name="signup" class="btn btn-block btn-primary mb-4" value="Sign Up">
						</form>
						<hr>
						<p class="mb-2">Already have an account? <a href="/" class="f-w-400">Signin</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
function submitForm(){
	
	/*$("input[type=text]").each(function(){
		$(this).val();
	});*/

	//checkvalue = $('#checkvalue').val();
	totalLength = $('.success').length;
	//alert(totalLength);
	errorCounter = 0;
	$('.resAjaxCls').each(function(){
		// check class
        if( $(this).hasClass('error') ){
        	errorCounter++;
        }
    });
	
	if(errorCounter==0 && totalLength==3)
	{
		$("#signupForm").submit();
		return true;
	}else{
		alert("Please valid all fields");
		return false;
	}
}
</script>