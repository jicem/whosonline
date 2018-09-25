<?php
// Indicate that we should consider this a front-end session so we can obtain the currently logged in users information.
	\IPS\Session\Front::i();
		/* Init */
		$members     = array(); // create array of members
		$memberCount = 0;
		$pos = 90;
		$users = \IPS\Session\Store::i()->getOnlineUsers( 0, 'desc', NULL, NULL, TRUE );
		foreach( $users as $row )
		{
			if ( $row['login_type'] == \IPS\Session\Front::LOGIN_TYPE_MEMBER ) { // if a member
						if ( $row['member_name'] )
						{
							$members[$memberCount] = $row['member_id']; // add member to new array
							$memberCount++;
						}
			}
		}
                sort($members);
?>
<div id="whosonlinediv" style="width:100%;height:auto;background-image:url('https://www.thesbcommunity.com/kyucumber/test.png');background-size:100% auto;background-position:bottom center;background-repeat:no-repeat;position:relative;">
<?php
	for($x = 0; $x < ($memberCount/2); $x++) {
	    if($x > 0){
		if($members[$x-1] == $members[$x]) continue;
	    }
	    $currentMember = \IPS\Member::load($members[$x]);
	    $pos = $pos + $x + 40;
	    echo "<a href='" .$currentMember->url(). "'><img src='https://www.thesbcommunity.com/uploads/ifish/" .$currentMember->ifish. "-music.png' srcset='https://www.thesbcommunity.com/uploads/ifish/" .$currentMember->ifish. "-retina.png 2x' style='width:62px;z-index:3;position:absolute;bottom:175px;left:" .$pos. "px' data-ipstooltip _title='" .$currentMember->name. "'/></a>";
	}
?>
<br />
<?php
        $pos = 130;
	for($x = 0; $x < ($memberCount/2 - 1); $x++) {
	    if($members[$memberCount/2 + $x] == $members[$memberCount/2 + $x + 1]) continue;
	    $currentMember = \IPS\Member::load($members[$memberCount/2 + $x + 1]);
	    $pos = $pos + $x + 40;
	    echo "<a href='" .$currentMember->url(). "'><img src='https://www.thesbcommunity.com/uploads/ifish/" .$currentMember->ifish. "-music.png' srcset='https://www.thesbcommunity.com/uploads/ifish/" .$currentMember->ifish. "-retina.png 2x' style='width:62px;z-index:3;position:absolute;bottom:105px;left:" .$pos. "px' data-ipstooltip _title='" .$currentMember->name. "'/></a>";
	}
?>
<img src="https://www.thesbcommunity.com/kyucumber/whosonline/autumn.png" style="width:100%;height:auto;z-index:2;" id="whosonlinebg">