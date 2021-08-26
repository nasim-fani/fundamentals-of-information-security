<?php
$acl = (`echo "nasim2018" | sudo ./ipblock.sh`);
$acl = (`echo "nasim2018" | sudo iptables -P INPUT DROP`);
echo("ips outside Iran are blocked successfuly");

#sudo iptables -S


#restart ip tables:

#iptables -P INPUT ACCEPT
#iptables -P OUTPUT ACCEPT
#ptables -P FORWARD ACCEPT

#iptables -F INPUT
#iptables -F OUTPUT
#iptables -F FORWARD
?>