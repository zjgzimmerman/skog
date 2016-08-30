<html>
	<head>
		<? include './includes/htmlhead.php'; ?>
	</head>
	<body>
		<div id="content">
			<div id="main">
				<span id="logo" >SKOG</span>
					<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" >
						<tr>
							<form name="form1" method="post" action="checklogin.php">
								<td>
								<table width="100%" border="0" cellpadding="3" cellspacing="1"  id="login">
								<tr>
								<td colspan="3"><strong>Login </strong></td>
						</tr>
								<?
									if (isset($_GET['invalid']))
										echo "<span class='error'>Invalid login information</span>";
								?>
							<tr>
								<td width="78">Username</td>
								<td width="6">:</td>
								<td width="294"><input name="username" type="text" id="username"></td>
							</tr>
							<tr>
								<td>Password</td>
								<td>:</td>
								<td><input name="password" type="password" id="password" password></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td><input type="submit" name="Submit" value="Login" class="button"></td>
							</tr>
						</table>
								</td>
							</form>
						</tr>
					</table>
					 <p align="center"><a href="newUser.php" >Create Account</a></p>
				</div>
						 <? include './includes/footer.php'; ?>
		 </div>
	</body>
</html>