<meta name="google-signin-scope" content="profile email">
		<meta name="google-signin-client_id" content="360753505284-4uo4eiqbafl59t7141og7jnup73pn21d.apps.googleusercontent.com">
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                    <div class="header">
                            <h2>
                                ลงชื่อเข้าใช้ระบบ<?php print $systemName; ?>   
                            </h2>
                            </div>
                            
                        <div class="body">
        <div class="row">
                    <div class="col-md-12 p-t-5" style="text-align:right;">
                        <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
                        </div>
                    </div>
                    <div id="ggResponse">
                    </div></div>
                    </div></div>
                    </div>
    <script>
        
			function onSignIn(userInfo) {
				var result = '';
				var profile = userInfo.getBasicProfile();
                $.post( "<?php print site_url('public/user/checkGoogle'); ?>",{email:profile.getEmail(),token:userInfo.getAuthResponse().id_token}, function( data ) {
                    var result=$.parseJSON(data);
                    if(result.status=='ok'){                        
                        signOut();
                        window.location.replace("<?php print site_url('public/home/dashboard'); ?>");
                    }else{
                        alert(result.text);
                    }
                });
			}
    function signOut() {
				var auth2 = gapi.auth2.getAuthInstance();
				auth2.signOut().then(function () {
						console.log("User signed out.");
				});
			}
    </script>