<?php
	/**
	 * Created by Wixzi Solutions.
	 * Project: SMS
	 * User: Gautam
	 * Date: 11/17/13
	 * FileName: userProfile.php
	 */
	echo '<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-user icon-white"></i>
							<span class="hidden-phone">';
	echo ucfirst($_SESSION['UserName']);
	echo '</span></a>

						<ul class="dropdown-menu">
							<li class="divider"></li>
							<li><a href="adminBusinessLogic/logout.php"><i class="icon-off"></i> Logout</a></li>
						</ul>
					</li>';
