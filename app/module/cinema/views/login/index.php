<div id="message"></div>
<div class="pw_main" id="pw_main">
    <div class="login_box">
        <span class="logo">LOGO</span>
        <ul>
            <li>
                <label>用户名:</label><input type="text" id='username' class="login_input">

            </li>
            <li>
                <label>密  码:</label><input type="password" id="password" class="login_input">
                <p class="login_remark">使用小写，半角的英文字母或阿拉伯数字</p>
            </li>
        </ul>
	    <button class="btn_login" onclick="login()">登陆</button>
	</div>
</div>

<script>
	function login(){
		var username = $('#username').val();
		var password = $('#password').val();
		if(username && password) {
			$.ajax({
				type: 'post',
				url:'/login/index',
				data: {username : username,
					   password : password
				      },
				dataType: 'json',
				success:function(data){
					if(data.status == 200) {
						$('#message').html(data.message);
						window.location = data.url;
					} else {
						$('#message').html(data.message);
					}
				}
			});
		} else {
			$('#message').html('用户名密码不能为空');
		}

		return false;
	}
</script>