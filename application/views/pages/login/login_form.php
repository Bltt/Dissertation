<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Community Auth - Login Form View
 *
 * Community Auth is an open source authentication application for CodeIgniter 3
 *
 * @package     Community Auth
 * @author      Robert B Gottier
 * @copyright   Copyright (c) 2011 - 2018, Robert B Gottier. (http://brianswebdesign.com/)
 * @license     BSD - http://www.opensource.org/licenses/BSD-3-Clause
 * @link        http://community-auth.com
 */

if( ! isset( $optional_login ) )
{
	echo '<h1>Login</h1>';
}

if( ! isset( $on_hold_message ) )
{
	if( isset( $login_error_mesg ) )
	{
		echo '
			<div style="border:1px solid red;">
				<p>
					Login Error #' . $this->authentication->login_errors_count . '/' . config_item('max_allowed_attempts') . ': Invalid Username or Password.
				</p>
				<p>
					Username and password are all case sensitive.
				</p>
			</div>
		';
	}

	if( $this->input->get(AUTH_LOGOUT_PARAM) )
	{
		echo '
			<div style="border:1px solid green">
				<p>
					You have successfully logged out.
				</p>
			</div>
		';
	}

	echo form_open( $login_url, ['class' => 'std-form'] ); 
?>

	<div>
		<form class="form-horizontal" action="#">
		<div class="form-group">
			<label for="login_string" class="control-label col-sm-2">Username</label>
			<input type="text" name="login_string" id="login_string" class="form_input form-control" autocomplete="off" maxlength="255" />
		</div>
		
		<br />
		
		<div class="form-group">
			<label for="login_pass" class="control-label col-sm-2">Password</label>
			<input type="password" name="login_pass" id="login_pass" class="form_input password form-control" <?php 
				if( config_item('max_chars_for_password') > 0 )
					echo 'maxlength="' . config_item('max_chars_for_password') . '"'; 
			?> autocomplete="off" readonly="readonly" onfocus="this.removeAttribute('readonly');" />
		</div>

		<?php
			if( config_item('allow_remember_me') )
			{
		?>

			<br />

			<label for="remember_me" class="form_label">Remember Me</label>
			<input type="checkbox" id="remember_me" name="remember_me" value="yes" />

		<?php
			}
		?>

		<p>
			<?php
				$link_protocol = USE_SSL ? 'https' : NULL;
			?>
			
			
			<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#forgotpassmodal">
				Forgot Password?
			</button>
		</p>

		<div class="float-right">
			<input type="submit" name="submit" class="btn btn-primary" value="Login" id="submit_button"  />
		</div>
	</div>
</form>

		<!-- Modal -->
<div class="modal fade" id="forgotpassmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Forgot username or password?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Please contact officer commanding 561 Squadron who can reset your account appropriately through the user account system.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php

	}
	else
	{
		// EXCESSIVE LOGIN ATTEMPTS ERROR MESSAGE
		echo '
			<div style="border:1px solid red;">
				<p>
					Excessive Login Attempts
				</p>
				<p>
					You have exceeded the maximum number of failed login<br />
					attempts that this website will allow.
				<p>
				<p>
					Your access to login and account recovery has been blocked for ' . ( (int) config_item('seconds_on_hold') / 60 ) . ' minutes.
				</p>
				<p>
					Please use the <a href="/examples/recover">Account Recovery</a> after ' . ( (int) config_item('seconds_on_hold') / 60 ) . ' minutes has passed,<br />
					or contact us if you require assistance gaining access to your account.
				</p>
			</div>
		';
	}

/* End of file login_form.php */
/* Location: /community_auth/views/examples/login_form.php */ 