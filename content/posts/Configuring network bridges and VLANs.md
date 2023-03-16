---
title: "Configuring network bridges and VLANs"
date: 2022-09-20
---




Configuring Network Bridges and VLANs

In a modern IT infrastructure, networks play a crucial role. Network bridges and VLANs (Virtual Local Area Networks) are two important concepts that network administrators must be familiar with. This blog post provides a comprehensive guide to configuring network bridges and VLANs.

Network Bridges

A network bridge connects two or more network segments together at the data link layer of the OSI model. It acts as a virtual switch that forwards packets between different segments of a network. A bridge is useful for connecting LANs (Local Area Networks) or connecting devices in a data center.

Bridges are transparent to higher-layer protocols and applications, meaning they do not affect how data is transmitted between devices. However, bridges must be configured correctly to ensure they operate efficiently.

To configure a network bridge in Linux, use the `brctl` command. Assuming you have two Ethernet interfaces named `eth0` and `eth1`, follow these steps:

1. Create a bridge interface using the `brctl` command:

   ```
   sudo brctl addbr br0
   ```

2. Add both Ethernet interfaces to the bridge:

   ```
   sudo brctl addif br0 eth0
   sudo brctl addif br0 eth1
   ```

   This command adds `eth0` and `eth1` to the `br0` bridge.

3. Enable the bridge interface:

   ```
   sudo ip link set br0 up
   ```

   This command activates the `br0` bridge.

With these commands, you have successfully created a network bridge. Any Ethernet frames received by the bridge are forwarded to the correct physical interface based on the MAC address.

VLANs

A VLAN is a logical division of a physical network. In other words, it separates a physical network into multiple virtual networks. A VLAN is identified by a unique ID, and traffic within a VLAN is isolated from traffic in other VLANs.

VLANs can be used to isolate traffic, improve network performance, and improve network security. For example, sensitive data can be separated from regular data using VLANs.

To configure VLANs in Linux, follow these steps:

1. Install the `vlan` package:

   ```
   sudo apt-get install vlan
   ```

2. Create a VLAN sub-interface for an existing Ethernet interface:

   ```
   sudo vconfig add eth0 10
   ```

   This command creates a VLAN sub-interface for `eth0` with VLAN ID `10`.

3. Configure the VLAN sub-interface:

   ```
   sudo ip addr add 192.168.10.1/24 dev eth0.10
   sudo ip link set up dev eth0.10
   ```

   This command assigns an IP address to the VLAN sub-interface and activates it.

With these commands, you have successfully configured a VLAN sub-interface. Any traffic sent to this sub-interface will be associated with the specified VLAN ID.

Conclusion

Network bridges and VLANs are essential concepts that network administrators must be familiar with. By using these tools, you can create a more efficient, secure, and manageable network infrastructure.

Additional Resources

1. Linux Bridges and VLANs - https://www.linuxjournal.com/content/linux-bridges-and-vlans
2. VLANs in Linux - https://www.thegeekdiary.com/vlans-in-linux-part-i-overview-of-vlan-configuration/
3. Configuring Network Bridges in Linux - https://www.tecmint.com/configure-network-bridge-in-linux/